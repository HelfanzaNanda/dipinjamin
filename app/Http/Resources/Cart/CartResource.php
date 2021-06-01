<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Book\BookResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
			'book' => new BookResource($this->book),
			'owner' => $this->owner->name,
			'owner_id' => $this->owner->id,
			'borrower' => $this->borrower->name,
		];
    }
}
