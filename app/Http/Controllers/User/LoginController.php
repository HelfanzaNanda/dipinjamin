<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
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
}
