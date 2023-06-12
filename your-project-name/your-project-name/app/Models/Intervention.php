<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    // protected $primaryKey = 'id_intervention';

    protected $primaryKey = 'id_intervention';
        protected $fillable = [
            'intitule_intervention',
            'annee_univ',
            'semestre',
            'date_debut',
            'date_fin',
            'nbr_heures',
            'id_etab',
            'id_enseign'
        ];
    
        // public function intervenant() {
        //     return $this->belongsTo(Enseignant::class);
        // }
          
        public function enseignants()
    {
    return $this->hasMany(Enseignant::class);
}   

    
public function etablissement()
{
    return $this->belongsTo(Etablissement::class, 'id_etab', 'id_etab');
}

    
}