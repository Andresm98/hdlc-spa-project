<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    /**
     *
     *  Relaciones a nivel de modelo
     *
     */

    // Relacion uno a uno inversa

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
