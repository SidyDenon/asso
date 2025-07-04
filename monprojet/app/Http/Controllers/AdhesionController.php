<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adhesion;
use Illuminate\Support\Facades\Hash;


class AdhesionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cin' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'country' => 'required|string',
            'city' => 'required|string',
            'education' => 'required|string',
            'job' => 'required|string',
            'password' => 'required|string',
            'photo' => 'nullable|file|image|max:2048',
            'card' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        // Sauvegarde des fichiers
        $photoPath = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null;
        $cardPath = $request->file('card') ? $request->file('card')->store('cards', 'public') : null;

        $adhesion = Adhesion::create([
    'name' => $request->name,
    'cin' => $request->cin,
    'phone' => $request->phone,
    'email' => $request->email,
    'password' => bcrypt($request->password), // ✅ ici !
    'country' => $request->country,
    'city' => $request->city,
    'education' => $request->education,
    'job' => $request->job,
    'photo' => $photoPath,
    'card' => $cardPath,
]);


        return response()->json(['message' => 'Adhésion enregistrée avec fichiers.'], 201);
    }
}
