<?php

use App\Models\Appointment;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Secretary\Daughter\UserController;
use App\Http\Controllers\Secretary\Daughter\HealthController;
use App\Http\Controllers\Secretary\Daughter\OfficeController;
use App\Http\Controllers\Secretary\Daughter\PermitController;
use App\Http\Controllers\Secretary\Daughter\ProfileController;
use App\Http\Controllers\Secretary\Daughter\TransferController;
use App\Http\Controllers\Secretary\Daughter\SacramentController;
use App\Http\Controllers\Secretary\Community\CommunityController;
use App\Http\Controllers\Secretary\Community\Work\WorkController;
use App\Http\Controllers\Secretary\Daughter\InfoFamilyController;
use App\Http\Controllers\Secretary\Daughter\AppointmentController;
use App\Http\Controllers\Secretary\Community\CommunityVisitController;
use App\Http\Controllers\Secretary\Daughter\InfoFamilyBreakController;
use App\Http\Controllers\Secretary\Community\CommunityResumeController;
use App\Http\Controllers\Secretary\Daughter\AcademicTrainingController;
use App\Http\Controllers\Secretary\Community\CommunityActivityController;
use App\Http\Controllers\Secretary\Community\Inventory\CommunitySectionController;
use App\Http\Controllers\Secretary\Community\Inventory\CommunityInventoryController;


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

// Offices Controllers

Route::get('offices/all', [OfficeController::class, 'index'])
    ->name('offices.index');

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

        //  Transfers Controllers

        Route::get('profile/transfer/{user_id}', [TransferController::class, 'index'])
            ->name('daughter-profile.transfer.index');

        Route::get('profile/transfer/data/{transfer_id}', [TransferController::class, 'transferData'])
            ->name('daughter-profile.transfer-data.index');

        Route::post('profile/transfer/store/{user_id}', [TransferController::class, 'store'])
            ->name('daughter-profile.transfer.store');

        Route::delete('profile/transfer/delete/{user_id}/{transfer_id}', [TransferController::class, 'destroy'])
            ->name('daughter-profile.transfer.delete');

        Route::put('profile/transfer/update/{user_id}/{transfer_id}', [TransferController::class, 'update'])
            ->name('daughter-profile.transfer.update');

        Route::get('profile/transfer/communities/all', [TransferController::class, 'allCommunities'])
            ->name('daughter-profile.transfer.communities.index');
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

    Route::get('create', [CommunityController::class, 'create'])
        ->name('communities.create');

    Route::post('store', [CommunityController::class, 'store'])
        ->name('communities.store');

    Route::get('edit/{slug}', [CommunityController::class, 'edit'])
        ->name('communities.edit');

    Route::put('update/{community_id}', [CommunityController::class, 'update'])
        ->name('communities.update');

    // Works Controllers

    Route::get('works/all/{community_id}', [WorkController::class, 'index'])
        ->name('works.index');

    Route::get('works/{community_slug}/create', [WorkController::class, 'create'])
        ->name('works.create');

    Route::post('works/{community_id}/store', [WorkController::class, 'store'])
        ->name('works.store');

    Route::get('works/edit/{slug}', [WorkController::class, 'edit'])
        ->name('works.edit');

    Route::put('works/update/{work_id}', [WorkController::class, 'update'])
        ->name('works.update');

    Route::delete('works/delete/{work_id}', [WorkController::class, 'destroy'])
        ->name('works.delete');

    // Communities Activities

    Route::get('activities/{community_id}', [CommunityActivityController::class, 'index'])
        ->name('communities.activity.index');

    Route::post('activities/store/{community_id}', [CommunityActivityController::class, 'store'])
        ->name('communities.activity.store');

    Route::delete('activities/delete/{community_id}/{activity_id}', [CommunityActivityController::class, 'destroy'])
        ->name('communities.activity.delete');

    Route::put('activities/update/{community_id}/{activity_id}', [CommunityActivityController::class, 'update'])
        ->name('communities.activity.update');

    // Communities Resumes

    Route::get('resumes/{community_id}', [CommunityResumeController::class, 'index'])
        ->name('communities.resume.index');

    Route::post('resumes/store/{community_id}', [CommunityResumeController::class, 'store'])
        ->name('communities.resume.store');

    Route::delete('resumes/delete/{community_id}/{resume_id}', [CommunityResumeController::class, 'destroy'])
        ->name('communities.resume.delete');

    Route::put('resumes/update/{community_id}/{resume_id}', [CommunityResumeController::class, 'update'])
        ->name('communities.resume.update');

    // Communities Visits

    Route::get('visits/{community_id}', [CommunityVisitController::class, 'index'])
        ->name('communities.visit.index');

    Route::post('visits/store/{community_id}', [CommunityVisitController::class, 'store'])
        ->name('communities.visit.store');

    Route::delete('visits/delete/{community_id}/{visit_id}', [CommunityVisitController::class, 'destroy'])
        ->name('communities.visit.delete');

    Route::put('visits/update/{community_id}/{visit_id}', [CommunityVisitController::class, 'update'])
        ->name('communities.visit.update');

    // Communities Inventories

    Route::get('inventory/all', [CommunityInventoryController::class, 'index'])
        ->name('communities.inventories.index');

    Route::get('inventory/{community_id}', [CommunityInventoryController::class, 'getInventory'])
        ->name('communities.inventory.index');

    Route::post('inventory/store/{community_id}', [CommunityInventoryController::class, 'store'])
        ->name('communities.inventory.store');

    Route::put('inventory/update/{inventory_id}', [CommunityInventoryController::class, 'update'])
        ->name('communities.inventory.update');

    Route::delete('inventory/delete/{inventory_id}', [CommunityInventoryController::class, 'destroy'])
        ->name('communities.inventory.delete');

    // Communities Sections

    Route::get('inventory/section/{inventory_id}/all', [CommunitySectionController::class, 'index'])
        ->name('communities.section.all');

    Route::post('inventory/section/store/{community_id}', [CommunitySectionController::class, 'store'])
        ->name('communities.section.store');

    Route::put('inventory/section/update/{inventory_id}/{section_id}', [CommunitySectionController::class, 'update'])
        ->name('communities.section.update');

    Route::delete('inventory/section/delete/{inventory_id}/{section_id}', [CommunitySectionController::class, 'destroy'])
        ->name('communities.section.delete');
});
