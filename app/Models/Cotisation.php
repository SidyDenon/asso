<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;

    protected $fillable = [
    'nom',
    'nombre_participants',
    'montant',
    'statut',
    'date_debut',
    'date_fin'
];

}
