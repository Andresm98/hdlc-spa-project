<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_title',
        'institution',
        'date_title',
        'observation',
        'level'
    ];
    /**
     *
     *  Crear relacion de uno  varios a nivel de Modelo
     *
     */

    // Relacion de uno a varios inversa

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
