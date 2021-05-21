<?php

namespace App\Traits;

trait UploadFileTrait {
    
    public function uploadImage($image)
    {
        return cloudinary()->upload($image->getRealPath())->getSecurePath();
    }

	public function uploadImageLocal($image, $folder)
	{
        $filename = date('ymdyis'). '.' .$image->getClientOriginalExtension();
        $path = public_path('uploads/'.$folder);
        $image->move($path, $filename);
		return $filename;
	}
}