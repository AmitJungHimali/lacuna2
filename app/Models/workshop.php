<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class workshop extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable=[
        'banner',
        'title',
        'descriptionTitle',
        'description',
        'objectivesTitle',
        'objectiveDescription',
        'rank',
        'status',
        'benefitTitle',
        'benefitDescription',
        'user_id'
    ];
    public function userID(){
        return $this->belongsTo('App\ModelUser','user_id');
    }
}
