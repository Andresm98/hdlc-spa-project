<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sacrament extends Model
{
    //  Variable para asignacion masiva
    protected $guarded = [];

    use HasFactory;


    /**
     *
     * Crear las relaciones a nivel de modelo
     *
     */

    // Relaciones varios a varios

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    // Relaciones uno a uno


}
