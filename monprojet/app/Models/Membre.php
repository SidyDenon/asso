<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Membre extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cin',
        'email',
        'phone',
        'password',
        'country',
        'city',
        'education',
        'profession'
    ];

    protected $hidden = [
        'password',
    ];
    
}
