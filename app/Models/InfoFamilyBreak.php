<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoFamilyBreak extends Model
{
    use HasFactory;

    /**
     *
     * Relaciones a nivel de  Modelo.
     *
     */

    // Relaciones uno a uno inversa

    public function info_family()
    {
        return $this->belongsTo('App\Models\InfoFamily');
    }

    // Relacion uno a uno polimorfica inversa

    public function address()
    {
        return $this->morphOne('App\Models\Address', 'addressable');
    }
}
