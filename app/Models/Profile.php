<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     *
     * Crear relaciones a nivel de modelo
     *
     */

    //  Relación uno a uno inversa

    public function user()
    {
        // BELONG METODO PARA SETEAR LA CLAVE FORANEA
        // Campo especifico en Profile (user_id)
        return $this->belongsTo('App\Models\User');
    }

    // Relacion uno a uno


    public function  info_family()
    {
        return $this->hasOne('App\Models\InfoFamily');
    }

    /**
     *
     * Creacion relacion de uno a muchos a nivel de Modelo
     *
     */

    // Relacion uno a varios

    public function academic_trainings()
    {
        return $this->hasMany('App\Models\AcademicTraining');
    }

    public function transfers()
    {
        return $this->hasMany('App\Models\Transfer');
    }

    public function health()
    {
        return $this->hasMany('App\Models\Health');
    }

    // Relacion uno a varios

    public function sacraments()
    {
        return $this->hasMany('App\Models\Sacrament');
    }


    // Relacion uno a uno polimorfica inversa

    public function address()
    {
        return $this->morphOne('App\Models\Address', 'addressable');
    }
}
