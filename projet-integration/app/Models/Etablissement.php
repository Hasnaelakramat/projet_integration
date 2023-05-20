<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $fillable = [
        'code',
        'nom',
        'telephone',
        'faxe',
        'ville',
        'nbr_enseignants'
    ];

    public function administrateurs() {
        return $this->hasMany(Administrateur::class);
    }

    public function enseignants() {
        return $this->hasMany(Enseignant::class);
    }
    public function interventions() {
        return $this->hasMany(Intervention::class, 'id_etab');
    }
}
