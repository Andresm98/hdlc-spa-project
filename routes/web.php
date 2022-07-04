<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TestAWSController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthWebAccessController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('user/roles', [AuthWebAccessController::class, 'index'])
    ->name('web.user.roles.index')->middleware('auth');;

// Route::get('/image', [TestAWSController::class, 'index'])->name('test.image.index');


// Route::post('/image', [TestAWSController::class, 'store'])->name('test.image.create');


// Route::get('/image/show', [TestAWSController::class, 'show'])->name('test.image.show');
