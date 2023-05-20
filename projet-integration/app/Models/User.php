<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


    class User extends Model
{
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ]; 



    public function administrateur() {
        return $this->hasOne(Administrateur::class, 'id_user');
    }

    public function enseignant() {
        return $this->hasOne(Enseignant::class);
    }
}
