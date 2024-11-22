<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    //  Variable para asignacion masiva
    protected $guarded = [];

    public function resume()
    {
        return $this->belongsTo('App\Models\Resume');
    }

    public function transfer()
    {
        return $this->belongsTo('App\Models\Transfer');
    }
}
