<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;$change = 0;
class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
//     public function index()
// {
//     $enseignants = Enseignant::join('users', 'enseignants.id_user', '=', 'users.id_user')
//         ->select('enseignants.nom', 'enseignants.prenom', 'users.email')
//         ->get();

//     return response()->json($enseignants);
// }




//cette methode contien les info qui va afficher just au prof (user)
public function indexProf(){
    $enseignants = Enseignant::join('users', 'enseignants.id_user', '=', 'users.id_user')
        ->select(
            'enseignants.nom',
            'enseignants.prenom',
            'enseignants.date_nais',
            'enseignants.etablissement',
            'enseignants.id_grade',
            'users.email'
            )->get();
    return response()->json($enseignants);
}
// cette methode afficher les info  
public function indexEtab(){
    $enseignants = Enseignant::join('users', 'enseignants.id_user', '=', 'users.id_user')
        ->select(
            'enseignants.nom',
            'enseignants.prenom',
            'enseignants.date_nais',
            'enseignants.etablissement',)->get();
    return response()->json($enseignants);
}
    /**
     * Store a newly created resource in storage.
     */


     //version 1   (sans user)


     //la methode principale faire oar (Karima) 
    public function store(Request $request)
{
     
    $enseignants = Enseignant::join('users', 'enseignants.id_user', '=', 'users.id_user')
    ->select(
            'enseignants.nom',
            'enseignants.prenom',
            'enseignants.date_nais',
            'enseignants.etablissement',
            'enseignants.id_grade',
            'users.email',
            'users.type')->get();
    $enseignant = new Enseignant();
    $enseignant->ppr = $request->ppr;
    $enseignant->nom = $request->nom;
    $enseignant->prenom = $request->prenom;
    $enseignant->date_nais = $request->date_nais;
    $enseignant->etablissement = $request->etablissement;
    $enseignant->id_grade = $request->id_grade;
    $enseignant->id_user = $request->id_user;
    $enseignant->save();
    return response()->json(['message' => 'Enseignant created successfully', 'enseignant' => $enseignant], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Enseignant::find($id));
    }

    /**
     * Update the specified resource in storage.
     */


     ///////////////version 1 /////////////

    // public function update(Request $request, string $id)
    // {
    //     $enseignant = Enseignant::findOrFail($id);
        
    //     // Validation des données
    //     $validator = Validator::make($request->all(), [
    //         'ppr' => 'required|unique:enseignants,ppr,'.$id,
    //         'nom' => 'required',
    //         'prenom' => 'required',
    //         'date_nais' => 'required|date',
    //         'etablissement' => 'required|exists:etablissements,id',
    //         'id_grade' => 'required|exists:grades,id_grade',
    //         'id_user' => 'required|exists:users,id_user',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 400);
    //     }
        
    //     // Mettre à jour les données de l'enseignant
    //     $enseignant->ppr = $request->ppr;
    //     $enseignant->nom = $request->nom;
    //     $enseignant->prenom = $request->prenom;
    //     $enseignant->date_nais = $request->date_nais;
    //     $enseignant->etablissement = $request->etablissement;
    //     $enseignant->id_grade = $request->id_grade;
    //     $enseignant->id_user = $request->id_user;
    //     $enseignant->save();

    //     return response()->json(['message' => 'Enseignant updated successfully', 'enseignant' => $enseignant], 200);
    // }

    


    public function updateEnseignant(Request $request, string $id)
    {
        $enseignant = Enseignant::findOrFail($id);
        
        // Valider les données
        $validator = Validator::make($request->all(), [
            'ppr' => 'required|unique:enseignants,ppr,'.$id,
            'nom' => 'required',
            'prenom' => 'required',
            'date_nais' => 'required|date',
            'etablissement' => 'required|exists:etablissements,id',
            'id_grade' => 'required|exists:grades,id_grade',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        // Mettre à jour les données de l'enseignant   
        $enseignant->ppr = $request->ppr;
        $enseignant->nom = $request->nom;
        $enseignant->prenom = $request->prenom;
        $enseignant->date_nais = $request->date_nais;
        $enseignant->etablissement = $request->etablissement;
        $enseignant->id_grade = $request->id_grade;
        $enseignant->save();

        // Exécuter la méthode pour mettre à modifier l'email de l'utilisateur si nécessaire
        if ($request->has('email')) {
            $this->updateUserEmail($enseignant->id_user, $request->email);
        }

        return response()->json(['message' => 'Enseignant updated successfully', 'enseignant' => $enseignant], 200);
    }

    public function updateUserEmail(int $userId, string $email)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Mettre à jour l'email de l'utilisateur
        $user->email = $email;
        $user->save();

        return response()->json(['message' => 'User email updated successfully', 'user' => $user], 200);
    }





   //////version 2 /// ne fonction pas 
    // public function update(Request $request, $id)
    // {
    //     // Valider les données de la requête
    //     $request->validate([
    //         'nom' => 'required',
    //         'prenom' => 'required',
    //         'date_nais' => 'required|date',
    //         'email' => 'required',
    //     ]);
    
    //     // Récupérer l'enseignant à mettre à jour avec la jointure sur la table 'users'
    //     $enseignant = Enseignant::join('users', 'enseignants.id_user', '=', 'users.id')
    //         ->where('enseignants.id', $id)
    //         ->select('enseignants.*', 'users.email')
    //         ->first();
    
    //     if (!$enseignant) {
    //         return response()->json(['message' => 'Enseignant non trouvé'], 404);
    //     }
    
    //     // Mettre à jour les données de l'enseignant
    //     $enseignant->nom = $request->nom;
    //     $enseignant->prenom = $request->prenom;
    //     $enseignant->date_nais = $request->date_nais;
    //     $enseignant->email = $request->email;
    //     $enseignant->save();
    
    //     // Mettre à jour l'email de l'utilisateur dans la table 'users'
    //     $user = User::find($enseignant->id_user);
    //     $user->email = $request->email;
    //     $user->save();
    
    //     return response()->json(['message' => 'Enseignant mis à jour avec succès']);
    // }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enseignant = Enseignant::find($id);

        if (!$enseignant) {
            return response()->json(['message' => 'Enseignant not found'], 404);
        }

        $enseignant->delete();
        return response()->json(['message' => 'Enseignant deleted successfully'], 200);
    }}

