<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    // Habilitar asignacion masiva.
    protected $guarded = [];

    use HasFactory;

    public function imageable()
    {
        $this->morphTo('App\Models\User');
    }
}
