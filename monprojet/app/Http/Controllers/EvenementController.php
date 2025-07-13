<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        return Evenement::orderBy('date', 'desc')->get();
         return response()->json(Evenement::all());
    }


    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date' => 'required|date',
            'statut' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        $evenement = Evenement::create($request->all());

        return response()->json($evenement, 201);
    }

    public function show($id)
    {
        $evenement = Evenement::findOrFail($id);
        return response()->json($evenement);
    }

    public function update(Request $request, $id)
    {
        $evenement = Evenement::findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date' => 'required|date',
            'statut' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        $evenement->update($request->all());

        return response()->json($evenement);
    }

    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();

        return response()->json(null, 204);
    }
}
