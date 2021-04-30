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
        DB::beginTransaction();
        try {
            $order = Order::create([
                'book_id' => $request->book_id,
                'borrower_id' => $request->borrower_id,
                'owner_id' => $request->owner_id,
                'duration' => $this->checkDuration($request->duration)['duration_in_week'],
                'first_day_borrow' => now(),
                'last_day_borrow' => $this->checkDuration($request->duration)['last_day_borrow'],
            ]);
    
            
            $orderDetail = OrderDetail::create([
                'order_id' => $order->id,
                'address' => $request->address,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);

            Media::create([
                'model_type' => OrderDetail::class,
                'model_id' => $orderDetail->id,
                'filename' => $this->uploadImage($request->ktp)
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
        if ($duration == 1) {
            $duration_in_week = '1 Minggu';
            $last_day_borrow = Carbon::now()->addWeeks(1);
        }elseif($duration == 2){
            $duration_in_week = '2 Minggu';
            $last_day_borrow = Carbon::now()->addWeeks(2);
        }elseif($duration == 3){
            $duration_in_week = '3 Minggu';
            $last_day_borrow = Carbon::now()->addWeeks(3);
        }else{
            $duration_in_week = '1 Bulan';
            $last_day_borrow = Carbon::now()->addMonths(1);
        }

        return [
            'duration_in_week' => $duration_in_week,
            'last_day_borrow' => $last_day_borrow,
        ];
    }

    public function me()
    {
        $orders =  Order::with('order_details')->where('user_id', auth()->id())->get();
        return response()->json([
            'message' => 'successfully get order me',
            'status' => true,
            'data' => OrderResource::collection($orders)
        ], Response::HTTP_OK);
    }
}
