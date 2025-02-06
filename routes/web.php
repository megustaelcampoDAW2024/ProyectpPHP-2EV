<?php

use App\Http\Controllers\Ejercicios;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\TareaController::class, 'mostrarTareas'])->name('mostrar.tarea');
Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'mostrarTareas'])->name('mostrar.tarea');

Route::any('/inicio', [TareaController::class, 'inicio'])->name('inicio');
Auth::routes();