<?php

namespace App\Http\Controllers;

use App\Http\Requests\intervention_request;
use App\Http\Requests\interventionrequest;
use App\Models\Intervention;
use App\Http\Requests\StoreInterventionRequest;
use App\Http\Requests\UpdateInterventionRequest;
use App\Mail\InterventionEtabValidated;
use App\Mail\InterventionValidated;
use App\Mail\ValidationRemoved;
use App\Models\Administrateur;
use App\Models\Enseignant;
use App\Models\Etablissement;
use App\Traits\httpresponses;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use httpresponses;
    public function index()
    {
        $user = Auth::user();
        $interventions = Intervention::join('enseignants', 'interventions.id_enseign', '=', 'enseignants.id_enseign')
            ->join('etablissements', 'etablissements.id_etab', '=', 'enseignants.id_etab')
            ->select(
                'intitule_intervention',
                'annee_univ',
                'semestre',
                'date_debut',
                'date_fin',
                'nbr_heures',
                'visa_etab',
                'visa_uae',
                'enseignants.nom as nomEnseignant',
                'enseignants.prenom',
                'etablissements.nom',
                'interventions.id_etab as id_etab'
            )
            ->get()->makeHidden('id_etab');
    
        if ($user->type === 0 || $user->type === 1) {
            if ($interventions->isNotEmpty()) {
                return response()->json([
                    'interventions' => $interventions
                ], 200);
            } else {
                return response()->json([
                    'message' => 'No interventions found.'
                ], 404);
            }
        }
    
        if ($user->type === 2 || $user->type === 3) {
            $id_etab = Administrateur::join('users', function ($join) use ($user) {
                $join->on('administrateurs.id_user', '=', 'users.id_user')
                    ->where('users.id_user', '=', $user->id_user);
            })->value('administrateurs.id_etab');
    
            $filteredInterventions = $interventions->filter(function ($intervention) use ($id_etab) {
                return $intervention->id_etab === $id_etab;
            });
    
            if ($filteredInterventions->isEmpty()) {
                return response()->json('sorry admin No interventions found.', 404);
            }
    
            return $this->success($filteredInterventions, 200);
        }

        // The user must be a teacher
        $enseignant = Enseignant::where('id_user', $user->id_user)->first();

        if ($enseignant) {
            $id_enseignant = $enseignant->id_enseign;
            $filteredInterventions = $interventions->filter(function ($intervention) use ($id_enseignant) {
                return $intervention->id_enseign == $id_enseignant;
            });
        
            if ($filteredInterventions->isEmpty()) {
                return response()->json('No interventions found.', 404);
            }
        
            return $this->success($filteredInterventions, 200);
        }
        
        return $this->error('Page not found.', 404);
    }
    

 
    
    // public function allInterventions()
    // {
    //     // Logique pour récupérer toutes les interventions avec les informations de l'enseignant et de l'établissement correspondants
    //     $interventions = Intervention::join('enseignants', 'interventions.id_enseign', '=', 'enseignants.id_enseign')
    //         ->join('etablissements', 'etablissements.id_etab', '=', 'enseignants.id_etab')
    //         ->select('interventions.*', 'enseignants.nom as nomEnseignant', 'enseignants.prenom', 'etablissements.nom')
    //         ->get();
    
    //     return response()->json([
    //         'interventions' => $interventions
    //     ]);
    // }


    // public function showEnseignantInterventions()
    // {
    //     $enseignant = Auth::user()->enseignant;

    //     // Logique pour récupérer les interventions de l'enseignant
    //     $interventions = $enseignant->interventions;

    //     return response()->json([
    //         'interventions' => $interventions
    //     ]);
    // }
    public function visa_uae($interventionId)
    {
        $intervention = Intervention::findOrFail($interventionId);
        $intervention->visa_uae = !$intervention->visa_uae;
        $intervention->save();
     
       /*   if ($intervention->enseignant->user === null) {
            return response()->json([
                'message' => 'Aucun enseignant associé à cette intervention.',
            ]);
        } */
        $intervenerEmail = $intervention->enseignant->user->email;
         if($intervention->visa_uae===true)
       {
           
            Mail::to($intervenerEmail)->send(new InterventionValidated($intervention));         
        } 
        else{
            Mail::to($intervenerEmail)->send(new ValidationRemoved($intervention));
       }
     return response()->json('the request was successful',200);
    
   }

    public function visa_etab($interventionId)
    {
       $intervention = Intervention::findOrFail($interventionId);
       $intervention->visa_etab = !$intervention->visa_etab ;
       $intervention->save();
       $intervenerEmail = $intervention->enseignant->user->email;
       if($intervention->visa_etab)
        { 
           Mail::to($intervenerEmail)->send(new InterventionEtabValidated($intervention));         }
       else{
           Mail::to($intervenerEmail)->send(new InterventionEtabValidated($intervention));
       }
       return response()->json('the request was successful',200);
       }


    /**
     * Show the form for creating a new resource.
     */
  
     public function add_intervention(Request $request)
     {
         $validatedData = $request->validate([
             'ppr' => 'required',
             'intitule_intervention' => 'required',
             'annee_univ' => 'required',
             'semestre' => 'required',
             'date_debut' => 'required',
             'date_fin' => 'required',
             'nbr_heures' => 'required',
         ]);
     
         
        $enseignants=Enseignant::All();

    foreach($enseignants as $enseignant)
    {
        if($enseignant->ppr===$validatedData['ppr'])
        {
           $id_enseign=$enseignant->id_enseign;
           $id_etab = Administrateur::join('users', function ($join) {
            $join->on('administrateurs.id_user', '=', 'users.id_user')
                 ->where('users.id_user', '=', Auth::user()->id_user);})->value('administrateurs.id_etab');
        $validatedData['id_enseign']=$id_enseign;
        $validatedData['id_etab']=$id_etab;
        $intervention=Intervention::create($validatedData);
        return response()->json($intervention,200);
    
        }
    }
    
return response()->json('error',401);
    }
     
       
    function update_intervention($id_intervention)
    {



        $intervention = Intervention::findOrFail($id_intervention)
            ->join('etablissements', 'interventions.id_etab', '=', 'etablissements.id_etab')
            ->join('enseignants', 'interventions.id_enseign', '=', 'enseignants.id_enseign')
            ->select(
                'interventions.intitule_intervention',
                'interventions.annee_univ',
                'interventions.semestre',
                'interventions.date_debut',
                'interventions.date_fin',
                'interventions.nbr_heures',
                'enseignants.id_enseign as id_enseign',
                'etablissements.nom'
            )
            ->first()->makeHidden('id_enseign');
        
        if ($intervention && $intervention->visa_uae!=true) {
            $enseignant = Enseignant::findOrFail($intervention->id_enseign);
            $ppr = $enseignant->ppr;
            $intervention->ppr = $ppr;
          
            return response()->json($intervention, 200);
        } else {
            return response()->json(['message' => 'Intervention not found or you\'re not authorized'], 404);
        }
    }
    

    
    
    
