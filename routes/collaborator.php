<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Collaborator\CollaboratorController;

Route::resource('collaborator', CollaboratorController::class, ['parameters' => [
    // set value (userCustom) in methods in the class.
    'admin' => 'userCustom'
]])->names('users');


Route::get('mod', [CollaboratorController::class, 'mod']);
