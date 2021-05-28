<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckUserIsAddedCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $book_id)
    {
        $cart = Cart::where('book_id', $book_id)->where('borrower_id', auth()->guard('api')->id())->first();
		if ($cart) {
			return response()->json([
				'message' => 'user is added cart',
				'status' => true,
				'data' => false
			]);
		}

		return response()->json([
			'message' => 'user isnt added cart',
			'status' => true,
			'data' => true
		]);
    }
}
