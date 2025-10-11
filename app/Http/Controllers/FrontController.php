<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Slider;
use Session;

class FrontController extends Controller
{
    public function frontPage()
    {   
    	return view('layouts.front'); 
    }

	public function carts()
    {    
        $carts = Cart::where('cart_session_id',Session::get('cart_session_id'))->latest()->get();
        return view('fronts.carts', compact('carts'));
    }

    public function productDetails($id)
    {
    	$product = Product::with([
		    'category',
		    'productvariants' => function ($query) {
		        $query->whereNotNull('image');
		    }
		])->findOrFail($id);


    	$variants = Variant::with(['productvariants' => function ($query) use ($id) {
	        $query->where('product_id', $id);
	    }])
	    ->whereHas('productvariants', function ($query) use ($id) {
	        $query->where('product_id', $id);
	    })
	    ->where('status', 'Active')
	    ->get();

	    $relatedProducts = Product::where('category_id',$product->category->id)->where('status','Active')->latest()->get();

    	return view('fronts.product_details', compact('product', 'variants','relatedProducts'));
    }

    public function productLists(Request $request)
    {
    	$query = Product::query();


	    if ($request->filled('category_id')) {
	        $query->where('category_id', $request->category_id);
	    }


	    if ($request->filled('brand_id')) {
	        $query->where('brand_id', $request->brand_id);
	    }

	    if ($request->filled('product_id')) {
	        $query->where('id', $request->product_id);
	    }

	    if ($request->filled('search_product')) {
	        $search = $request->search_product;
	        $query->where(function ($q) use ($search) {
	            $q->where('product_name', 'LIKE', "%{$search}%");
	        });
	    }

	    $products = $query->with('category')->latest()->paginate(4);

	    $products->appends($request->query());

	    $products->appends($request->only(['category_id', 'brand_id', 'product_id', 'search_product']));

	    return view('fronts.product_page', compact('products'));
    	//return view('fronts.product_page', compact('products'));
    }
}