function edit_db_intervention(request $request,$id_intervention)
{
   
$validated=$request->validate([
            'ppr' => 'required',
            'intitule_intervention' => 'required',
            'annee_univ' => 'required',
            'semestre' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'nbr_heures' => 'required',
]);
$intervention=Intervention::findorfail($id_intervention);
if($intervention->visa_uae!=True){
    $enseignants=Enseignant::all();
foreach($enseignants as $enseignant)
{
    if($validated['ppr']===$enseignant->ppr)
    {
    
         $id_etab = Administrateur::join('users', function ($join) {
            $join->on('administrateurs.id_user', '=', 'users.id_user')
                 ->where('users.id_user', '=', Auth::user()->id_user);})->value('administrateurs.id_etab');
           $validated['id_enseign']=$enseignant->id_enseign;
           $validated['id_etab']=$id_etab;
           unset($validated['ppr']);
           $intervention->update($validated);
                 return response()->json($intervention,200);


                }
}
return response()->json('no intervenant with this ppr',401);
}
return response()->json('you are not authorized',401);
}


public function destroy($interventionId)
{
    // Trouver l'intervention à supprimer
    $intervention = Intervention::findOrFail($interventionId);

    // Supprimer l'intervention
    $intervention->delete();

    // Retourner une réponse indiquant le succès de l'opération
    return response()->json([
        'message' => 'Intervention deleted successfully'
    ], 200);
}

}
