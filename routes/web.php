<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class);
Route::resource('indikator', IndikatorController::class)->parameters(['indikator' => 'indikatorModel']);

Route::get('/home', [UserController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/postlogin', [LoginController::class, 'postLogin']);
Route::get('/dashboard', [DashboardController::class, 'index']);
