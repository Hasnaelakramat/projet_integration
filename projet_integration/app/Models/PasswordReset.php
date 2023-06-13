<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    protected $table='Password_Reset_Tokens';
    protected $fillable=['email'];
    const UPDATED_AT=null;
}
