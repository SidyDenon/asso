<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = ['membre_id', 'cotisation_id', 'montant_paye', 'date_paiement', 'mode_paiement'];

    public function membre()
    {
        return $this->belongsTo(Membre::class);
    }

    public function cotisation()
    {
        return $this->belongsTo(Cotisation::class);
    }
}

