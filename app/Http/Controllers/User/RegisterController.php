<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

		$validator = Validator::make($request->all(), [
			'name' => 'string|required|regex:/^[\pL\s\-]+$/u',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
			'phone' => 'required|min:10|max:13'
		]);

		if ($validator->fails()) {
			return response()->json([
                'message' => 'lengkapi form, atau email anda sudah terdaftar',
                'status' => false,
                'data' => $validator->getMessageBag()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
		}

		DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
				'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'fcm_token' => $request->fcm,
                'api_token' => Str::random(60),
            ]);
			
			DB::commit();

			Mail::to($request->email)->send(new VerifyMail($request->email));
			
            return response()->json([
                'message' => 'successfully registered',
                'status' => true,
                'data' => (object)[]
            ], Response::HTTP_CREATED);

        } catch (\Throwable $th) {
			DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
                'data' => (object)[]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
