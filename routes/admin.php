<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;

Route::group(['middleware' => 'prevent-back-history'],function(){
	//categories
	Route::resource('categories', CategoryController::class);
	//subcategories
	Route::resource('subcategories', SubcategoryController::class);
	//brands
	Route::resource('brands', BrandController::class);
	//units
	Route::resource('units', UnitController::class);
	//variants
	Route::resource('variants', VariantController::class);
	//products
	Route::resource('products', ProductController::class);
});