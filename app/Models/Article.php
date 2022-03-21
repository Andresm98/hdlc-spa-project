<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Relaciones uno a varios inversa

    public function sections()
    {
        return $this->belongsToMany('App\Models\Section');
    }
}
