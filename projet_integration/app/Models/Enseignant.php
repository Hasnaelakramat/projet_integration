<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $primaryKey='id_enseign';
    use HasFactory;
   
    protected $fillable=[
        'ppr',
        'nom',
        'prenom',
        'id_etab',
        'id_user',
        'date_nais',
        'id_grade'
    ];

    const UPDATED_AT=NULL;
    CONST CREATED_AT=NULL;

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
        return $this->hasMany(Interventions::class, 'id_intervenant');
    }

    // protected $hidden=[
    //     'ppr'
    // ];
    /**
 * The attributes that should be cast.
 *
 *  @var array
 */
protected $casts = [
    'ppr' => 'encrypted',
];

}