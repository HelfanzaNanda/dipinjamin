<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Media;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Media::where('model_type', 'App\Banner')->get();
        return response()->json([
            'message' => 'successfully get banners',
            'status' => true,
            'data' => $banners
        ]);
    }
}
