<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    protected $fillable = [
        'actual_health',
        'chronic_diseases',
        'other_health_problems',
        'consult_date',
    ];
    /**
     *
     *  Relaciones a nivel de modelo
     *
     */

    // Relacion uno a varios inversa

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
