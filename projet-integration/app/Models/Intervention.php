<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
        protected $fillable = [
            'intitule_intervention',
            'annee_univ',
            'semestre',
            'date_debut',
            'date_fin',
            'nbr_heures',
            'visa_etab',
            'visa_uae'
        ];
    
        public function intervenant() {
            return $this->belongsTo(Enseignant::class, 'id_intervenant');
        }
        
    
        public function etablissement() {
            return $this->belongsTo(Etablissement::class, 'id_etab');
        }
    
}
