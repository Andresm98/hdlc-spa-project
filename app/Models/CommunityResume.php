<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityResume extends Model
{
    use HasFactory;
    //  Variable para asignacion masiva
    protected $guarded = [];

    /**
     *
     * Crear relaciones a nivel de modelo
     *
     */

    // Relaciones uno a varios

    public function community()
    {
        return $this->belongsToMany('App\Models\Community');
    }
}
