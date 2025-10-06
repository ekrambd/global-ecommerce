<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

//ajax requests
Route::post('category-status-update', [AjaxController::class, 'categoryStatusUpdate']);
Route::post('subcategory-status-update', [AjaxController::class, 'subCategoryStatusUpdate']);
Route::post('brand-status-update', [AjaxController::class, 'brandStatusUpdate']);
Route::post('unit-status-update', [AjaxController::class, 'unitStatusUpdate']);
Route::post('variant-status-update', [AjaxController::class, 'variantStatusUpdate']);
Route::post('product-status-update', [AjaxController::class, 'productStatusUpdate']);
Route::get('/get-subcategories/{id}', [AjaxController::class, 'getSubcategories']);