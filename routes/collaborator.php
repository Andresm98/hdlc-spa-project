<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Collaborator\CollaboratorController;

Route::group(
    ['middleware' => ['role:collaborator']],
    function () {

        //

        Route::get('list-daughters', [CollaboratorController::class, 'indexDaughters'])
            ->name('daughters.index');

        Route::get('list-daughters/exportExcel', [CollaboratorController::class, 'exportDaughtersExcel'])
            ->name('daughters.export.excel');

        Route::get('list-daughters/exportCSV', [CollaboratorController::class, 'exportDaughtersCSV'])
            ->name('daughters.export.csv');
        //

        Route::get('list-communities', [CollaboratorController::class, 'indexCommunities'])
            ->name('communities.index');

        Route::get('list-communities/exportExcel', [CollaboratorController::class, 'exportCommunitiesExcel'])
            ->name('communities.export.excel');

        Route::get('list-communities/exportCSV', [CollaboratorController::class, 'exportCommunitiesCSV'])
            ->name('communities.export.csv');

        //
    }
);
