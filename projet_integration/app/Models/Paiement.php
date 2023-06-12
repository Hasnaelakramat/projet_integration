<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $primaryKey = 'id_paiement';
    protected $fillable = [
        'id_intervenant',
        'id_etab',
        'vh',
        'brut',
        'ir',
        'net',
        'annee_univ',
        'semestre'
    ];

    public function intervention()
{
    return $this->belongsTo(Intervention::class, 'id_intervention', 'id_intervention');
}


    public function etablissement() {
        return $this->belongsTo(Etablissement::class);
    }
    public function enseignant()
{
    return $this->belongsTo(Enseignant::class, 'id_intervenant', 'id_enseign');
}

  
    public static function getPaiementsForEnseignant($enseignantId) {
        return self::where('id_intervenant', $enseignantId)->get();
    }
}