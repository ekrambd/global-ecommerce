<?php
 use App\Models\Category;
 use App\Models\Unit;
 use App\Models\Subcategory;
 use App\Models\Brand;
 
function categories(){
	$categories = Category::latest()->get();
	return $categories;
}

function units(){
	$units = Unit::latest()->get();
	return $units;
}

function brands(){
	$brands = Brand::latest()->get();
	return $brands;
}

function subcategories(){
	$subcategories = Subcategory::latest()->get();
	return $subcategories;
}

function user()
{
	$user = auth()->user();
	return $user;
}

function featuredCategoryIds()
{
	$categories = Category::whereHas('products')->where('status','Active')->where('is_featured',1)->pluck('id')->toArray();
	return $categories;
}

function categorySlug($category)
{
	$slug = strtolower(str_replace(" ", "-", $category->category_name));
	return $slug;
}