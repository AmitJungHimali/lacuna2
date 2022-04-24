<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
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
            'banner'=>$this->banner,
            'title'=>$this->title,
            'description'=>$this->description,
            'objectivesTitle'=>$this->objectivesTitle,
            'objectiveDescription'=>$this->objectiveDescription,
            'rank'=>$this->rank,
            'status'=>$this->status,
            'benefitTitle'=>$this->benefitTitle,
            'benefitDescription'=>$this->benefitDescription,
            'user_id'=>$this->user_id
        ];
    }
}
