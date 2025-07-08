<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    /**
     * Retourne les cotisations actives à la date d'aujourd'hui
     * GET /api/cotisations/disponibles
     */
    public function cotisationsDisponibles()
    {
        $today = now()->toDateString(); // Plus propre que date('Y-m-d')

        $cotisations = Cotisation::select('id', 'nom', 'montant', 'date_debut', 'date_fin', 'statut')
            ->where('date_debut', '<=', $today)
            ->where('date_fin', '>=', $today)
            ->get();

        return response()->json($cotisations);
    }

    /**
     * Crée une nouvelle cotisation
     * POST /api/cotisations
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nombre_participants' => 'required|integer|min:1',
            'montant' => 'required|numeric|min:0.01',
            'statut' => 'required|in:Mensuelle,Annuelle,Événementielle',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $cotisation = Cotisation::create($validated);
        return response()->json($cotisation, 201);
    }

    /**
     * Affiche une cotisation par ID
     * GET /api/cotisations/{id}
     */
    public function show($id)
    {
        $cotisation = Cotisation::find($id);

        if (!$cotisation) {
            return response()->json(['message' => 'Cotisation non trouvée'], 404);
        }

        return response()->json($cotisation, 200);
    }

    /**
     * Met à jour une cotisation
     * PUT /api/cotisations/{id}
     */
    public function update(Request $request, $id)
    {
        $cotisation = Cotisation::find($id);

        if (!$cotisation) {
            return response()->json(['message' => 'Cotisation non trouvée'], 404);
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nombre_participants' => 'required|integer|min:1',
            'montant' => 'required|numeric|min:0.01',
            'statut' => 'required|in:Mensuelle,Annuelle,Événementielle',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $cotisation->update($validated);
        return response()->json($cotisation, 200);
    }

    /**
     * Supprime une cotisation
     * DELETE /api/cotisations/{id}
     */
    public function destroy($id)
    {
        $cotisation = Cotisation::find($id);

        if (!$cotisation) {
            return response()->json(['message' => 'Cotisation non trouvée'], 404);
        }

        $cotisation->delete();
        return response()->json(['message' => 'Cotisation supprimée avec succès.'], 200);
    }
    /**
 * Liste toutes les cotisations
 * GET /api/cotisations
 */
public function index()
{
    try {
        $cotisations = Cotisation::all();
        return response()->json($cotisations, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Erreur lors du chargement des cotisations : ' . $e->getMessage()], 500);
    }
}

}
