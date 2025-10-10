<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;

//frontend routes
Route::get('/', [FrontController::class, 'frontPage'])->name('home');

//cart routes
Route::get('/carts', [CartController::class, 'carts']);
Route::post('/cart-update', [CartController::class, 'cartUpdate']);
