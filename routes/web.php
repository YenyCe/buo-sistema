<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\DocenteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('carreras', CarreraController::class);
Route::resource('docentes', DocenteController::class);
