<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;
    protected $primaryKey='id_intervention';
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
     const created_at=null;
     const updated_at=null;

    public function enseignant(){
        return $this->belongsTo(Enseignant::class, 'id_enseign');
    }
    

    public function etablissement() {
        return $this->belongsTo(Etablissement::class, 'id_etab');
    }
}
