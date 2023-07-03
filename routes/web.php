<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CarruselController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CapacidadController;
use App\Http\Controllers\LiberacionController;
use App\Http\Controllers\EstadoController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'App\Http\Middleware\AuthAdmin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin-carrusel', [CarruselController::class, 'index'])->name('ver.carrusel');
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos');

    Route::get('/obtener-estados', [EstadoController::class, 'obtenerEstados']);
    Route::get('/obtener-capacidades', [CapacidadController::class, 'obtenerCapacidades']);
    Route::get('/obtener-liberaciones', [LiberacionController::class, 'obtenerLiberaciones']);
    Route::get('/obtener-marcas', [MarcaController::class, 'obtenerMarcas']);
    Route::get('/obtener-categorias', [CategoriaController::class, 'obtenerCategorias']);

    Route::post('/admin-carrusel/registrar', [CarruselController::class, 'store'])->name('agregar.carrusel');
    Route::post('/productos/registrar', [ProductoController::class, 'store'])->name('agregar.producto');
    Route::post('/productos/registrar/marca', [MarcaController::class, 'store'])->name('agregar.marca');
    Route::post('/productos/registrar/categoria', [CategoriaController::class, 'store'])->name('agregar.categoria');
    Route::post('/productos/registrar/capacidad', [CapacidadController::class, 'store'])->name('agregar.capacidad');
    Route::post('/productos/registrar/liberacion', [LiberacionController::class, 'store'])->name('agregar.liberacion');
    Route::post('/productos/registrar/estado', [EstadoController::class, 'store'])->name('agregar.estado');

    Route::delete('/eliminar/producto/{id}', [ProductoController::class, 'destroy'])->name('eliminar.producto');
    Route::delete('/eliminar/marca/{id}', [MarcaController::class, 'destroy'])->name('eliminar.marca');
    Route::delete('/eliminar/capacidad/{id}', [CapacidadController::class, 'destroy'])->name('eliminar.capacidad');
    Route::delete('/eliminar/liberacion/{id}', [LiberacionController::class, 'destroy'])->name('eliminar.liberacion');
    Route::delete('/eliminar/estado/{id}', [EstadoController::class, 'destroy'])->name('eliminar.estado');
    Route::delete('/eliminar/categoria/{id}', [CategoriaController::class, 'destroy'])->name('eliminar.categoria');
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
