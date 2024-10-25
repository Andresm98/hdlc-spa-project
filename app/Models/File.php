<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //  Variable para asignacion masiva
    protected $guarded = [];

    use HasFactory;

    public function fileable()
    {
        return $this->morphTo();
    }
}
