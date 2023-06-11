<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Http\Requests\StoreInterventionRequest;
use App\Http\Requests\UpdateInterventionRequest;
use App\Models\Administrateur;
use App\Models\Enseignant;
use App\Models\Etablissement;
use App\Traits\httpresponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
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
                'interventions.id_etab as id_etab',
                'enseignants.id_enseign',
            )
            ->get();
    
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
        if($intervention->visa_uae===true)
        {
// seft lih mail fih message bli tvalidat l'intervenion dyalo mn 3and l'uae
        }
        else{
            // seft lih mail goulih bli l'uae hayedat lvalidation 
        }


     return response()->json('the request was successful',200);
    }

    public function visa_etab($interventionId)
    {
        $intervention = Intervention::findOrFail($interventionId);
        $intervention->visa_etab = !$intervention->visa_etab ;
        $intervention->save();
if($intervention->visa_etab)
{
    //seft lih mail bli rah administrateur wafe9 3la l'intervention
}
    else{
        //seft lih mail bli rah administrateur  mab9ach mwafe9 3la l'intervention
    }
    return response()->json('the request was successful',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // Valider les données de la requête




    public function store(Request $request)
{
    // Valider les données de la requête
    $validatedData = $request->validate([
        'ppr' => 'required',
        'intitule_intervention' => 'required',
        'annee_univ' => 'required',
        'semestre' => 'required',
        'date_debut' => 'required',
        'date_fin' => 'required',
        'nbr_heures' => 'required',
    ]);

    // Trouver l'enseignant correspondant au PPR donné
    $enseignant = Enseignant::where('ppr', $validatedData['ppr'])->first();

    if (!$enseignant) {
        return response()->json(['message' => 'Enseignant not found'], 404);
    }

    // Récupérer l'établissement associé à l'enseignant
    $etablissement = Etablissement::find($enseignant->id_etab);

    if (!$etablissement) {
        return response()->json(['message' => 'Etablissement not found for the enseignant'], 404);
    }

    // Ajouter l'ID de l'établissement aux données validées
    $validatedData['id_etab'] = $etablissement->id_etab;

    // Créer un nouvel enregistrement d'intervention avec les données validées
    $intervention = Intervention::create($validatedData);

    // Retourner une réponse indiquant le succès de l'opération
    return response()->json([
        'message' => 'Intervention created successfully',
        'data' => $intervention
    ], 201);
}

}
