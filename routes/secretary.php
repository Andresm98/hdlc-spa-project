<?php

use App\Models\Appointment;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Secretary\Events\EventController;
use App\Http\Controllers\Secretary\Daughter\UserController;
use App\Http\Controllers\Secretary\Daughter\HealthController;
use App\Http\Controllers\Secretary\Daughter\OfficeController;
use App\Http\Controllers\Secretary\Daughter\PermitController;
use App\Http\Controllers\Secretary\Daughter\ProfileController;
use App\Http\Controllers\Secretary\Daughter\RealityController;
use App\Http\Controllers\Secretary\Files\FileGlobalController;
use App\Http\Controllers\Secretary\Daughter\TransferController;
use App\Http\Controllers\Secretary\Daughter\SacramentController;
use App\Http\Controllers\Secretary\Community\CommunityController;
use App\Http\Controllers\Secretary\Community\Work\WorkController;
use App\Http\Controllers\Secretary\Daughter\InfoFamilyController;
use App\Http\Controllers\Secretary\Daughter\AppointmentController;
use App\Http\Controllers\Secretary\Daughter\FilesDaughterController;
use App\Http\Controllers\Secretary\Community\CommunityZoneController;
use App\Http\Controllers\Secretary\Transfer\TransferGlobalController;
use App\Http\Controllers\Secretary\Community\CommunityVisitController;
use App\Http\Controllers\Secretary\Community\FilesCommunityController;
use App\Http\Controllers\Secretary\Daughter\InfoFamilyBreakController;
use App\Http\Controllers\Secretary\Community\CommunityResumeController;
use App\Http\Controllers\Secretary\Daughter\AcademicTrainingController;
use App\Http\Controllers\Secretary\Daughter\AppointmentLevelController;
use App\Http\Controllers\Secretary\Community\CommunityRealityController;
use App\Http\Controllers\Secretary\Community\CommunityActivityController;
use App\Http\Controllers\Secretary\Community\CommunityDaughterController;
use App\Http\Controllers\Secretary\Community\CommunityPastoralController;
use App\Http\Controllers\Secretary\Inventories\InventoryGlobalController;
use App\Http\Controllers\Secretary\Community\Visits\VisitGlobalController;
use App\Http\Controllers\Secretary\Permissions\PermissionGlobalController;
use App\Http\Controllers\Secretary\Appointments\AppointmentGlobalController;
use App\Http\Controllers\Secretary\Community\Files\FileCommGlobalController;
use App\Http\Controllers\Secretary\Community\Resumes\ResumeGlobalController;
use App\Http\Controllers\Secretary\Community\Activities\ActivityGlobalController;
use App\Http\Controllers\Secretary\Community\Inventory\CommunityArticleController;
use App\Http\Controllers\Secretary\Community\Inventory\CommunitySectionController;
use App\Http\Controllers\Secretary\Community\Inventory\CommunityInventoryController;
use App\Http\Controllers\Secretary\Community\WorkIndividual\WorkIndividualController;


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

Route::get('address/profile/address_bt/{actual_ubication}', [AddressController::class, 'getSaveAddressBt'])
    ->name('address.actual-address-bt');

Route::get('address/profile/address_format/{actual_parish}', [AddressController::class, 'getActualAddress'])
    ->name('address.address-format');

Route::get('address/profile/address_format/{actual_parish}', [AddressController::class, 'showActualAddress'])
    ->name('address.address-format');

// Offices Controllers

Route::get('offices/all', [OfficeController::class, 'index'])
    ->name('offices.index');


// Appointments Levels Controllers

Route::get('appointment_levels/{status}/{id}', [AppointmentLevelController::class, 'index'])
    ->name('appointment.levels.index');

Route::get('appointment-data/{appointment_level_id}', [AppointmentLevelController::class, 'appointmentLevelData'])
    ->name('appointment-data.index');

// Pastoral Controllers

