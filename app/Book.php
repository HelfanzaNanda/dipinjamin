<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    
    protected $guarded = [];

    public function medias()
    {
       return $this->hasMany(Media::class, 'model_id', 'id')
       ->where('model_type', self::class);
    }

	public function media()
	{
		return $this->hasOne(Media::class, 'model_id', 'id')
		->where('model_type', self::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');	
	}
}
