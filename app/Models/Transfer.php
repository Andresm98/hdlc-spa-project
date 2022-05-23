<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    //  Variable para asignacion masiva
    protected $guarded = [];

    /**
     *
     * Relacion a nivel de Modelo
     *
     */

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }


    //  Relacion uno a uno

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function community()
    {
        return $this->belongsTo('App\Models\Community');
    }
}
