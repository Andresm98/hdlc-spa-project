<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sacrament extends Model
{
    //  Variable para asignacion masiva
    protected $guarded = [];

    use HasFactory;


    const BAUTISMO = 1;
    const PENITENCIA = 2;
    const EUCARISTIA = 3;
    const CONFIRMACION = 4;
    const ORDENSACERDOTAL = 5;
    const MATRIMONIO = 6;
    const UNIONENFERMOS = 7;
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
