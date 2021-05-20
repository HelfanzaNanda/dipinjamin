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
		]);
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
		]);
	}

	public function delete($id)
	{
		DeliveryAddresses::destroy($id);		
		return response()->json([
			'message' => 'successfully deleted Addresses',
			'status' => true,
			'data' => (object)[]
		]);
	}
}
