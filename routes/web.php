<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\IndikatorDetailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
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

Route::get('/home', [UserController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/postlogin', [LoginController::class, 'postLogin']);
Route::get('/dashboard', [DashboardController::class, 'index']);
