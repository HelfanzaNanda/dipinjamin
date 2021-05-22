<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {

		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required|min:8'
		]);

		if ($validator->fails()) {
			return response()->json([
                'message' => 'http unprocessable entity',
                'status' => false,
                'data' => $validator->getMessageBag()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
		}

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential)){
            $user = Auth::user();
            if ($user->email_verified_at !== null){
                $user->update([
                    'fcm_token' => $request->fcm
                ]);
                return response()->json([
                    'message' => 'Login Successfully',
                    'status' => true,
                    'data' => $user,
                ], Response::HTTP_OK);
            }else{
                return response()->json([
                    'message' => 'Silahkan Aktifasi Email Dahulu',
                    'status' => false,
                    'data' => (object)[]
                ], Response::HTTP_UNAUTHORIZED);
            }
        }
        return response()->json([
            'message' => 'Masukan Email dan Password yang benar',
            'status' => false,
            'data' => (object)[]
        ], Response::HTTP_UNAUTHORIZED);
    }

	public function loginProvider(Request $request)
    {
		try {
			$user = User::where('provider_id', $request->provider_id)
			->where('provider_name', $request->provider_name)->first();
			if ($user) {
				$user->update([
					'fcm_token' => $request->fcm
				]);
				return response()->json([
					'message' => 'Login Successfully',
					'status' => true,
					'data' => $user,
				], Response::HTTP_OK);
			}else{
				$newUser = User::create([
					'provider_id' => $request->provider_id,
					'provider_name' => $request->provider_name,
					'name' => $request->name,
					'email' => $request->email,
					'password' => Hash::make('12345678'),
					'email_verified_at' => now(),
					'fcm_token' => $request->fcm,
					'api_token' => Str::random(60),
				]);

				return response()->json([
					'message' => 'Login Successfully',
					'status' => true,
					'data' => $newUser,
				], Response::HTTP_OK);

			}
		} catch (\Throwable $th) {
			return response()->json([
				'message' => $th->getMessage(),
				'status' => false,
				'data' => (object)[],
			], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
		
    }
}
