<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'designation',
        'charge_statutaire',
        'taux_horaire_vacation'
    ];

    public function enseignants() {
        return $this->hasMany(Enseignant::class);
    }
}
