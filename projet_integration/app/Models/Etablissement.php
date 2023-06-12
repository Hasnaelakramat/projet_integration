<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;

    protected $primaryKey ='id_etab';
    protected $fillable=['nom','code','faxe','ville','telephone','nbr_enseignants'];
    CONST UPDATED_AT=NULL;
    CONST CREATED_AT=NULL;
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