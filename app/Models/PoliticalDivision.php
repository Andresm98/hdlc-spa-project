<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticalDivision extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes  = [
        'id' => 'string',
    ];
}
