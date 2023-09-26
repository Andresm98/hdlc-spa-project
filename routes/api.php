<?php

use App\Http\Controllers\Api\Daughter\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::get('islogged', [RegisterController::class, 'islogged']);

Route::middleware('auth:sanctum')->group(function () {

    Route::group(
        ['middleware' => ['role:super admin']],
        function () {

            // User

            Route::get('admin/users', [ProfileController::class, 'index'])
                ->name('users.index');

            Route::post('admin/users/store', [ProfileController::class, 'store'])
                ->name('users.store');

            Route::delete('admin/users/delete/{daughterId}', [ProfileController::class, 'destroy'])
                ->name('users.destroy');

            Route::get('admin/showimage/{daughterId}', [ProfileController::class, 'showImage'])
                ->name('users.image.index');

            Route::get('admin/users/export', [ProfileController::class, 'exportExcel'])
                ->name('users.export.index');

            // Profile

            Route::post('admin/users/update/{daughterId}/{operation}', [ProfileController::class, 'update'])
                ->name('users.profile.store');

            // Books

            Route::get('admin/books', [BookController::class, 'index'])
                ->name('books.index');

            Route::post('admin/books/store', [BookController::class, 'store'])
                ->name('books.store');

            Route::post('admin/books/update/{docBookId}', [BookController::class, 'update'])
                ->name('books.update');

            Route::delete('admin/books/delete/{docBookId}', [BookController::class, 'destroy'])
                ->name('books.destroy');

            // Address

            Route::get('admin/address/province', [AddressController::class, 'getProvinces'])
                ->name('address.province');

            Route::get('admin/address/cantons/{province_id}', [AddressController::class, 'getCantons'])
                ->name('address.cantons');

            Route::get('admin/address/parishes/{canton_id}', [AddressController::class, 'getParishes'])
                ->name('address.parishes');

            Route::get('admin/address/parishes/{parish_id}', [AddressController::class, 'getFinalAddress'])
                ->name('address.finaladdr');

            Route::get('admin/address/profile/address/{actual_parish}', [AddressController::class, 'getSaveAddress'])
                ->name('address.actual-address');

            Route::get('admin/address/profile/address_bt/{actual_ubication}', [AddressController::class, 'getSaveAddressBt'])
                ->name('address.actual-address-bt');

            Route::get('admin/address/profile/address_format/{actual_parish}', [AddressController::class, 'getActualAddress'])
                ->name('address.address-format');

            Route::get('admin/address/profile/address_format/{actual_parish}', [AddressController::class, 'showActualAddress'])
                ->name('address.address-format');
        }
    );
});
