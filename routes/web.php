<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\CancelacionController;

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
    Route::put('tipohabitaciones/{id}/estado',[App\Http\Controllers\TipoHabitacionController::class, 'cambiarEstado'])->name('tipohabitaciones.estado');
    Route::put(
        'habitaciones/{id}/estado',
        [HabitacionController::class, 'cambiarEstado']
    )->name('habitaciones.estado');
    Route::put(
        'reservaciones/{id}/estado',
        [ReservaController::class, 'cambiarEstado']
    )->name('reservaciones.estado');
    Route::put(
        'pagos/{id}/estado',
        [PagoController::class, 'cambiarEstado']
    )->name('pagos.estado');
    Route::put(
        'cancelaciones/{id}/estado',
        [CancelacionController::class, 'cambiarEstado']
    )->name('cancelaciones.estado');

});
