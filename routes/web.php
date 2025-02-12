<?php

use App\Http\Controllers\Ejercicios;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// TareaController
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\TareaController::class, 'index'])->name('tarea.index');
    Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'mostrarTareas'])->name('tarea.index');
});