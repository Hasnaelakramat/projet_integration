<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $fillable = [
        'ppr',
        'nom',
        'prenom',
        'date_nais',
        'etablissement',
        'id_grade',
        'id_user',
        'email'
    ];

    public function etablissement() {
        return $this->belongsTo(Etablissement::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class, 'id_grade');
    }

    public function user() {
        return $this->hasOne(User::class);
    }
    public function paiements() {
        return $this->hasMany(Paiement::class, 'id_intervenant');
    }
    public function interventions() {
        return $this->hasMany(Intervention::class, 'id_intervenant');
    }
    
}
