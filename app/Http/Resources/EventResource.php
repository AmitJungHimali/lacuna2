<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
           // key   value
           "title"=>$this->title,
           "image"=>asset($this->image),
           "time"=>$this->time,
           "startdate"=>$this->startdate,
           "location"=>$this->location,
           "category_id"=>$this->category_id,
           "keyword"=>$this->keyword,
           "enddate"=>$this->enddate,
           "venue"=>$this->venue,
           "organizer"=>$this->organizer,
           "price"=>$this->price,
           "food"=>$this->food,
           "description"=>$this->description
        ];
    }
}
