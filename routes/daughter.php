<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Daughter\FileGlobalController;
use App\Http\Controllers\Daughter\UserProfileController;
use App\Http\Controllers\Daughter\VisitGlobalController;
use App\Http\Controllers\Daughter\FilesProfileController;
use App\Http\Controllers\Daughter\ResumeGlobalController;
use App\Http\Controllers\Daughter\ArticleGlobalController;
use App\Http\Controllers\Daughter\HealthProfileController;
use App\Http\Controllers\Daughter\PermitProfileController;
use App\Http\Controllers\Daughter\RecordProfileController;
use App\Http\Controllers\Daughter\ActivityGlobalController;
use App\Http\Controllers\Daughter\InventoryGlobalController;
use App\Http\Controllers\Daughter\TransferProfileController;
use App\Http\Controllers\Daughter\SacramentProfileController;
use App\Http\Controllers\Daughter\InfoFamilyProfileController;
use App\Http\Controllers\Secretary\Community\CommunityVisitController;
use App\Http\Controllers\Secretary\Community\FilesCommunityController;
use App\Http\Controllers\Secretary\Community\CommunityResumeController;
use App\Http\Controllers\Secretary\Community\CommunityActivityController;
use App\Http\Controllers\Secretary\Community\Inventory\CommunityArticleController;
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

Route::get('address/profile/address_bt/{actual_ubication}', [AddressController::class, 'getSaveAddressBt'])
    ->name('address.actual-address-bt');

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

        //  Communities Activities

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

        // Communities Activities

        Route::get('activities/{community_id}', [CommunityActivityController::class, 'index'])
            ->name('communities.activity.index');

        Route::post('activities/store/{community_id}', [CommunityActivityController::class, 'store'])
            ->name('communities.activity.store');

        Route::delete('activities/delete/{community_id}/{activity_id}', [CommunityActivityController::class, 'destroy'])
            ->name('communities.activity.delete');

        Route::put('activities/update/{community_id}/{activity_id}', [CommunityActivityController::class, 'update'])
            ->name('communities.activity.update');

        //  Communities Resumes

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

        // Communities Resumes

        Route::get('resumes/{community_id}', [CommunityResumeController::class, 'index'])
            ->name('communities.resume.index');

        Route::post('resumes/store/{community_id}', [CommunityResumeController::class, 'store'])
            ->name('communities.resume.store');

        Route::delete('resumes/delete/{community_id}/{resume_id}', [CommunityResumeController::class, 'destroy'])
            ->name('communities.resume.delete');

        Route::put('resumes/update/{community_id}/{resume_id}', [CommunityResumeController::class, 'update'])
            ->name('communities.resume.update');

        // Visiis Controller

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

        // Communities Visits

        Route::get('visits/{community_id}', [CommunityVisitController::class, 'index'])
            ->name('communities.visit.index');

        Route::post('visits/store/{community_id}', [CommunityVisitController::class, 'store'])
            ->name('communities.visit.store');

        Route::delete('visits/delete/{community_id}/{visit_id}', [CommunityVisitController::class, 'destroy'])
            ->name('communities.visit.delete');

        Route::put('visits/update/{community_id}/{visit_id}', [CommunityVisitController::class, 'update'])
            ->name('communities.visit.update');

        // Communities Files Controllers

        Route::get('community/filesglobal/all', [FileGlobalController::class, 'index'])
            ->name('filesglobal.communities.index');

        Route::get('community/filesglobal/all/search', [FileGlobalController::class, 'search'])
            ->name('filesglobal.communities.search');

        // Communities Files Controllers

        Route::get('community/files/{community_id}', [FilesCommunityController::class, 'index'])
            ->name('communities.files.index');

        Route::get('community/files/show/{file_id}', [FilesCommunityController::class, 'show'])
            ->name('communities.files.show');

        Route::post('community/files/{community_id}', [FilesCommunityController::class, 'store'])
            ->name('communities.files.store');

        Route::get('community/files/edit/{file_id}', [FilesCommunityController::class, 'edit'])
            ->name('communities.files.edit');

        Route::post('community/files/update/{community_id}/{file_id}', [FilesCommunityController::class, 'update'])
            ->name('communities.files.update');

        Route::delete('community/files/delete/{file_id}', [FilesCommunityController::class, 'destroy'])
            ->name('communities.files.delete');

        // Inventory Controllers

        Route::get('community/inventory', [InventoryGlobalController::class, 'index'])
            ->name('community.inventory.index');

        Route::get('inventory/{community_id}', [CommunityInventoryController::class, 'getInventory'])
            ->name('communities.inventory.index');

        Route::put('inventory/update/{inventory_id}', [CommunityInventoryController::class, 'update'])
            ->name('communities.inventory.update');

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

        Route::get('community/inventory/section/{section_slug}/articles/all', [ArticleGlobalController::class, 'index'])
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
    }
);
