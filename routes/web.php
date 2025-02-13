<?php

use App\Http\Controllers\Ejercicios;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/permiso', function () {
    return view('permiso');
})->name('no.permisos');

// TareaController
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\TareaController::class, 'index'])->name('tarea.index');
    Route::get('/tarea/index', [App\Http\Controllers\TareaController::class, 'index'])->name('tarea.index');
    Route::get('/tarea/create', [App\Http\Controllers\TareaController::class, 'create'])->name('tarea.create');
    Route::post('/tarea/store', [App\Http\Controllers\TareaController::class, 'store'])->name('tarea.store');
    Route::get('/tarea/edit/{id}', [App\Http\Controllers\TareaController::class, 'edit'])->name('tarea.edit');
    Route::put('/tarea/update/{id}', [App\Http\Controllers\TareaController::class, 'update'])->name('tarea.update');
    Route::delete('/tarea/destroy/{id}', [App\Http\Controllers\TareaController::class, 'destroy'])->name('tarea.destroy');
});