<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
{
    $user = Auth::user();

    if ($user->type === 0 || $user->type === 1) {
        $profile = User::find($user->id_user)->makeHidden(['id_user', 'type', 'created_at', 'updated_at']);

        return response()->json($profile, 200);
    }

    if ($user->type === 2 || $user->type === 3) {
        $profile = Administrateur::join('users', 'users.id_user', '=', 'administrateurs.id_user')
            ->join('etablissements', 'administrateurs.id_etab', '=', 'etablissements.id_etab')
            ->where('users.id_user', Auth::user()->id_user)
            ->select('administrateurs.ppr', 'administrateurs.nom','users.email','administrateurs.prenom', 'etablissements.nom')
            ->get();

        return response()->json($profile, 200);
    }

    $profile = Enseignant::join('users', 'users.id_user', '=', 'enseignants.id_user')
    ->join('etablissements', 'enseignants.id_etab', '=', 'etablissements.id_etab')->
    join('grades','enseignants.id_grade', '=', 'grades.id_grade')
    ->where('users.id_user', Auth::user()->id_user)
    ->select('enseignants.ppr', 'enseignants.nom','users.email', 'enseignants.prenom','grades.designation as grade', 'etablissements.nom')
    ->get();

    return response()->json($profile, 200);
}

    public function update_password(request $request )
    {
$request->validate([
    'password'=>'required|min:8'
]);
        $user=User::findorfail(Auth::User()->id_user);
        $user->password=$request->input('password');
        $user->save();
       
    }

   
}
