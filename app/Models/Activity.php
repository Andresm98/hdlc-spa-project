<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
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

    public function resume()
    {
        return $this->belongsTo('App\Models\Resume');
    }
}
