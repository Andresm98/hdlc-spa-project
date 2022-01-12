<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityActivity extends Model
{
    use HasFactory;


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
