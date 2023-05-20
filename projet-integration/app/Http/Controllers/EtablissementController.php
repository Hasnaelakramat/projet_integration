<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Etablissement;
use Illuminate\Http\Request;

class EtablissementController extends Controller
{
    public function index()
    {
        $etablissements = Etablissement::all();
        return response()->json($etablissements);
    }

    public function store(Request $request)
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
        return response()->json($etablissement, 201);
    }

    public function show(Etablissement $etablissement)
    {
        return response()->json($etablissement);
    }

    public function update(Request $request, Etablissement $etablissement)
    {
        $request->validate([
            'code' => 'required|unique:etablissements,code,' . $etablissement->id,
            'nom' => 'required',
            'telephone' => 'required',
            'faxe' => 'nullable',
            'ville' => 'required',
            'nbr_enseignants' => 'required|integer',
        ]);

        $etablissement->update($request->all());
        return response()->json($etablissement, 200);
    }

    public function destroy(Etablissement $etablissement)
    {
        $etablissement->delete();
        return response()->json(null, 204);
    }
}
