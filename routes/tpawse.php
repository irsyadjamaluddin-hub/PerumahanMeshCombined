<?php

use App\Http\Controllers\TPAWSEAccessRequestController;
use App\Http\Controllers\TPAWSEAdminUserController;
use App\Http\Controllers\TPAWSEClusterController;
use App\Http\Controllers\TPAWSEDashboardController;
use App\Http\Controllers\TPAWSELocaleController;
use App\Http\Controllers\TPAWSEObservationController;
use App\Http\Controllers\TPAWSEPortalController;
use App\Http\Controllers\TPAWSEProfileController;
use App\Http\Controllers\TPAWSEReportController;
use App\Http\Controllers\TPAWSESchoolController;
use App\Http\Controllers\TPAWSETeacherBiodataController;
use App\Http\Controllers\TPAWSETeachingProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| TPAWSE Routes
|--------------------------------------------------------------------------
|
| TPAWSE is treated as its own application inside MESH, reachable under
| the /tpawse prefix so its route names/URIs can't collide with MESH's
| own routes, mirroring how routes/dicthr.php is isolated. Unlike DICTHR,
| TPAWSE authenticates via MESH's own 'web' guard/session (true SSO) — the
| 'auth' + 'tpawse.approved' middleware below only gate whether that MESH
| user has been approved for TPAWSE access, not who they're logged in as.
|
*/

Route::prefix('tpawse')->name('tpawse.')->middleware(['web', 'set.locale'])->group(function () {
    Route::get('/', [TPAWSEPortalController::class, 'index'])->name('portal.index');
    Route::post('/locale/{locale}', [TPAWSELocaleController::class, 'switch'])->name('locale.switch');

    Route::middleware('auth')->group(function () {
        Route::get('/request-access', [TPAWSEAccessRequestController::class, 'show'])->name('access.request');
        Route::post('/request-access', [TPAWSEAccessRequestController::class, 'store'])->name('access.request.store');
    });

    Route::middleware(['auth', 'tpawse.approved'])->group(function () {
        Route::get('/dashboard', [TPAWSEDashboardController::class, 'index'])->name('dashboard');

        // Leading backslash needed here too: RouteServiceProvider's legacy
        // namespace otherwise double-prepends "App\Http\Controllers" onto the
        // bare controller class-string that Route::resource() builds.
        Route::resource('teachers', '\\'.TPAWSETeacherBiodataController::class);

        Route::get('/teachers/{teacher}/teaching-profiles/create', [TPAWSETeachingProfileController::class, 'create'])
            ->name('teachers.teaching-profiles.create');
        Route::post('/teachers/{teacher}/teaching-profiles', [TPAWSETeachingProfileController::class, 'store'])
            ->name('teachers.teaching-profiles.store');
        Route::get('/teaching-profiles/{teachingProfile}/edit', [TPAWSETeachingProfileController::class, 'edit'])
            ->name('teaching-profiles.edit');
        Route::put('/teaching-profiles/{teachingProfile}', [TPAWSETeachingProfileController::class, 'update'])
            ->name('teaching-profiles.update');
        Route::delete('/teaching-profiles/{teachingProfile}', [TPAWSETeachingProfileController::class, 'destroy'])
            ->name('teaching-profiles.destroy');

        Route::get('/teaching-profiles/{teachingProfile}/observations/create', [TPAWSEObservationController::class, 'createForProfile'])
            ->name('teaching-profiles.observations.create');
        Route::post('/teaching-profiles/{teachingProfile}/observations', [TPAWSEObservationController::class, 'storeForProfile'])
            ->name('teaching-profiles.observations.store');

        Route::get('/review-queue', [TPAWSEObservationController::class, 'reviewQueue'])->name('observations.review_queue');
        Route::get('/observations/export/csv', [TPAWSEObservationController::class, 'exportCsv'])->name('observations.export.csv');
        Route::post('/observations/bulk-submit', [TPAWSEObservationController::class, 'bulkSubmit'])->name('observations.bulk_submit');
        Route::post('/observations/bulk-approve', [TPAWSEObservationController::class, 'bulkApprove'])->name('observations.bulk_approve');
        Route::post('/observations/bulk-finalize', [TPAWSEObservationController::class, 'bulkFinalize'])->name('observations.bulk_finalize');
        Route::post('/observations/{observation}/submit', [TPAWSEObservationController::class, 'submit'])->name('observations.submit');
        Route::post('/observations/{observation}/approve', [TPAWSEObservationController::class, 'approve'])->name('observations.approve');
        Route::post('/observations/{observation}/return', [TPAWSEObservationController::class, 'returnForCorrection'])->name('observations.return');
        Route::post('/observations/{observation}/finalize', [TPAWSEObservationController::class, 'finalize'])->name('observations.finalize');

        Route::resource('observations', '\\'.TPAWSEObservationController::class)->except(['create', 'store']);
        Route::get('/reports', [TPAWSEReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export/csv', [TPAWSEReportController::class, 'exportCsv'])->name('reports.export.csv');

        Route::resource('clusters', '\\'.TPAWSEClusterController::class);
        Route::resource('schools', '\\'.TPAWSESchoolController::class);

        Route::middleware('admin.only')->group(function () {
            Route::resource('admin/users', '\\'.TPAWSEAdminUserController::class)->only(['index', 'edit', 'update'])->names('admin.users');
            Route::post('/admin/users/{user}/reject', [TPAWSEAdminUserController::class, 'reject'])->name('admin.users.reject');
        });

        Route::get('/profile', [TPAWSEProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [TPAWSEProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [TPAWSEProfileController::class, 'update'])->name('profile.update');
    });
});
