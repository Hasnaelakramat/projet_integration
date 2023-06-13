<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'id_intervenant',
        'id_etab',
        'vh',
        'taux_H',
        'brut',
        'ir',
        'net',
        'annee_univ',
        'semestre'
    ];

    public function intervenant() {
        return $this->belongsTo(Enseignant::class, 'id_intervenant');
    }

    public function etablissement() {
        return $this->belongsTo(Etablissement::class, 'id_etab');
    }
}
