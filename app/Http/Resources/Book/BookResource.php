<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Media\MediaResource;
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
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'owner_id' => $this->owner_id,
            'title' => $this->title,
            'description' => $this->description,
            'writer' => $this->writer,
            'viewer' => $this->viewer,
            'images' => MediaResource::collection($this->medias)
        ];
    }
}
