<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity_card', 'status', 'date_birth', 'date_vocation',
        'date_admission', 'date_send', 'date_vote', 'date_death', 'date_exit', 'cellphone', 'phone', 'observation'
    ];

    /**
     *
     * Crear relaciones a nivel de modelo
     *
     */

    //  Relación uno a uno inversa

    public function user(): BelongsTo
    {
        // BELONG METODO PARA SETEAR LA CLAVE FORANEA
        // Campo especifico en Profile (user_id)
        return $this->belongsTo(User::class);
    }

    // Relacion uno a uno


    public function  info_family()
    {
        return $this->hasOne('App\Models\InfoFamily');
    }

    /**
     *
     * Creacion relacion de uno a muchos a nivel de Modelo
     *
     */

    // Relacion uno a varios

    public function academic_trainings()
    {
        return $this->hasMany('App\Models\AcademicTraining');
    }

    public function transfers()
    {
        return $this->hasMany('App\Models\Transfer');
    }

    public function healths()
    {
        return $this->hasMany('App\Models\Health');
    }

    public function permits()
    {
        return $this->hasMany('App\Models\Permit');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public function sacraments()
    {
        return $this->hasMany('App\Models\Sacrament');
    }


    // Relacion uno a uno polimorfica inversa

    public function address()
    {
        return $this->morphOne('App\Models\Address', 'addressable');
    }

    // Relacion uno a varios polimorfica

    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }
}
