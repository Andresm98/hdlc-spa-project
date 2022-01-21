<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Secretary\Profile;

// Inicial Page Secretary
Route::get('', function () {
    return "Hola secretaria";
});

//  Initialize proccess

/**
 *
 *  Generate Data Profiles
 *
 */


//  Create profile daugther charitee

Route::post('profile', [Profile::class, 'createprofile'])->name('create.profile');
