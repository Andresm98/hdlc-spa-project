<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $guarded = [];
    use HasFactory;

    // Uno a uno polimorfica
    public function addressable()
    {
        return $this->morphTo();
    }

}
