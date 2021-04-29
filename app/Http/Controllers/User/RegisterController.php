<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fcm_token' => $request->fcm,
                'api_token' => Str::random(60),
            ]);

            return response()->json([
                'message' => 'successfully registered',
                'status' => true,
                'data' => (object)[]
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
                'data' => (object)[]
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
