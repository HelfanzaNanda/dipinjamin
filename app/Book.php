<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    
    protected $guarded = [];

    public function medias()
    {
       return $this->hasMany(Media::class, 'model_id', 'id')->where('model_type', self::class);
    }
}
