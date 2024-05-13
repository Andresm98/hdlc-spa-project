<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    //  Variable para asignacion masiva
    protected $guarded = [];


    // Relaciones uno a varios

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    // Relaciones uno a varios inversa

    public function inventory()
    {
        return $this->belongsToMany('App\Models\Inventory');
    }
}
