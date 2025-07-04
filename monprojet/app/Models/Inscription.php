<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $table = 'inscriptions'; // optionnel ici car le nom du modèle correspond déjà au nom de la table

    protected $fillable = ['membre_id', 'evenement_id'];

    public function evenement()
{
    return $this->belongsTo(Evenement::class);
}

public function membre()
{
    return $this->belongsTo(Membre::class);
}

}

