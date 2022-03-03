<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityVisit extends Model
{
    use HasFactory;

    public function community()
    {
        return $this->belongsToMany('App\Models\Community');
    }
}
