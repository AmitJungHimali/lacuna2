<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailverification extends Model
{
    use HasFactory;
    protected $fillable=[
        'otpToken',
        'status',
        'user_id'
    ];
    public function user(){
        return $this->hasOne('App\Models\User','user_id');
    }
}
