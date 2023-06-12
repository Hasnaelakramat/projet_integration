<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\Enseignant;
use App\Models\Etablissement;
use Illuminate\Http\Request;
use App\Traits\httpresponses;
use Illuminate\Support\Facades\Auth;


class EtablissementController extends Controller
{
    use httpresponses;
    /**
     * Display a listing of the resource.
     */
    public function indexetab()
    {
             $etablissements = Etablissement::select('nom', 'telephone', 'faxe','ville')->get();
            return response()->json($etablissements);
      }

      public function add_etab(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:etablissements',
            'nom' => 'required',
            'telephone' => 'required',
            'faxe' => 'nullable',
            'ville' => 'required',
            'nbr_enseignants' => 'required|integer',
        ]);

        $etablissement = Etablissement::create($request->all());
       return $this->success([$etablissement],'the request was successful',200);
    }

    public function show_etab(int $id_etab)
    {
        $etablissement=Etablissement::findorfail($id_etab);
        $etablissement->makeHidden(['id_etab', 'code','created_at','updated_at']);
        return response()->json($etablissement);
    }
    public function update_etab(Request $request, int $id_etab)
    {
        $user = Auth::user();
    
        if ($user->type === 0 || $user->type === 1) {
            $request->validate([
                'code' => 'required|unique:etablissements,code,' . $id_etab . ',id_etab',
                'nom' => 'required',
                'telephone' => 'required',
                'faxe' => 'nullable',
                'ville' => 'required',
                'nbr_enseignants' => 'required|integer',
            ]);
    
            $etablissement = Etablissement::findOrFail($id_etab);
            $etablissement->update($request->all());
    
            return response()->json($etablissement, 200);
        }
    
        $admin_etab = Administrateur::join('users', function ($join) {
            $join->on('administrateurs.id_user', '=', 'users.id_user')
                ->where('users.id_user', '=', Auth::user()->id_user);
        })->value('administrateurs.id_etab');
    
        if ($id_etab != $admin_etab) {
            return response()->json(['message' => 'page not found'], 404);
        }
    
        $request->validate([
            'code' => 'required|unique:etablissements,code,' . $id_etab . ',id_etab',
            'nom' => 'required',
            'telephone' => 'required',
            'faxe' => 'nullable',
            'ville' => 'required',
            'nbr_enseignants' => 'required|integer',
        ]);
    
        $etab = Etablissement::find($id_etab);
        if (!$etab) {
            return $this->error('Invalid etablissement ID');
        }
    
        $etab->update($request->all());
        return response()->json($etab, 200);
    }
    



    /**
     

    /**
     * Store a newly created resource in storage.
     */
  

    /**
     * Display the specified resource.
     */
    
}
