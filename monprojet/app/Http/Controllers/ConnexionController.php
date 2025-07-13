<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adhesion;
use Illuminate\Support\Facades\Hash;

class ConnexionController extends Controller
{
  public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = Adhesion::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'Email non trouvé'], 401);
    }

    if (!Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Mot de passe incorrect'], 401);
    }

    // Si tu n'as pas encore de champ role dans ta table, ajoute-le sinon renvoie null
    $role = $user->role ?? 'membre'; // Par défaut 'membre'

    return response()->json([
        'message' => 'Connexion réussie',
        'role' => $role,
        'userId' => $user->id,  // Renvoie l'ID pour la redirection dynamique
    ]);
}
}
