<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\IndikatorDetailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class);
Route::resource('indikator', IndikatorController::class)->parameters(['indikator' => 'indikatorModel']);
// Route::resource('indikatordetail', IndikatorController::class);
Route::get('/indikator/{indikator}/detail/create', [IndikatorDetailController::class, 'create'])->name('indikator.detail.create');
Route::post('/indikator/{indikator}/detail', [IndikatorDetailController::class, 'store'])->name('indikator.detail.store');
Route::get('/indikator/{indikator}/detail', [IndikatorDetailController::class, 'show'])->name('indikator.detail.show');
// Route::resource('penilaian', PenilaianController::class);

Route::get('/penilaian/{indikator}/create', [PenilaianController::class, 'create'])->name('penilaian.create');
Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
Route::get('/penilaian/{indikator}/index', [PenilaianController::class, 'index'])->name('penilaian.index');
Route::get('/penilaian/{indikator}/detail/index', [PenilaianController::class, 'detail'])->name('penilaian.detail');

Route::get('/home', [UserController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/postlogin', [LoginController::class, 'postLogin']);
Route::get('/dashboard', [DashboardController::class, 'index']);