Route::get('pastorals/all', [CommunityPastoralController::class, 'index'])
    ->name('pastoral.index');

// Zones Controllers

Route::get('zones/all', [CommunityZoneController::class, 'index'])
    ->name('zone.index');

//  Excel report

Route::get('users/export', [UserController::class, 'export'])
    ->name('users.report');

// Books

Route::get('books/all', [BookController::class, 'index'])
    ->name('books.index');

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

        Route::get('daughters-charity/create', [UserController::class, 'create'])
            ->name('daughters.create');

        Route::post('daughters-charity/store', [UserController::class, 'store'])
            ->name('daughters.store');

        Route::get('daughters-charity/edit/{slug}', [UserController::class, 'edit'])
            ->name('daughters.edit');

        Route::put('daughters-charity/update/{daughter_custom}', [UserController::class, 'update'])
            ->name('daughters.update');

        Route::delete('daughters-charity/delete/{slug}', [UserController::class, 'destroy'])
            ->name('user.destroy');

        Route::get('daughters-charity/show/{slug}', [UserController::class, 'show'])
            ->name('daughters.show');

        Route::get('daughters-charity/all/report', [UserController::class, 'reportDaughtersPDF'])
            ->name('daughters.report.all');

        Route::get('daughters-charity/vocation/report', [UserController::class, 'reportByVocation'])
            ->name('daughters.report.vocation');

        Route::get('daughters-charity/exportExcel', [UserController::class, 'exportExcel'])
            ->name('daughters.export.excel');

        Route::get('daughters-charity/exportCSV', [UserController::class, 'exportCSV'])
            ->name('daughters.export.csv');

        // Reality Controllers

        Route::get('daughters-charity/reality', [RealityController::class, 'index'])
            ->name('daughters.reality.index');

        //  Profile Controllers

        Route::get("daughters-charity/profile/{id}", [ProfileController::class, "specificProfile"])
            ->name("daughter-profile.index");

        Route::post('profile', [ProfileController::class, 'store'])
            ->name('daughters-profile.store');

        Route::put('profile/{profile_custom_id}', [ProfileController::class, 'update'])
            ->name('daughters-profile.update');

        Route::put('update/status/{profile_id}', [ProfileController::class, 'updateStatus'])
            ->name('daughters-profile.status.update');

        Route::get('daughters-charity/report', [UserController::class, 'reportInfoProfilePDF'])
            ->name('daughters.report.profile');

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

        Route::get('profile/permit/print/{user_id}/{permit_id}', [PermitController::class, 'printPermit'])
            ->name('daughter-profile.permit.pdf');

        //  Appointments Controllers

        Route::get('profile/appointment/{user_id}', [AppointmentController::class, 'index'])
            ->name('daughter-profile.appointment.index');

        Route::get('profile/appointment/community/{community_id}', [AppointmentController::class, 'getCommunity'])
            ->name('daughter-profile.appointment.community.index');

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

        Route::get('profile/transfer/transfer/appointents/{transfer_id}', [TransferController::class, 'allAppointments'])
            ->name('daughter-profile.transfer.appointments.index');

        Route::get('profile/transfer/print/{user_id}/{transfer_id}', [TransferController::class, 'printTransfer'])
            ->name('daughter-profile.transfer.pdf');

        // Files

        Route::get('profile/files/{user_id}', [FilesDaughterController::class, 'index'])
            ->name('daughter-profile.files.index');

        Route::get('profile/files/show/{file_id}', [FilesDaughterController::class, 'show'])
            ->name('daughter-profile.files.show');

        Route::post('profile/files/{user_id}', [FilesDaughterController::class, 'store'])
            ->name('daughter-profile.files.store');

        Route::get('profile/files/edit/{file_id}', [FilesDaughterController::class, 'edit'])
            ->name('daughter-profile.files.edit');

        Route::post('profile/files/update/{user_id}/{file_id}', [FilesDaughterController::class, 'update'])
            ->name('daughter-profile.files.update');

        Route::delete('profile/files/delete/{file_id}', [FilesDaughterController::class, 'destroy'])
            ->name('daughter-profile.files.delete');
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

    Route::put('update/status/{community_id}', [CommunityController::class, 'updateStatus'])
        ->name('communities.status.update');

    Route::delete('delete/{community_id}', [CommunityController::class, 'destroy'])
        ->name('communities.delete');

    Route::get('export-excel', [CommunityController::class, 'exportExcel'])
        ->name('communities.export.excel');

    Route::get('export-csv', [CommunityController::class, 'exportCSV'])
        ->name('communities.export.csv');

    Route::get('report-pdf', [CommunityController::class, 'reportCommPDF'])
        ->name('communities.report.pdf');

    Route::get('report-communities-pdf', [CommunityController::class, 'reportAllCommPDF'])
        ->name('communities.pdf.all');

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

    Route::put('works/update/status/{work_id}', [WorkController::class, 'updateStatus'])
        ->name('works.status.update');

    Route::delete('works/delete/{work_id}', [WorkController::class, 'destroy'])
        ->name('works.delete');

    Route::get('works/report-pdf', [WorkController::class, 'reportCommPDF'])
        ->name('works.report.pdf');

    // Works Individual

    Route::get('worksindividual/create', [WorkIndividualController::class, 'create'])
        ->name('worksindividual.create');

    Route::post('worksindividual/store', [WorkIndividualController::class, 'store'])
        ->name('worksindividual.store');

    Route::get('worksindividual/edit/{slug}', [WorkIndividualController::class, 'edit'])
        ->name('worksindividual.edit');

    Route::put('worksindividual/update/{work_id}', [WorkIndividualController::class, 'update'])
        ->name('worksindividual.update');

    Route::put('worksindividual/update/status/{work_id}', [WorkIndividualController::class, 'updateStatus'])
        ->name('worksindividual.status.update');

    Route::delete('worksindividual/delete/{work_id}', [WorkIndividualController::class, 'destroy'])
        ->name('worksindividual.delete');

    Route::get('worksindividual/report-pdf', [WorkIndividualController::class, 'reportCommPDF'])
        ->name('worksindividual.report.pdf');

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

    // Communities Daughters

    Route::get('daughters/{community_id}', [CommunityDaughterController::class, 'index'])
        ->name('communities.daughters.index');

    Route::get('daughters-custom/{community_id}', [CommunityDaughterController::class, 'report'])
        ->name('communities.daughters.report');

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

    Route::put('inventory/section/update/{inventory_id}/{section_id}/{community_id}', [CommunitySectionController::class, 'update'])
        ->name('communities.section.update');

    Route::delete('inventory/section/delete/{inventory_id}/{section_id}', [CommunitySectionController::class, 'destroy'])
        ->name('communities.section.delete');

    // Articles Sections

    Route::get('inventory/section/{section_slug}/articles/all', [CommunityArticleController::class, 'index'])
        ->name('communities.articles.index');

    Route::post('articles/store/{section_slug}', [CommunityArticleController::class, 'store'])
        ->name('communities.articles.store');

    Route::delete('articles/delete/{article_id}', [CommunityArticleController::class, 'destroy'])
        ->name('communities.articles.delete');

    Route::put('articles/update/{section_slug}/{article_id}', [CommunityArticleController::class, 'update'])
        ->name('communities.articles.update');

    Route::get('articles/export-excel', [CommunityArticleController::class, 'exportExcel'])
        ->name('communities.articles.export.excel');

    Route::get('articles/export-csv', [CommunityArticleController::class, 'exportCSV'])
        ->name('communities.articles.export.csv');

    Route::get('articles/report-pdf', [CommunityArticleController::class, 'reportAllArticles'])
        ->name('communities.articles.report.pdf');

    // Files Controllers

    Route::get('files/{community_id}', [FilesCommunityController::class, 'index'])
        ->name('communities.files.index');

    Route::get('files/show/{file_id}', [FilesCommunityController::class, 'show'])
        ->name('communities.files.show');

    Route::post('files/{community_id}', [FilesCommunityController::class, 'store'])
        ->name('communities.files.store');

    Route::get('files/edit/{file_id}', [FilesCommunityController::class, 'edit'])
        ->name('communities.files.edit');

    Route::post('files/update/{community_id}/{file_id}', [FilesCommunityController::class, 'update'])
        ->name('communities.files.update');

    Route::delete('files/delete/{file_id}', [FilesCommunityController::class, 'destroy'])
        ->name('communities.files.delete');

    // Files Communities Controllers

    Route::get('filesglobal/all', [FileCommGlobalController::class, 'index'])
        ->name('filesglobal.communities.index');

    Route::get('filesglobal/all/search', [FileCommGlobalController::class, 'search'])
        ->name('filesglobal.communities.search');

    // Inventories Global Controller

    Route::get('inventoryglobal/all', [InventoryGlobalController::class, 'index'])
        ->name('communitiesglobal.inventories.index');

    Route::get('inventoryglobal/all/inventory/{community_id}', [InventoryGlobalController::class, 'getInventory'])
        ->name('communitiesglobal.inventorie.index');

    // Reality Controllers

    Route::get('reality', [CommunityRealityController::class, 'index'])
        ->name('communities.reality.index');
});

