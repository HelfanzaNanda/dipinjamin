<?php

namespace App\Http\Controllers\DeliveryAddresses;

use App\DeliveryAddresses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DeliveryAddresses\DeliveryAddressesResource;

class DeliveryAddressesController extends Controller
{
    public function index()
	{
		$addresses = DeliveryAddresses::where('user_id', auth()->id())->get();

		return response()->json([
			'message' => 'successfully get addressess',
			'status' => true,
			'data' => DeliveryAddressesResource::collection($addresses)
		], Response::HTTP_OK);
	}
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'provinsi_id' => 'required',
			'provinsi' => 'required',
			'kabupaten_id' => 'required',
			'kabupaten' => 'required',
			'kecamatan_id' => 'required',
			'kecamatan' => 'required',
			'kode_pos' => 'required',
			'address' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json([
                'message' => 'http unprocessable entity',
                'status' => false,
                'data' => $validator->getMessageBag()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
		}

		$params = $request->all();
		$params['user_id'] = auth()->id();
		DeliveryAddresses::updateOrCreate(['id' => $request->id], $params);
		return response()->json([
			'message' => 'successfully created addresses',
			'status' => true,
			'data' => (object)[]
		], Response::HTTP_CREATED);
	}

	public function delete($id)
	{
		DeliveryAddresses::destroy($id);		
		return response()->json([
			'message' => 'successfully deleted Addresses',
			'status' => true,
			'data' => (object)[]
		], Response::HTTP_OK);
	}

	public function get($id)
	{
		$address = DeliveryAddresses::where('id', $id)->first();
		if ($address) {
			return response()->json([
				'message' => 'successfully get address',
				'status' => true,
				'data' => new DeliveryAddressesResource($address)
			], Response::HTTP_OK);
		}

		return response()->json([
			'message' => 'address not found',
			'status' => false,
			'data' => (object)[]
		], Response::HTTP_NOT_FOUND);
	}
}
