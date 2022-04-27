<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',

    ];
    public function userID(){
        return $this->belongsTo('App\ModelUser','user_id');
    }
}
