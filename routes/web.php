<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CarruselController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'App\Http\Middleware\AuthAdmin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin-carrusel', [CarruselController::class, 'index'])->name('subir.carrusel');
    Route::post('/carrusel/registrar', [CarruselController::class, 'store'])->name('agregar.carrusel');
    Route::delete('/admin-carrusel/{id}', [CarruselController::class, 'destroy'])->name('eliminar-carrusel');
    Route::put('/admin-carrusel/{id}/actualizar', [CarruselController::class, 'update'])->name('actualizar-carrusel');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrar.sesion');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', [InicioController::class, 'index'])->name('inicio');
    Route::get('/mi-cuenta', [LoginController::class, 'index'])->name('cuenta');
    Route::post('/inicio-sesion', [LoginController::class, 'login'])->name('inicio.sesion');
});
