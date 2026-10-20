<?php

use App\Http\Controllers\DicthrAccessRequestController;
use App\Http\Controllers\DicthrBiodataController;
use App\Http\Controllers\DicthrDashboardController;
use App\Http\Controllers\DicthrLocaleController;
use App\Http\Controllers\DicthrPegawaiCutiController;
use App\Http\Controllers\DicthrStatusPekerjaanController;
use App\Http\Controllers\DicthrTrainingController;
use App\Http\Controllers\DicthrUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| DICTHR Routes
|--------------------------------------------------------------------------
|
| DICTHR is treated as its own application inside MESH, reachable under
| the /dicthr prefix so nothing here can collide with MESH's own routes or
| route names. Unlike before, DICTHR now authenticates via MESH's own
| 'web' guard/session (true SSO) — the 'auth' + 'dicthr.approved'
| middleware below only gate whether that MESH user has been approved for
| DICTHR access, not who they're logged in as.
|
*/

Route::prefix('dicthr')->name('dicthr.')->middleware('dicthr.locale')->group(function () {

    Route::get('/', function () {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        return auth()->user()->hasDicthrAccess()
            ? redirect()->route('dicthr.dashboard')
            : redirect()->route('dicthr.access.request');
    })->name('index');

    Route::post('/locale/{locale}', [DicthrLocaleController::class, 'switch'])->name('locale.switch');

    Route::middleware('auth')->group(function () {
        Route::get('request-access', [DicthrAccessRequestController::class, 'show'])->name('access.request');
        Route::post('request-access', [DicthrAccessRequestController::class, 'store'])->name('access.request.store');
    });

    // ── Authenticated + approved ─────────────────────────────────────────
    Route::middleware(['auth', 'dicthr.approved'])->group(function () {
        Route::get('/dashboard', [DicthrDashboardController::class, 'dashboard'])->name('dashboard');

        // ── Export (must be registered before the resource route below so
        // that "export" is never captured by the {biodata} wildcard) ────
        Route::get('biodata/export/{format}', [DicthrBiodataController::class, 'exportAll'])
            ->where('format', 'excel|pdf')
            ->name('biodata.export');
        Route::get('biodata/{biodata}/export/{format}', [DicthrBiodataController::class, 'exportSingle'])
            ->where('format', 'excel|pdf')
            ->name('biodata.export.single');

        // Leading backslash needed: Route::resource() builds its actions as
        // "Controller@method" strings internally, which are subject to
        // RouteServiceProvider's legacy namespace-doubling.
        Route::resource('biodata', '\\'.DicthrBiodataController::class)
            ->parameters(['biodata' => 'biodata'])
            ->except(['show']);

        // ── Training ──────────────────────────────────────────────────────
        Route::get('training', [DicthrTrainingController::class, 'index'])->name('training.index');

        Route::prefix('biodata/{biodata}')->group(function () {
            Route::post('training', [DicthrTrainingController::class, 'store'])->name('training.store');
            Route::patch('training/{training}', [DicthrTrainingController::class, 'update'])->name('training.update');
            Route::delete('training/{training}', [DicthrTrainingController::class, 'destroy'])->name('training.destroy');
            Route::get('training/{training}/dokumen', [DicthrTrainingController::class, 'download'])->name('training.download');
        });

        // ── Cuti ──────────────────────────────────────────────────────────
        Route::get('cuti', [DicthrPegawaiCutiController::class, 'index'])->name('cuti.index');

        // ── Pengalaman Pekerja ───────────────────────────────────────────
        Route::get('pengalaman', [DicthrStatusPekerjaanController::class, 'index'])->name('pengalaman.index');

        Route::prefix('biodata/{biodata}')->name('biodata.')->group(function () {
            Route::post('cuti', [DicthrPegawaiCutiController::class, 'store'])->name('cuti.store');
            Route::patch('cuti/{cuti}', [DicthrPegawaiCutiController::class, 'update'])->name('cuti.update');
            Route::delete('cuti/{cuti}', [DicthrPegawaiCutiController::class, 'destroy'])->name('cuti.destroy');
            Route::get('cuti/{cuti}/dokumen', [DicthrPegawaiCutiController::class, 'download'])->name('cuti.download');

            // ── Status Pekerjaan ────────────────────────────────────────────
            Route::post('status', [DicthrStatusPekerjaanController::class, 'store'])->name('status.store');
            Route::patch('status/{statusPekerjaan}', [DicthrStatusPekerjaanController::class, 'update'])->name('status.update');
            Route::delete('status/{statusPekerjaan}', [DicthrStatusPekerjaanController::class, 'destroy'])->name('status.destroy');
            Route::get('status/{statusPekerjaan}/dokumen', [DicthrStatusPekerjaanController::class, 'download'])->name('status.download');
        });

        // ── Admin-only (DICTHR is_admin flag): user management ──────────
        Route::middleware(['dicthr.admin'])->group(function () {

            Route::get('admin', function () {
                return view('dicthr.admin.dashboard');
            })->name('admin.dashboard');

            // ── Access management ────────────────────────────────────────────
            Route::get('users', [DicthrUserController::class, 'index'])->name('users.index');
            Route::post('users/{user}/approve', [DicthrUserController::class, 'approve'])->name('users.approve');
            Route::post('users/{user}/reject', [DicthrUserController::class, 'reject'])->name('users.reject');
            Route::post('users/{user}/toggle-admin', [DicthrUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
            Route::delete('users/{user}', [DicthrUserController::class, 'revoke'])->name('users.revoke');
        });
    });
});
