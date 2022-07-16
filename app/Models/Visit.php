<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    //  Variable para asignacion masiva
    protected $guarded = [];

    public function community()
    {
        return $this->belongsTo('App\Models\Community');
    }
}
