<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\DeliveryAddresses\DeliveryAddressesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'book_id' => $this->book_id,
            'book_name' => $this->book->title,
            'borrower_id' => $this->borrower_id,
            'borrower_name' => $this->borrower->name,
            'owner_id' => $this->owner_id,
            'owner_name' => $this->owner->name,
            'duration' => $this->duration,
            'first_day_borrow' => $this->first_day_borrow,
            'last_day_borrow' => $this->last_day_borrow,
            'address' => new DeliveryAddressesResource($this->delivery_address)
		];
    }
}
