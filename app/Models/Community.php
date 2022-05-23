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

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\CommunityActivity');
    }

    public function resumes()
    {
        return $this->hasMany('App\Models\CommunityResume');
    }

    public function visits()
    {
        return $this->hasMany('App\Models\CommunityVisit');
    }

    public function inventory()
    {
        return $this->hasOne('App\Models\Inventory');
    }
    // Relation pne to one inverse polimorph

    public function address()
    {
        return $this->morphOne('App\Models\Address', 'addressable');
    }

    // Relation one to one inverse

    public function pastoral()
    {
        return $this->belongsTo('App\Models\Pastoral');
    }

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    // Relacion uno a varios polimorfica

    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }
}
