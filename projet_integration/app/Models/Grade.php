<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $primaryKey='id_grade';
    const UPDATED_AT=NULL;
    const CREATED_AT=NULL;

    public function enseignants() {
        return $this->hasMany(Enseignant::class);
    }
}
