<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Crud Usuarios

Route::resource('admin', UserController::class, ['parameters' => [
    // set value (userCustom) in methods in the class.
    'admin' => 'userCustom'
]])->names('users');


Route::get('jjj', [UserController::class, 'dd'])->name('usersk.create');



Route::get('/pdf', [UserController::class, 'PDF']);
