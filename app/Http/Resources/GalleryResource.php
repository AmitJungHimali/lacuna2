<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$request->id,
            'image',
            'workshop'=>$this->workshop,
            'status'=>$this->status,
            'rank'=>$this->rank,
            'event'=>$this->event
        ];
    }
}
