<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adhesion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cin',
        'photo',
        'card',
        'phone',
        'password',
        'email',
        'country',
        'city',
        'education',
        'job',
    ];
}
