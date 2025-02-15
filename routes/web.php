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
    Route::get('/', [TareaController::class, 'index'])->name('tarea.index');
    Route::get('/tarea/index', [TareaController::class, 'index'])->name('tarea.index');
    Route::get('/tarea/create', [TareaController::class, 'create'])->name('tarea.create');
    Route::post('/tarea/store', [TareaController::class, 'store'])->name('tarea.store');
    Route::get('/tarea/show/{tarea}', [TareaController::class, 'show'])->name('tarea.show');
    Route::get('/tarea/edit/{tarea}', [TareaController::class, 'edit'])->name('tarea.edit');
    Route::put('/tarea/update/{tarea}', [TareaController::class, 'update'])->name('tarea.update');
    Route::get('/tarea/complete/{tarea}', [TareaController::class, 'complete'])->name('tarea.complete');
    Route::put('/tarea/completeUpdate/{tarea}', [TareaController::class, 'completeUpdate'])->name('tarea.completeUpdate');
    Route::delete('/tarea/destroy/{tarea}', [TareaController::class, 'destroy'])->name('tarea.destroy');
});