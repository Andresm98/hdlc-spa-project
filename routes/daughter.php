<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Daughter\UserProfileController;
use App\Http\Controllers\Daughter\FilesProfileController;
use App\Http\Controllers\Daughter\HealthProfileController;
use App\Http\Controllers\Daughter\PermitProfileController;
use App\Http\Controllers\Daughter\RecordProfileController;
use App\Http\Controllers\Daughter\TransferProfileController;
use App\Http\Controllers\Daughter\SacramentProfileController;
use App\Http\Controllers\Daughter\InfoFamilyProfileController;

// Address Controllers

Route::get('address/province', [AddressController::class, 'getProvinces'])
    ->name('address.province');

Route::get('address/cantons/{province_id}', [AddressController::class, 'getCantons'])
    ->name('address.cantons');

Route::get('address/parishes/{canton_id}', [AddressController::class, 'getParishes'])
    ->name('address.parishes');

Route::get('address/parishes/{parish_id}', [AddressController::class, 'getFinalAddress'])
    ->name('address.finaladdr');

Route::get('address/profile/address/{actual_parish}', [AddressController::class, 'getSaveAddress'])
    ->name('address.actual-address');

Route::get('address/profile/address_format/{actual_parish}', [AddressController::class, 'getActualAddress'])
    ->name('address.address-format');

Route::group(
    ['middleware' => ['role:daughter']],
    function () {

        Route::get('profile', [UserProfileController::class, 'index'])
            ->name('welcome');

        Route::put('user/update/{id}', [UserProfileController::class, 'update'])
            ->name('user.update');

        Route::post('profile/store/{id}', [UserProfileController::class, 'store'])
            ->name('profile.store');

        Route::put('profile/update/{id}', [UserProfileController::class, 'updateProfile'])
            ->name('profile.update');

        // Information Family

        Route::post('profile/info-family/store/{id}', [InfoFamilyProfileController::class, 'store'])
            ->name('infofamily.store');

        // Health

        Route::get('health', [HealthProfileController::class, 'index'])
            ->name('health.index');

        Route::post('health/store/{user_id}', [HealthProfileController::class, 'store'])
            ->name('health.store');

        Route::put('health/update/{user_id}/{health_id}', [HealthProfileController::class, 'update'])
            ->name('health.update');

        Route::delete('health/delete/{user_id}/{health_id}', [HealthProfileController::class, 'destroy'])
            ->name('health.delete');

        //  Academic Controllers

        Route::get('academic', [RecordProfileController::class, 'index'])
            ->name('academic.index');

        Route::post('academic/store/{user_id}', [RecordProfileController::class, 'store'])
            ->name('academic.store');

        Route::delete('academic/delete/{user_id}/{academic_id}', [RecordProfileController::class, 'destroy'])
            ->name('academic.delete');

        Route::put('academic/update/{user_id}/{academic_id}', [RecordProfileController::class, 'update'])
            ->name('academic.update');

        //  Sacrament Controllers

        Route::get('sacrament', [SacramentProfileController::class, 'index'])
            ->name('sacrament.index');

        Route::post('sacrament/store/{user_id}', [SacramentProfileController::class, 'store'])
            ->name('sacrament.store');

        Route::delete('sacrament/delete/{user_id}/{sacrament_id}', [SacramentProfileController::class, 'destroy'])
            ->name('sacrament.delete');

        Route::put('sacrament/update/{user_id}/{sacrament_id}', [SacramentProfileController::class, 'update'])
            ->name('sacrament.update');

        // Transfers

        Route::get('transfers', [TransferProfileController::class, 'index'])
            ->name('transfer.index');

        Route::get('transfer/appointents/{transfer_id}', [TransferProfileController::class, 'allAppointments'])
            ->name('transfer.appointments.index');

        Route::get('profile/transfer/data/{transfer_id}', [TransferProfileController::class, 'transferData'])
            ->name('transfer-data.index');

        Route::get('transfers/daughters/search', [TransferProfileController::class, 'search'])
            ->name('transfer.search');

        // Files

        Route::get('files', [FilesProfileController::class, 'index'])
            ->name('files.index');

        Route::get('files/show/{file_id}', [FilesProfileController::class, 'show'])
            ->name('files.show');

        Route::post('files/{user_id}', [FilesProfileController::class, 'store'])
            ->name('files.store');

        Route::get('profile/files/edit/{file_id}', [FilesProfileController::class, 'edit'])
            ->name('files.edit');

        Route::post('files/update/{user_id}/{file_id}', [FilesProfileController::class, 'update'])
            ->name('files.update');

        Route::delete('files/delete/{file_id}', [FilesProfileController::class, 'destroy'])
            ->name('files.delete');

        // Permit Controller

        Route::get('permit', [PermitProfileController::class, 'index'])
            ->name('permit.index');

        Route::post('permit/store/{user_id}', [PermitProfileController::class, 'store'])
            ->name('permit.store');

        Route::delete('permit/delete/{user_id}/{permit_id}', [PermitProfileController::class, 'destroy'])
            ->name('permit.delete');

        Route::put('permit/update/{user_id}/{permit_id}', [PermitProfileController::class, 'update'])
            ->name('permit.update');

        Route::get('permit/print/{permit_id}', [PermitProfileController::class, 'printPermit'])
            ->name('permit.pdf');


        //  Report

        Route::get('report/pdf', [UserProfileController::class, 'reportInfoProfilePDF'])
            ->name('report.profile');
    }
);
