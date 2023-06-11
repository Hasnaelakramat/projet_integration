<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;
  protected $fillable=[
        'ppr',
        'nom',
        'prenom',
        'id_etab',
        'id_user'
    ];
    const UPDATE_AT=NULL;
    public function etablissement(){
        return $this->belongsTo(Etablissement::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
