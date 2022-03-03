<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    //  Variable para asignacion masiva
    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
