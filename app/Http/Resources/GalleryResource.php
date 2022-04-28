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
            'id'=>$this->id,
            'image'=>$this->when(1, function () {
                if (count($this->getMedia('images')) > 0) {
                    return $this->getMedia('images')->first()->getUrl();
                }
            }),
            'workshop'=>$this->workshop,
            'status'=>$this->status,
            'rank'=>$this->rank,
            'event'=>$this->event
        ];
    }
}
