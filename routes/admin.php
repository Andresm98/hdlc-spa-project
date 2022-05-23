<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\PastoralController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AppointmentLevelController;
use App\Http\Controllers\Admin\AppointmentLevelCategoryController;
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


Route::group(
    ['middleware' => ['role:super admin']],
    function () {

        Route::get('admin/welcome', [UserController::class, 'welcome'])
            ->middleware('can:see admin menu')
            ->name('welcome');

        Route::get('admin/users/all', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('admin/user/create', [UserController::class, 'create'])
            ->name('user.create');

        Route::post('admin/user/store', [UserController::class, 'store'])
            ->name('user.store');

        Route::get('admin/user/show/{slug}', [UserController::class, 'show'])
            ->name('user.show');

        Route::get('admin/user/edit/{slug}', [UserController::class, 'edit'])
            ->name('user.edit');

        Route::put('admin/user/update/{user_custom}', [UserController::class, 'update'])
            ->name('user.update');

        Route::delete('admin/user/{slug}', [UserController::class, 'destroy'])
            ->name('user.destroy');

        // Group Crud Roles

        Route::resource('admin/roles', RoleController::class)
            ->names('roles');

        // Group Crud Pastoral

        Route::resource('admin/pastoral', PastoralController::class)
            ->names('pastoral');

        // Group Crud Pastoral

        Route::resource('admin/office', OfficeController::class)
            ->names('office');

        // Group Crud Zone

        Route::resource('admin/zone', ZoneController::class)
            ->names('zone');

        // Group Crud Appointment Level

        Route::resource('admin/appointmentlevel',  AppointmentLevelController::class)
            ->names('appointmentlevel');

        // Group Crud Appointment Level Category

        Route::get('admin/appointmentlevelcategory/all/{id}', [AppointmentLevelCategoryController::class, 'index'])
            ->name('appointmentlevelcategory.index');

        Route::post('admin/appointmentlevelcategory/store/{id}', [AppointmentLevelCategoryController::class, 'store'])
            ->name('appointmentlevelcategory.store');

        Route::put('admin/appointmentlevelcategory/update/{appointmentlevel}', [AppointmentLevelCategoryController::class, 'update'])
            ->name('appointmentlevelcategory.update');

        Route::delete('admin/appointmentlevelcategory/delete/{appointmentlevel}', [AppointmentLevelCategoryController::class, 'destroy'])
            ->name('appointmentlevelcategory.destroy');

        //  Group Crud

        Route::resource('admin/settings', SettingsController::class)
            ->names('settings');


        // FIXME:: Rest METHODS
        Route::get('pdf', [UserController::class, 'PDF'])
            ->name('admin.pdf');
    }
);
