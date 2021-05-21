<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Media\MediaResource;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		$order = Order::where('book_id', $this->id)->latest()->first();
        if ($order) {
			if (Carbon::now()->lt($order->last_day_borrow)) {
				$isAvaiable = false;
			}else{
				$isAvaiable = true;
			}
		}else{
			$isAvaiable = true;
		}
        return [
            'id' => $this->id,
            'category' => new CategoryResource($this->category),
            'owner' => $this->owner->name,
            'title' => $this->title,
            'description' => $this->description,
            'writer' => $this->writer,
            'publisher' => $this->publisher,
            'year' => $this->year,
            'number_of_pages' => $this->number_of_pages,
            'viewer' => $this->viewer,
            'image' => url($this->media->filename),
			'is_available' => $isAvaiable,
        ];
    }
}
