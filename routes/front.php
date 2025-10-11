<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;

//frontend routes
Route::get('/', [FrontController::class, 'frontPage'])->name('home');

//cart routes
Route::get('/carts', [CartController::class, 'carts']);
Route::post('/cart-update', [CartController::class, 'cartUpdate']);

//product routes
Route::get('/product-details/{id}', [FrontController::class, 'productDetails']);
Route::get('/product-lists', [FrontController::class, 'productLists']);

//auth
Route::get('/login-register', [UserAuthController::class, 'loginRegister']);
Route::post('user-signup', [UserAuthController::class, 'userSignup']);
Route::post('user-signin', [UserAuthController::class, 'userSignin']);
Route::get('/user-logout', [UserAuthController::class, 'userLogout']);

//wishlists
Route::get('/wishlists', [WishlistController::class, 'wishlists']);

//checkout
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('save-order', [CheckoutController::class, 'saveOrder']);