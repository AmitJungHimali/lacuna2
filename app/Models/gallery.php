<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class gallery extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;

    protected $fillable=[
        'image',
        'rank',
        'event_id',
        'workshop_id',
        'status'
    ];
    public function event(){
        return $this->belongsTo('App\Models\Event','event_id');
    }
    public function workshop(){
        return $this->belongsTo('App\Models\workshop','workshop_id');
    }
}
