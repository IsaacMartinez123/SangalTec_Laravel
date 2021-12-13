<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ClientesController as ControllersClientesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');



Route::get('/clientes', [ControllersClientesController::class, 'index'])->middleware('auth');

Route::get('/clientes/listar', [ControllersClientesController::class, 'listar'])->name('clientes.datatable')->middleware('auth');

Route::get('/clientes/crear', [ControllersClientesController::class, 'crear'])->middleware('auth');

Route::post('/clientes/guardar', [ControllersClientesController::class, 'store'])->name('clientes.store')->middleware('auth');

Route::get('/clientes/editar/{id}', [ControllersClientesController::class, 'editar'])->name('clientes.editar')->middleware('auth');

Route::post('/clientes/actualizar/{id}', [ControllersClientesController::class, 'update'])->name('clientes.actualizar')->middleware('auth');



Route::get('/ventas', [VentasController::class, 'index'])->middleware('auth');

Route::get('/ventas/listar', [VentasController::class, 'listar'])->middleware('auth');

Route::get('/ventas/crear', [VentasController::class, 'crear'])->middleware('auth');

Route::post('/ventas/guardar', [VentasController::class, 'store'])->name('ventas.store')->middleware('auth');

Route::get('/ventas/verproductos/{id}', [VentasController::class, 'listardetalle'])->name('ventas.detalle')->middleware('auth');


Route::get('/ventas/cambiarEstado/{id}/{Estado}', [VentasController::class, 'updateState'])->name('ventas.cambiar')->middleware('auth');


