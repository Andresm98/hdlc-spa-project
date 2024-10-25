<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        'names_father', 'names_mother',
        'nr_sisters', 'nr_brothers', 'place_of_family'
    ];

    /**
     *
     * Relaciones a nivel de modelo de base de datos.
     *
     */

    // Relaciones uno a uno inversa

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    // Relaciones uno a uno

    public function info_family_break()
    {
        return $this->hasOne('App\Models\InfoFamilyBreak');
    }
}
