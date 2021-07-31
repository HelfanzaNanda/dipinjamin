<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Media;
use App\Order;
use App\OrderDetail;
use App\Traits\FirebaseTrait;
use App\Traits\UploadFileTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    use FirebaseTrait, UploadFileTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {

		$validator = Validator::make($request->all(), [
			'book_id' => 'required',
			'owner_id' => 'required',
			'duration' => 'required',
			//'address' => 'required',
			// 'lat' => 'required',
			// 'lng' => 'required',
			'ktp' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json([
                'message' => 'http unprocessable entity',
                'status' => false,
                'data' => $validator->getMessageBag()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
		}

        DB::beginTransaction();
        try {
            $order = Order::create([
                'book_id' => $request->book_id,
                'borrower_id' => auth()->id(),
				'delivery_address_id' => $request->delivery_address_id,
                'owner_id' => $request->owner_id,
                'duration' => $this->checkDuration($request->duration)['duration_in_week'],
                'first_day_borrow' => now(),
                'last_day_borrow' => $this->checkDuration($request->duration)['last_day_borrow'],
            ]);

            Media::create([
                'model_type' => Order::class,
                'model_id' => $order->id,
                'filename' => $this->uploadImageLocal($request->ktp, 'orders')
            ]);

            $owner = User::where('id', $request->owner_id)->first();
            $message = "ada yg mau pinjam buku anda";
            $this->notification($message, $owner->fcm_token);

            DB::commit();
            return response()->json([
                'message' => 'successfully to order',
                'status' => true,
                'data' => (object)[]
            ], Response::HTTP_CREATED);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
                'data' => (object)[]
            ], Response::HTTP_PRECONDITION_FAILED);
        }
    }

    // 1= 1 minggu
    // 2 = 2 minggu
    // 3 = 3 minggu
    // 4 = 1 bulan
    private function checkDuration($duration)
    {
        if ($duration == "1 Minggu") {
            $last_day_borrow = Carbon::now()->addWeeks(1);
        }elseif($duration == "2 Minggu"){
            $last_day_borrow = Carbon::now()->addWeeks(2);
        }elseif($duration == "3 Minggu"){
            $last_day_borrow = Carbon::now()->addWeeks(3);
        }else{
            $last_day_borrow = Carbon::now()->addMonths(1);
        }

        return [
            'duration_in_week' => $duration,
            'last_day_borrow' => $last_day_borrow,
        ];
    }

    public function byBorrower()
    {
        $orders =  Order::with('delivery_address', 'owner')
		->where('borrower_id', auth()->id())->latest()->get();
        return response()->json([
            'message' => 'successfully get order me',
            'status' => true,
            'data' => OrderResource::collection($orders)
        ], Response::HTTP_OK);
    }

	public function byOwner()
    {
        $orders =  Order::with('delivery_address', 'borrower')
		->where('owner_id', auth()->id())->latest()->get();
        return response()->json([
            'message' => 'successfully get order me',
            'status' => true,
            'data' => OrderResource::collection($orders)
        ], Response::HTTP_OK);
    }
}

