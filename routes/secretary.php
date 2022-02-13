<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Secretary\Daughter\ProfileController;
use App\Http\Controllers\Secretary\Daughter\UserController;
use App\Http\Controllers\AddressController;
use Inertia\Inertia;


Route::group(
    ['middleware' => ['role:secretary']],
    function () {

        Route::get('welcome', [UserController::class, 'welcome'])
            // ->middleware('can:see admin menu')
            ->name('welcome');

        Route::get('daughters-charity/all', [UserController::class, 'index'])
            ->name('daughters.index');

        Route::get('daughters-charity/edit/{slug}', [UserController::class, 'edit'])
            ->name('daughters.edit');

        Route::put('daughters-charity/update/{daughter_custom}', [UserController::class, 'update'])
            ->name('daughters.update');

        Route::get('daughters-charity/show/{slug}', [UserController::class, 'show'])
            ->name('daughters.show');

        Route::get("daughters-charity/profile/{id}", [ProfileController::class, "specificProfile"])
            ->name("daughter-profile.index");

        Route::post('profile', [ProfileController::class, 'store'])
            ->name('daughters-profile.store');

        Route::put('profile/{profile_custom_id}', [ProfileController::class, 'update'])
            ->name('daughters-profile.update');

        Route::get('profile/province', [AddressController::class, 'getProvinces'])
            ->name('daughters-profile.province');

        Route::get('profile/cantons/{province_id}', [AddressController::class, 'getCantons'])
            ->name('daughters-profile.cantons');

        Route::get('profile/parishes/{canton_id}', [AddressController::class, 'getParishes'])
            ->name('daughters-profile.parishes');

        Route::get('profile/parishes/{parish_id}', [AddressController::class, 'getFinalAddress'])
            ->name('daughters-profile.finaladdr');

        Route::get('profile/profile/address/{actual_parish}', [AddressController::class, 'getSaveAddress'])
            ->name('daughters-profile.actual-address');
    }
);
