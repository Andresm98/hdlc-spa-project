<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    /**
     *
     * Relacion a nivel de Modelo
     *
     */


    //  Relacion uno a uno



    // Relacion de uno a muchos inversa

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function community()
    {
        return $this->belongsTo('App\Models\Community');
    }
}
