<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

//frontend routes
Route::get('/', [FrontController::class, 'frontPage']);