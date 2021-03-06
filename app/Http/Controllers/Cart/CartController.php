<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index()
	{
		$carts = Cart::where('borrower_id', auth()->id())->get();
		return response()->json([
			'message' => 'successfully get carts',
			'status' => true,
			'data' => CartResource::collection($carts)
		], Response::HTTP_OK);
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
		], Response::HTTP_CREATED);
	}

	public function delete($id)
	{
		Cart::destroy($id);
		return response()->json([
			'message' => 'successfully delete cart',
			'status' => true,
			'data' => (object)[]
		], Response::HTTP_OK);
	}
}
