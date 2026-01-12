<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('carreras', CarreraController::class);
