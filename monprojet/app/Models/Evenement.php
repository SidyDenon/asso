<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'lieu', 'date', 'statut', 'description'];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}
