<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membre;
use App\Models\Evenement;
use App\Models\Cotisation;
use App\Models\Paiement;

class DashboardController extends Controller
{
    public function stats()
    {
        $membresCount = Membre::count();
        $evenementsCount = Evenement::count();
        $cotisationsTotal = Cotisation::sum('montant');
        $paiementsTotal = Paiement::sum('montant_paye');

        return response()->json([
            'membres' => Membre::count(),
            'evenements' => Evenement::count(),
            'total_paiements' => Paiement::sum('montant_paye'),
            'total_cotisations' => Cotisation::sum('montant'),
            'debug' => [
                'membres_rows' => Membre::all(),
                'evenements_rows' => Evenement::all(),
            ]
        ]);
    }
}
