<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
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
        return $this->belongsTo('App\Models\Community');
    }
}
