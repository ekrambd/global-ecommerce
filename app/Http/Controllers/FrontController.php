<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
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
}
