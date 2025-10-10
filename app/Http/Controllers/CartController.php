<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Session;

class CartController extends Controller
{   
    public function carts()
    {    
        $carts = Cart::with('product','productvariant')->where('cart_session_id',Session::get('cart_session_id'))->latest()->get();
        $sum = Cart::where('cart_session_id',Session::get('cart_session_id'))->sum('unit_total');
        return view('fronts.carts', compact('carts','sum'));
    }
    

    public function cartUpdate(Request $request)
    {
        try {

            $sessionId = $request->session_id ?? Session::get('cart_session_id');

            $cartItems = Cart::where('cart_session_id', $sessionId)->get();

            foreach ($cartItems as $cart) {
                $qtyInput = $request->input('cart_qty_' . $cart->id);

                if ($qtyInput && $qtyInput > 0) {
                    // Get product price
                    if ($cart->productvariant_id) {
                        $price = $cart->productvariant->pricevariant_price;
                    } else {
                        $price = discount($cart->product);
                    }

                    $unitTotal = $price * $qtyInput;

                    $cart->cart_qty = $qtyInput;
                    $cart->unit_total = number_format($unitTotal, 2, '.', '');
                    $cart->save(); 
                }
            }

            return redirect()->back()->with([
                'messege' => "Cart updated successfully!",
                'alert-type' => "success"
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


}
