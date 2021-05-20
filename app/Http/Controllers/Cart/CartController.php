<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
	{
		$carts = Cart::where('borrwer_id', auth()->id())->get();
		return response()->json([
			'message' => 'successfully get carts',
			'status' => true,
			'data' => CartResource::collection($carts)
		]);
	}

	public function store(Request $request)
	{
		$params = $request->all();
		$params['borrower_id'] = auth()->id();
		Cart::create($params);
		return response()->json([
			'message' => 'successfully add to cart',
			'status' => true,
			'data' => (object)[]
		]);
	}

	public function delete($id)
	{
		Cart::destroy($id);
		return response()->json([
			'message' => 'successfully delete cart',
			'status' => true,
			'data' => (object)[]
		]);
	}
}
