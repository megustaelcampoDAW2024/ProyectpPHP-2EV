<?php

use App\Http\Controllers\Ejercicios;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

Route::any('/', [TareaController::class, 'logInCreate'])->name('logIn.create');
Route::any('/logIn', [TareaController::class, 'logInStore'])->name('logIn.store');
Route::any('/inicio', [TareaController::class, 'inicio'])->name('inicio');