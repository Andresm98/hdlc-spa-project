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
        return $this->hasMany('App\Models\Activity');
    }

    public function resumes()
    {
        return $this->hasMany('App\Models\Resume');
    }

    public function visits()
    {
        return $this->hasMany('App\Models\Visit');
    }

    // One to one

    public function inventory()
    {
        return $this->hasOne('App\Models\Inventory');
    }

    public function permit()
    {
        return $this->hasOne('App\Models\Permit');
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

    //  Custom Relationship

    public function works()
    {
        return $this->getQuery()
            ->select('communities.*', 'pastorals.name as name_pastoral')

            // // join the pivot table for users and roles
            ->join('pastorals', 'pastorals.id', '=', 'communities.pastoral_id')
            // ->join('zones', 'zones.id', '=', 'communities.zone_id')
            // for this user
            ->where('comm_level', 2)
            ->where('comm_id', $this->id);
    }
}
