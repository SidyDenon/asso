<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Membre;
use App\Models\Cotisation;
use App\Models\Adhesion;

class PaiementController extends Controller
{
    // 🔹 Liste de tous les paiements avec relations
    public function index()
    {
        return Paiement::with(['membre', 'cotisation'])->get();
    }

    // 🔹 Ajouter un paiement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'membre_id' => 'required|exists:membres,id',
            'cotisation_id' => 'required|exists:cotisations,id',
            'montant_paye' => 'required|numeric',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required|string|max:255',
        ]);

        return Paiement::create($validated);
    }

    // 🔹 Modifier un paiement
    public function update(Request $request, $id)
    {
        $paiement = Paiement::findOrFail($id);

        $validated = $request->validate([
            'membre_id' => 'required|exists:membres,id',
            'cotisation_id' => 'required|exists:cotisations,id',
            'montant_paye' => 'required|numeric',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required|string|max:255',
        ]);

        $paiement->update($validated);
        return $paiement;
    }

    // 🔹 Supprimer un paiement
    public function destroy($id)
    {
        return Paiement::destroy($id);
    }

    // 🔹 Liste des membres ayant une adhésion
    public function membres()
    {
        return Membre::whereIn('id', Adhesion::pluck('membre_id'))->get(['id', 'nom']);
    }

    // 🔹 Liste des cotisations
    public function cotisations()
    {
        return Cotisation::all(['id', 'nom', 'montant', 'date_debut', 'date_fin']);
    }

    // 🔹 Paiements d’un membre spécifique
   public function paiementsParMembre($membreId)
{
    $paiements = Paiement::where('membre_id', $membreId)->with('cotisation')->get();
    return response()->json($paiements, 200);
}


}
