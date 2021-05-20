<?php

namespace App\Http\Resources\DeliveryAddresses;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryAddressesResource extends JsonResource
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
			'provinsi_id' => $this->provinsi_id,
			'provinsi' => $this->provinsi,
			'kabupaten_id' => $this->kabupaten_id,
			'kabupaten' => $this->kabupaten,
			'kecamatan_id' => $this->kecamatan_id,
			'kecamatan' => $this->kecamatan,
			'kode_pos' => $this->kode_pos,
			'address' => $this->address,
			'lat' => $this->lat,
			'lng' => $this->lng,
			'phone' => $this->phone,
			'name' => $this->name,
		];
    }
}
