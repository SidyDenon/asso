<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;

class InscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'evenement_id' => 'required|exists:evenements,id',
            'membre_id' => 'required|exists:membres,id',
        ]);
        

        $existe = Inscription::where([
            ['evenement_id', $request->evenement_id],
            ['membre_id', $request->membre_id],
        ])->exists();

        if ($existe) {
            return response()->json(['message' => 'Déjà inscrit à cet événement.'], 409);
        }

        $inscription = Inscription::create([
            'evenement_id' => $request->evenement_id,
            'membre_id' => $request->membre_id,
        ]);

        return response()->json($inscription, 201);
    }

    public function mesInscriptions($membreId)
    {
        $inscriptions = Inscription::with('evenement')
            ->where('membre_id', $membreId)
            ->get();

        return response()->json($inscriptions);
    }
}
