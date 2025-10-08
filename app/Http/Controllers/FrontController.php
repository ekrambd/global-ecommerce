<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Brand;

class FrontController extends Controller
{
    public function frontPage()
    {   
    	$menuCategories = Category::whereHas('products')
			    ->with(['subcategories' => function ($query) {
		
			        $query->whereHas('products')
			        ->where('is_mega_menu', 1)
			        ->where('status','Active')
			        ->with(['products' => function ($q) {
			            $q->where('status', 'Active');
			        }]);
			    }])
			    ->where('status', 'Active')
			    ->latest()
			    ->get();

	    $menuBrands = Brand::whereHas('products')->with(['products'=>function($query){
	    	$query->where('status','Active');
	    }])->where('status','Active')->where('is_mega_menu',1)->latest()->get();

	    $topCategories = Category::where('is_top',1)->where('status','Active')->latest()->get();

	    // $featuredCategories = Category::with(['products'=>function($query){
	    // 	$query->where('status','Active');
	    // }])->where('is_featured',1)->where('status','Active')->latest()->get(); 
	    //return featuredCategoryIds();
	    $featuredCategories = Category::whereIn('id',featuredCategoryIds())->get();
	    $featuredCategoryIds = [5,7];
	    $featuredProducts = Product::with('category')->whereIn('category_id',featuredCategoryIds())->where('status','Active')->latest()->get();

	    return $featuredProducts;

    	return view('layouts.front',compact('menuCategories','menuBrands','topCategories','featuredCategories','featuredProducts')); 
    }
}
