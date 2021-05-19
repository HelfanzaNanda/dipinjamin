<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyController extends Controller
{
	public function verify(Request $request)
	{
	   $user = User::where('email', $request->email)->firstOrFail();
	   $user->email_verified_at = now();
	   $user->update();
 
	   return view('auth.verify');
	}
}
