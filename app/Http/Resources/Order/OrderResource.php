<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Book\BookResource;
use App\Http\Resources\DeliveryAddresses\DeliveryAddressesResource;
use App\Http\Resources\User\UserResource;
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
            'book' => new BookResource($this->book),
            'borrower' => new UserResource($this->borrower),
            'owner' => new UserResource($this->owner),
            'duration' => $this->duration,
            'first_day_borrow' => $this->first_day_borrow,
            'last_day_borrow' => $this->last_day_borrow,
            'address' => new DeliveryAddressesResource($this->delivery_address)
		];
    }
}
