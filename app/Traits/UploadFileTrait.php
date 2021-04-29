<?php

namespace App\Traits;

trait UploadFileTrait {
    
    public function uploadImage($image)
    {
        return cloudinary()->upload($image->getRealPath())->getSecurePath();
    }
}