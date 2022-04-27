<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'id'=>$this->id,
            'image',
            'name'=>$this->name,
            'desgination'=>$this->designation,
            'quotes'=>$this->quotes,
            'status'=>$this->status,
            'rank'=>$this->rank
        ];
    }
}
