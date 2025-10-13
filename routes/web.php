<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\IndikatorDetailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('notif', NotifikasiController::class)->names([
        'store' => 'notifikasi.store',
        'create' => 'notif.create',
        'show' => 'notif.show',
        'edit' => 'notif.edit',
        'update' => 'notif.update',
        'destroy' => 'notif.destroy',
    ]);

    Route::post('/notif/{id}/baca', [NotifikasiController::class, 'baca'])->name('notif.baca');
    Route::get('/notif/{id}/index', [NotifikasiController::class, 'index'])->name('notif.index');

    Route::resource('indikator', IndikatorController::class)->parameters(['indikator' => 'indikatorModel']);
    // Route::resource('indikatordetail', IndikatorController::class);
    Route::get('/indikator/{indikator}/detail/create', [IndikatorDetailController::class, 'create'])->name('indikator.detail.create');
    Route::post('/indikator/{indikator}/detail', [IndikatorDetailController::class, 'store'])->name('indikator.detail.store');
    Route::get('/indikator/{indikator}/detail', [IndikatorDetailController::class, 'show'])->name('indikator.detail.show');
    Route::get('/indikator/{indikator}/detail/edit', [IndikatorDetailController::class, 'edit'])->name('indikator.detail.edit');
    Route::put('/indikator/{indikator}/detail/update', [IndikatorDetailController::class, 'update'])->name('indikator.detail.update');
    Route::delete('/indikator/{indikator}/detail/delete', [IndikatorDetailController::class, 'destroy'])->name('indikator.detail.destroy');
    // Route::resource('penilaian', PenilaianController::class);

    Route::get('/penilaian/{indikator}/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian/{indikator}/detail/index', [PenilaianController::class, 'detail'])->name('penilaian.detail');
    Route::get('/penilaian/{indikator}/items/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::patch('/penilaian/{indikator}/items/update', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::get('/penilaian/{indikator}/items', [PenilaianController::class, 'data'])->name('penilaian.data');
    Route::get('/penilaian/{indikator}/items/show', [PenilaianController::class, 'show'])->name('penilaian.show');
    Route::delete('/penilaian/{indikator}/delete', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

    Route::get('/home', [UserController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postLogin']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
