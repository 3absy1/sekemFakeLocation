<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerDiemController;

Route::get('/', [PerDiemController::class, 'index'])->name('form.index');
Route::post('/submit', [PerDiemController::class, 'submit'])->name('form.submit');
