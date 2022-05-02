<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class workshop extends Model  implements HasMedia
{
    use HasFactory,HasApiTokens,InteractsWithMedia;
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
        return $this->belongsTo('App\Models\User','user_id');
    }
}
