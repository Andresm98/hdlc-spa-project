<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'profile_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
