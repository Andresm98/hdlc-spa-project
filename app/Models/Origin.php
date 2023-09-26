<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Uno a uno polimorfica
    public function originable()
    {
        return $this->morphTo();
    }
}
