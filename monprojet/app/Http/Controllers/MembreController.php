<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    public function index()
    {
        return Membre::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'cin' => 'required',
            'email' => 'required|email|unique:membres,email',
            'phone' => 'required',
            'password' => 'required',
            'country' => 'nullable',
            'city' => 'nullable',
            'education' => 'nullable',
            'profession' => 'nullable',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $membre = Membre::create($validated);
        return response()->json($membre, 201);
    }

    public function show($id)
    {
        $membre = Membre::findOrFail($id);

        // Charger la relation adhesion si elle existe sans erreur
        $adhesion = null;
        if (method_exists($membre, 'adhesion')) {
            $adhesion = $membre->adhesion;
        }

        return response()->json([
            'membre' => $membre,
            'adhesion' => $adhesion
        ]);
    }

    public function update(Request $request, $id)
    {
        $membre = Membre::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'cin' => 'required',
            'email' => 'required|email|unique:membres,email,' . $id,
            'phone' => 'required',
            'password' => 'nullable',
            'country' => 'nullable',
            'city' => 'nullable',
            'education' => 'nullable',
            'profession' => 'nullable',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $membre->update($validated);
        return response()->json($membre);
    }

    public function destroy($id)
    {
        $membre = Membre::findOrFail($id);
        $membre->delete();

        return response()->json(['message' => 'Membre supprimé']);
    }
}