/* =======================
        Global Events Proccess
=======================*/

Route::group(
    [
        'middleware' => ['role:secretary'],
    ],
    function () {

        // Events

        Route::get('events/all', [EventController::class, 'index'])
            ->name('events.index');

        Route::post('events/store', [EventController::class, 'store'])
            ->name('events.store');

        Route::put('events/update/{event_id}', [EventController::class, 'update'])
            ->name('events.update');

        Route::get('events/delete/{event_id}', [EventController::class, 'destroy'])
            ->name('events.delete');

        Route::get('events/report-pdf', [EventController::class, 'reportPDF'])
            ->name('events.report.pdf');

        Route::get('events/exportExcel', [EventController::class, 'exportExcel'])
            ->name('events.export.excel');

        Route::get('events/exportCSV', [EventController::class, 'exportCSV'])
            ->name('events.export.csv');

        // Appointments

        Route::get('appoinments/all', [AppointmentGlobalController::class, 'index'])
            ->name('appoinments.index');

        Route::get('appoinments/terminated', [AppointmentGlobalController::class, 'terminateServant'])
            ->name('appoinments.terminated.index');

        Route::post('appoinments/store', [AppointmentGlobalController::class, 'store'])
            ->name('appoinments.store');

        Route::put('appoinments/update/{appoinment_id}', [AppointmentGlobalController::class, 'update'])
            ->name('appoinments.update');

        Route::delete('appoinments/delete/{appoinment_id}', [AppointmentGlobalController::class, 'destroy'])
            ->name('appoinments.delete');

        Route::get('appoinments/report/all', [AppointmentGlobalController::class, 'exportPDF'])
            ->name('appoinments.pdf');

        Route::get('appoinments/exportExcel', [AppointmentGlobalController::class, 'exportExcel'])
            ->name('appoinments.export.excel');

        Route::get('appoinments/exportCSV', [AppointmentGlobalController::class, 'exportCSV'])
            ->name('appoinments.export.csv');

        // Permissions

        Route::get('permissions/all', [PermissionGlobalController::class, 'index'])
            ->name('permissions.index');

        Route::get('permissions/daughters/search', [PermissionGlobalController::class, 'search'])
            ->name('permissions.daughters.index');

        Route::post('permissions/store', [PermissionGlobalController::class, 'store'])
            ->name('permissions.store');

        Route::put('permissions/update/{appoinment_id}', [PermissionGlobalController::class, 'update'])
            ->name('permissions.update');

        Route::delete('permissions/delete/{appoinment_id}', [PermissionGlobalController::class, 'destroy'])
            ->name('permissions.delete');

        Route::get('permissions/report/all', [PermissionGlobalController::class, 'printAllPermissions'])
            ->name('permissions.pdf');

        Route::get('permissions/exportExcel', [PermissionGlobalController::class, 'exportExcel'])
            ->name('permissions.export.excel');

        Route::get('permissions/exportCSV', [PermissionGlobalController::class, 'exportCSV'])
            ->name('permissions.export.csv');

        // Transfers

        Route::get('transfers/all', [TransferGlobalController::class, 'index'])
            ->name('transfers.index');

        Route::get('transfers/profile/show/{user_id}', [TransferGlobalController::class, 'show'])
            ->name('transfers.daughters.show');

        Route::get('transfers/daughters/search', [TransferGlobalController::class, 'search'])
            ->name('transfers.daughters.index');

        Route::post('transfers/store', [TransferGlobalController::class, 'store'])
            ->name('transfers.store');

        Route::put('transfers/update/{transfer_id}', [TransferGlobalController::class, 'update'])
            ->name('transfers.update');

        Route::delete('transfers/delete/{transfer_id}', [TransferGlobalController::class, 'destroy'])
            ->name('transfers.delete');

        Route::get('transfers/report/all', [TransferGlobalController::class, 'printAllTransfers'])
            ->name('transfers.pdf');

        Route::get('transfers/exportExcel', [TransferGlobalController::class, 'exportExcel'])
            ->name('transfers.export.excel');

        Route::get('transfers/exportCSV', [TransferGlobalController::class, 'exportCSV'])
            ->name('transfers.export.csv');

        //

        Route::get('files/all', [FileGlobalController::class, 'index'])
            ->name('filesglobal.daughter.index');

        Route::get('files/all/search', [FileGlobalController::class, 'search'])
            ->name('filesglobal.daughters.search');

        //

        Route::get('community/activities/all', [ActivityGlobalController::class, 'index'])
            ->name('activities.index');

        Route::get('community/activities/search', [ActivityGlobalController::class, 'search'])
            ->name('activities.communities.index');

        Route::get('community/activities/report/all', [ActivityGlobalController::class, 'printAllActivities'])
            ->name('activities.communities.pdf');

        Route::get('community/activities/exportExcel', [ActivityGlobalController::class, 'exportExcel'])
            ->name('activities.communities.export.excel');

        Route::get('community/activities/exportCSV', [ActivityGlobalController::class, 'exportCSV'])
            ->name('activities.communities.export.csv');

        //

        Route::get('community/resumes/all', [ResumeGlobalController::class, 'index'])
            ->name('resumes.index');

        Route::get('community/resumes/search', [ResumeGlobalController::class, 'search'])
            ->name('resumes.communities.index');

        Route::get('community/resumes/report/all', [ResumeGlobalController::class, 'printAllResumes'])
            ->name('resumes.communities.pdf');

        Route::get('community/resumes/exportExcel', [ResumeGlobalController::class, 'exportExcel'])
            ->name('resumes.communities.export.excel');

        Route::get('community/resumes/exportCSV', [ResumeGlobalController::class, 'exportCSV'])
            ->name('resumes.communities.export.csv');

        //

        Route::get('community/visits/all', [VisitGlobalController::class, 'index'])
            ->name('visits.index');

        Route::get('community/visits/search', [VisitGlobalController::class, 'search'])
            ->name('visits.communities.index');

        Route::get('community/visits/report/all', [VisitGlobalController::class, 'printAllVisits'])
            ->name('visits.communities.pdf');

        Route::get('community/visits/exportExcel', [VisitGlobalController::class, 'exportExcel'])
            ->name('visits.communities.export.excel');

        Route::get('community/visits/exportCSV', [VisitGlobalController::class, 'exportCSV'])
            ->name('visits.communities.export.csv');
    }
);
