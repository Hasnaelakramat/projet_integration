<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\Enseignant;
use App\Models\User;
use App\Traits\httpresponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;$change = 0;

//just for administrators and uae not for teachers
class EnseignantController extends Controller
{
    use httpresponses;

//cette methode contien les info qui va afficher just au prof (user)
public function indexProf(){
    $user=Auth::user();
    $accesslevel=$user->type;
    if($accesslevel===0 || $accesslevel===1)
    {
        $enseignants = Enseignant::join('users', 'enseignants.id_user', '=', 'users.id_user')
        ->select(
            'enseignants.nom',
            'enseignants.prenom',
            'enseignants.date_nais',
            'enseignants.id_etab',
            'enseignants.id_grade',
            'users.email'
            )->get();
    return response()->json($enseignants);
}
$id_etab = Administrateur::join('users', function ($join) {
    $join->on('administrateurs.id_user', '=', 'users.id_user')
         ->where('users.id_user', '=', Auth::user()->id_user);})->value('administrateurs.id_etab');
$enseignants=Enseignant::where('id_etab',$id_etab)->get();
return response()->json($enseignants);
} 




public function show_prof(string $id_prof)
    {
      $Accesslevel=Auth::user()->type;
      if($Accesslevel===0 || $Accesslevel===1)
      {
        $enseignant=Enseignant::findorfail($id_prof);
        return response()->json($enseignant);
      }
      $id_etab = Administrateur::join('users', function ($join) {
        $join->on('administrateurs.id_user', '=', 'users.id_user')
             ->where('users.id_user', '=', Auth::user()->id_user);})->value('administrateurs.id_etab');
             $enseignant=Enseignant::findorfail($id_prof);
             if($enseignant->id_etab != $id_etab)
             {
                return response()->json('page not found ',404);
             }
     return $this->success($enseignant,200);

        
    }

    public function updateEnseignant(Request $request, string $id)
    {
        
        // Valider les donnée
        $validator = Validator::make($request->all(), [
            'nom' => 'filled',
            'prenom' => 'filled',
            'date_nais' => 'filled|date',
            'etablissement' => 'filled|exists:etablissements,id',
            'id_grade' => 'filled|exists:grades,id_grade'
        ]);
            // 'ppr' => 'required|unique:enseignants,ppr,'.$id,
        
      if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $enseignant = Enseignant::findOrFail($id);
       
        $user=Auth::user();
        if($user->type=== 0 || $user->type=== 1)
        { 
            $enseignant->fill($request->only(['nom', 'prenom', 'date_nais', 'etablissement', 'id_grade']));
     if ($request->has('email')) {
        $this->updateEnseignantEmail($enseignant->id_user, $request->email);
    }
     return $this->success($enseignant,User::find($enseignant->id_user),200);
}
// the user is an administrator we check if he's an admin in the etab 
//where the teacher belongs to know if he can update it or not

        $id_etab = Administrateur::join('users', function ($join) {
          $join->on('administrateurs.id_user', '=', 'users.id_user')
               ->where('users.id_user', '=', Auth::user()->id_user);})->value('administrateurs.id_etab');
               if($enseignant->id_etab !=$id_etab )
               {
                  return response()->json("you are not an administrator in this university you can't update anyone",401);
               }
        
        // Mettre à jour les données de l'enseignant   
      // mettre a jour seulement les champs non vide comme cela l'utilisateur va pas etre obligee a 
      //remplir tous les champs.
      
        $enseignant->fill($request->only(['nom', 'prenom', 'date_nais', 'etablissement', 'id_grade']));

        // Exécuter la méthode pour mettre à modifier l'email de l'utilisateur si nécessaire
        if ($request->has('email') && $request->input('email') != NULL) {
            $this->updateEnseignantEmail($enseignant->id_user, $request->email);
        }

        return response()->json(['message' => 'Enseignant updated successfully', 'enseignant' => $enseignant,'credentiels'=>User::find($enseignant->id_user)],200);
    }

   
   

    public function updateEnseignantEmail(int $userId, string $email)
{
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $isExistEmailAlready = User::where('email', $email)->exists();
    if (!$isExistEmailAlready) {
        $user->email = $email;
        $user->save();
        return response()->json(['message' => 'User email updated successfully', 'user' => $user], 200);
    }

    return response()->json(['message' => 'Email already exists'], 400);
}


    public function destroy_Enseignant(string $id)
    {
        $enseignant = Enseignant::find($id);

        if (!$enseignant) {
            return response()->json(['message' => 'Enseignant not found'], 404);
        }
     $id_etab = Administrateur::join('users', function ($join) {
        $join->on('administrateurs.id_user', '=', 'users.id_user')
             ->where('users.id_user', '=', Auth::user()->id_user);})->value('administrateurs.id_etab');
             if($enseignant->id_etab !=$id_etab )
             {
                return response()->json("you are not an administrator in this university you can't delete anyone",401);
             }

        $enseignant->delete();
        return response()->json(['message' => 'Enseignant deleted successfully'], 200);
    }

    
}




