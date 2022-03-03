<?php

use App\Models\Appointment;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Secretary\Daughter\UserController;
use App\Http\Controllers\Secretary\Daughter\HealthController;
use App\Http\Controllers\Secretary\Daughter\PermitController;
use App\Http\Controllers\Secretary\Daughter\ProfileController;
use App\Http\Controllers\Secretary\Daughter\SacramentController;
use App\Http\Controllers\Secretary\Community\CommunityController;
use App\Http\Controllers\Secretary\Daughter\InfoFamilyController;
use App\Http\Controllers\Secretary\Daughter\AppointmentController;
use App\Http\Controllers\Secretary\Daughter\InfoFamilyBreakController;
use App\Http\Controllers\Secretary\Daughter\AcademicTrainingController;

Route::group(
    ['middleware' => ['role:secretary']],
    function () {

        // Welcome Controller

        Route::get('welcome', [UserController::class, 'welcome'])
            // ->middleware('can:see admin menu')
            ->name('welcome');

        // Profile Controllers

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

        //  Health Controllers

        Route::get('profile/health/{user_id}', [HealthController::class, 'index'])
            ->name('daughter-profile.health.index');

        Route::post('profile/health/store/{user_id}', [HealthController::class, 'store'])
            ->name('daughter-profile.health.store');

        Route::delete('profile/health/delete/{user_id}/{health_id}', [HealthController::class, 'destroy'])
            ->name('daughter-profile.health.delete');

        Route::put('profile/health/update/{user_id}/{health_id}', [HealthController::class, 'update'])
            ->name('daughter-profile.health.update');

        //  Academic Controllers

        Route::get('profile/academic/{user_id}', [AcademicTrainingController::class, 'index'])
            ->name('daughter-profile.academic.index');

        Route::post('profile/academic/store/{user_id}', [AcademicTrainingController::class, 'store'])
            ->name('daughter-profile.academic.store');

        Route::delete('profile/academic/delete/{user_id}/{academic_id}', [AcademicTrainingController::class, 'destroy'])
            ->name('daughter-profile.academic.delete');

        Route::put('profile/academic/update/{user_id}/{academic_id}', [AcademicTrainingController::class, 'update'])
            ->name('daughter-profile.academic.update');

        //  Info Family Controllers

        Route::get('profile/infofamily/{user_id}', [InfoFamilyController::class, 'index'])
            ->name('daughter-profile.infofamily.index');

        Route::post('profile/infofamily/{user_id}', [InfoFamilyController::class, 'storeUpdateData'])
            ->name('daughter-profile.infofamily.store');

        //  Info Family BreakControllers

        Route::get('profile/infofamilybreak/{user_id}', [InfoFamilyBreakController::class, 'index'])
            ->name('daughter-profile.infofamilybreak.index');

        Route::post('profile/infofamilybreak/{user_id}', [InfoFamilyBreakController::class, 'storeUpdateData'])
            ->name('daughter-profile.infofamilybreak.store');

        //  Sacrament Controllers

        Route::get('profile/sacrament/{user_id}', [SacramentController::class, 'index'])
            ->name('daughter-profile.sacrament.index');

        Route::post('profile/sacrament/store/{user_id}', [SacramentController::class, 'store'])
            ->name('daughter-profile.sacrament.store');

        Route::delete('profile/sacrament/delete/{user_id}/{sacrament_id}', [SacramentController::class, 'destroy'])
            ->name('daughter-profile.sacrament.delete');

        Route::put('profile/sacrament/update/{user_id}/{sacrament_id}', [SacramentController::class, 'update'])
            ->name('daughter-profile.sacrament.update');

        //  Permits Controllers

        Route::get('profile/permit/{user_id}', [PermitController::class, 'index'])
            ->name('daughter-profile.permit.index');

        Route::post('profile/permit/store/{user_id}', [PermitController::class, 'store'])
            ->name('daughter-profile.permit.store');

        Route::delete('profile/permit/delete/{user_id}/{permit_id}', [PermitController::class, 'destroy'])
            ->name('daughter-profile.permit.delete');

        Route::put('profile/permit/update/{user_id}/{permit_id}', [PermitController::class, 'update'])
            ->name('daughter-profile.permit.update');

        //  Permits Controllers

        Route::get('profile/appointment/{user_id}', [AppointmentController::class, 'index'])
            ->name('daughter-profile.appointment.index');

        Route::post('profile/appointment/store/{user_id}', [AppointmentController::class, 'store'])
            ->name('daughter-profile.appointment.store');

        Route::delete('profile/appointment/delete/{user_id}/{appointment_id}', [AppointmentController::class, 'destroy'])
            ->name('daughter-profile.appointment.delete');

        Route::put('profile/appointment/update/{user_id}/{appointment_id}', [AppointmentController::class, 'update'])
            ->name('daughter-profile.appointment.update');
    }
);


/* =======================
        Communities Proccess
=======================*/

Route::group([
    'middleware' => ['role:secretary'],
    'prefix' => 'communities'
], function () {

    // Communities Controllers

    Route::get('all', [CommunityController::class, 'index'])
        ->name('communities.index');

    Route::get('edit/{slug}', [CommunityController::class, 'edit'])
        ->name('communities.edit');

    Route::put('update/{community_id}', [CommunityController::class, 'update'])
        ->name('communities.update');

    Route::get('community/address/{actual_parish}', [AddressController::class, 'getSaveAddress'])
        ->name('communities.actual-address');
});
