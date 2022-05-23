<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function community()
    {
        return $this->hasMany('App\Models\Community');
    }

}
