<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Importación unificada de Controladores para evitar conflictos de rutas
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController; // <-- Agregado para el nuevo módulo
use App\Http\Controllers\TipoHabitacionController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\CancelacionController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de Autenticación de Laravel
Auth::routes();

// Grupo de Rutas Protegidas por Autenticación
Route::middleware(['auth'])->group(function () {


    Route::get('/pagos/{id}/factura', [PagoController::class, 'generarFactura'])->name('pagos.factura');
    // Panel de Control Principal
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // MÓDULO DE CLIENTES (Agregado aquí de forma oficial)
    Route::resource('clientes', ClienteController::class);

    // Recursos Estándar del Hotel
    Route::resource('tipohabitaciones', TipoHabitacionController::class);
    Route::resource('habitaciones', HabitacionController::class);
    Route::resource('cancelaciones', CancelacionController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('reservaciones', ReservaController::class);

    // Rutas Personalizadas para Cambios de Estado Vía PUT
    Route::put('tipohabitaciones/{id}/estado', [TipoHabitacionController::class, 'cambiarEstado'])->name('tipohabitaciones.estado');
    Route::put('habitaciones/{id}/estado', [HabitacionController::class, 'cambiarEstado'])->name('habitaciones.estado');
    Route::put('reservaciones/{id}/estado', [ReservaController::class, 'cambiarEstado'])->name('reservaciones.estado');
    Route::put('pagos/{id}/estado', [PagoController::class, 'cambiarEstado'])->name('pagos.estado');
    Route::put('cancelaciones/{id}/estado', [CancelacionController::class, 'cambiarEstado'])->name('cancelaciones.estado');

});
