<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Http\Requests\CheckoutRequest;
use Session;
use DB;

class CheckoutController extends Controller
{
    public function checkout()
    {   
    	if(auth()->check()){
    		$carts = Cart::with('product')->where('cart_session_id',Session::get('cart_session_id'))->get();
	    	$sum = Cart::where('cart_session_id',Session::get('cart_session_id'))->sum('unit_total');
	    	return view('fronts.checkout',compact('carts','sum'));  
    	}else{
    		return back();
    	}
    	
    }

    public function saveOrder(CheckoutRequest $request)
    {   
    	DB::beginTransaction();
    	try
    	{   
    		date_default_timezone_set("Asia/Dhaka");
    		//return response()->json($request->all());
    		$carts = Cart::with('product')->where('cart_session_id',Session::get('cart_session_id'))->get();
    		$sum = Cart::where('cart_session_id',Session::get('cart_session_id'))->sum('unit_total');
    		//$orders = [];

    		if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/order/', $name);
                $path = 'uploads/order/' . $name;
            }else{
            	$path = NULL;
            }

    		$detail = new Orderdetail();
    		$detail->user_id = user()->id;
    		$detail->paymentmethod_id = $request->paymentmethod_id;
    		$detail->name = $request->name;
    		$detail->email = $request->email;
    		$detail->phone = $request->phone;
    		$detail->zip_code = $request->zip_code;
    		$detail->full_address = $request->full_address;
    		$detail->sub_total = $sum;
    		$detail->total = $sum;
    		$detail->date = date('Y-m-d');
    		$detail->time = date('h:i: a');
    		$detail->timestamp = time();
    		$detail->status = 'Pending';
    		$detail->screen_shot = $path; 
    		$detail->save();

    		foreach($carts as $cart){
    			$order = new Order();
    			$order->orderdetail_id = $detail->id;
    			$order->product_id = $cart->product_id;
    			$order->price = discount($cart->product);
    			$order->qty = $cart->cart_qty;
    			$order->unit_total = $cart->unit_total;
    			$order->save();
    		}

    		Session::forget('cart_session_id');
    		

    		$notification=array(
                'messege'=>"Successfully your order has been taken. We Will Contact you soon",
                'alert-type'=>"success",
            );

    		DB::commit();

            return redirect('/')->with($notification);

    	}catch(Exception $e){
    		DB::rollback();
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        } 
    }
}
