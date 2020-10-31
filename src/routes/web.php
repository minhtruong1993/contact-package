<?php

use Illuminate\Support\Facades\Route;

use Mt\Contact\Http\Controllers\ContactController;



Route::get('contact', [ContactController::class, 'index']);

Route::post('contact', [ContactController::class, 'store'])->name('contact');
