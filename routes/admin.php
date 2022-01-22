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

Route::get('admin/welcome', [UserController::class, 'welcome'])->name('welcome');
Route::get('admin/users/all',[UserController::class, 'index'])->name('users.index');
Route::get('admin/user/create',[UserController::class, 'create'])->name('user.create');
Route::post('admin/user/store',[UserController::class, 'store'])->name('user.store');
Route::get('admin/user/show/{slug}', [UserController::class, 'show'])->name('user.show');
Route::get('admin/user/edit/{slug}', [UserController::class, 'edit'])->name('user.edit');
Route::put('admin/user/update/{user_custom}', [UserController::class, 'update'])->name('user.update');



Route::get('jjj', [UserController::class, 'dd'])->name('usersk.create');
Route::get('/pdf', [UserController::class, 'PDF']);
