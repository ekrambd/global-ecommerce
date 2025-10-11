<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\OrderController;

Route::get('/admin/login', [IndexController::class, 'loginPage']);

Route::post('admin-login', [AccessController::class, 'adminLogin']);

Route::get('/admin/logout', [AccessController::class, 'adminLogout']);

Route::group(['middleware' => 'prevent-back-history'],function(){

	//admin dashboard

    Route::get('/dashboard', [DashboardController::class, 'Dashboard']);
    
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
	Route::get('/add-product-variant/{id}', [AjaxController::class, 'addProductVariant']);
	Route::post('save-product-variant', [AjaxController::class, 'saveProductVariant']);

	//sliders
	Route::resource('sliders', SliderController::class);

	//orders

	Route::get('/order-lists', [OrderController::class, 'orderLists']);

	Route::get('/show-order/{id}', [OrderController::class, 'showOrder']);

});