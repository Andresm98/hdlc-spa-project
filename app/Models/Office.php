<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    /**
     *
     * Relacion a nivel de Modelo
     *
     */


    //  Relacion uno a uno inversa

    public function transfers()
    {
        return $this->hasMany('App\Models\Transfer');
    }
}
