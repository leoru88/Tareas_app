<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareasController;

Route::get('/', [TareasController::class, 'index']);

Route::post('/', [TareasController::class, 'store']);

Route::get('/tareas-en-proceso', [TareasController::class, 'tareasEnProceso']);

Route::get('/lista-de-tareas', [TareasController::class, 'todasLastareas']);

Route::get('/tareas/{id}', [TareasController::class, 'show'])->name('tareas.show');

Route::put('/tareas/{id}', [TareasController::class, 'update'])->name('tareas.update');

Route::post('/filtrar-por-estado', [TareasController::class, 'filtrarPorEstado']);

Route::post('/filtrar-por-fecha', [TareasController::class, 'filtrarPorFecha']);

Route::get('/limpiar-filtros', [TareasController::class, 'limpiarFiltros']);

Route::delete('/tareas/{id}', [TareasController::class, 'destroy']);