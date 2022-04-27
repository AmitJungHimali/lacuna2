<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Userdetails extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'contact',
        'gender',
        'birthDate',
        'companyName',
        'user_id',
        'role_id',
        'profileImage'
    ];
}
