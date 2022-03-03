<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    //  Variable para asignacion masiva
    protected $guarded = [];

    /**
     *
     * Relacionar las entidades a nivel de modelo,
     *
     */

    //  Relacion uno a varios

    public function transfers()
    {
        return $this->hasMany('App\Models\Transfer');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\CommunityActivity');
    }

    public function resumes()
    {
        return $this->hasMany('App\Models\CommunityResume');
    }

    public function visit()
    {
        return $this->hasMany('App\Models\CommunityVisit');
    }

    // Relation pne to one inverse polimorph

    public function address()
    {
        return $this->morphOne('App\Models\Address', 'addressable');
    }

    // Relation one to one


}
