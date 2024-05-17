<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $guarded = [];
    use HasFactory;
    protected $appends = [
        'province',
        'canton',
        'parish'
    ];

    // Uno a uno polimorfica
    public function addressable()
    {
        return $this->morphTo();
    }

    public function getParishAttribute()
    {
        return PoliticalDivision::where('id', $this->political_division_id)
            ->where('level', 3)
            ->first();
    }

    public function getCantonAttribute()
    {
        $parish = $this->getParishAttribute();

        return PoliticalDivision::where('id', (int)$parish->political_divisionc_id)
            ->where('level', 2)
            ->first();
    }

    public function getProvinceAttribute()
    {
        $province = $this->getCantonAttribute();

        return PoliticalDivision::where('id', (int)$province->political_divisionc_id)
            ->where('level', 1)
            ->first();
    }
}
