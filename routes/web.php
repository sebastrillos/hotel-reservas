<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('tipohabitaciones', \App\Http\Controllers\TipoHabitacionController::class);
    Route::resource('habitaciones', \App\Http\Controllers\HabitacionController::class);
    Route::resource("cancelaciones", \App\Http\Controllers\CancelacionController::class);
    Route::resource("pagos", \App\Http\Controllers\pagoController::class);
    Route::resource("reservaciones", \App\Http\Controllers\ReservaController::class);
});