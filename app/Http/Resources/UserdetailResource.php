<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserdetailResource extends JsonResource
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
            'proileImage'=>$this->when(1, function () {
                if (count($this->getMedia('profileImages')) > 0) {
                    return $this->getMedia('profileImages')->first()->getUrl();
                }
            }),
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'middleName'=>$this->middleName,
            'rank'=>$this->rank,
            'role_id'=>$this->role_id,
            'contact'=>$this->contact,
            'gender'=>$this->gender,
            'user_id'=>$this->user_id,
            'companyName'=>$this->companyName,
            'birthDate'=>$this->birthDate
        ];
    }
}
