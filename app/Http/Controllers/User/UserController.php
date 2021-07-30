<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function currentUser()
	{
		$user = auth()->guard('api')->user();
		return response()->json([
			'message' => 'successfully get current user',
			'status' => true,
			'data' => new UserResource($user) 
		]);
	}

	public function updateUser(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'first_name' => 'required', 
			'last_name' => 'required', 
			'email' => 'required|email|unique:users,email,'.auth()->guard('api')->user()->id(), 
			'phone' => 'required', 
		]);

		if ($validator->fails()) {
			return response()->json([
                'message' => 'http unprocessable entity',
                'status' => false,
                'data' => $validator->getMessageBag()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		
		auth()->guard('api')->user()->update([
			'name' => $request->first_name . ' ' .$request->last_name,
			'email' => $request->email,
			'phone' => $request->phone
		]);

		return response()->json([
			'message' => 'successfully update profile',
			'status' => true,
			'data' => (object)[]
		]);
	}

	public function updatePassword(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'password' => 'required|min:6'
		]);

		if ($validator->fails()) {
			return response()->json([
                'message' => 'http unprocessable entity',
                'status' => false,
                'data' => $validator->getMessageBag()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		
		auth()->guard('api')->user()->update([
			'password' => $request->password
		]);

		return response()->json([
			'message' => 'successfully update password',
			'status' => true,
			'data' => (object)[]
		]);
	}
}
