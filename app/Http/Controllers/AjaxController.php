<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Variant;
use App\Models\Product;
use App\Models\Productvariant;
use App\Models\Cart;
use Session;
session_start();

class AjaxController extends Controller
{
    public function categoryStatusUpdate(Request $request)
    {
    	try
    	{
    		$category = Category::findorfail($request->category_id);
    		$category->status = $request->status;
    		$category->update();
    		return response()->json(['status'=>true, 'message'=>"Successfully the category's status has been updated"]);
    	}catch(Exception $e){
    		return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
    	}
    }

    public function subCategoryStatusUpdate(Request $request)
    {
        try
        {
            $subcategory = Subcategory::findorfail($request->subcategory_id);
            $subcategory->status = $request->status;
            $subcategory->update();
            return response()->json(['status'=>true, 'message'=>"Successfully the subcategory's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function brandStatusUpdate(Request $request)
    {
        try
        {
            $brand = Brand::findorfail($request->brand_id);
            $brand->status = $request->status;
            $brand->update();
            return response()->json(['status'=>true, 'message'=>"Successfully the brand's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function unitStatusUpdate(Request $request)
    {
        try
        {
            $unit = Unit::findorfail($request->unit_id);
            $unit->status = $request->status;
            $unit->update();
            return response()->json(['status'=>true, 'message'=>"Successfully the unit's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function variantStatusUpdate(Request $request)
    {
        try
        {
            $variant = Variant::findorfail($request->variant_id);
            $variant->status = $request->status;
            $variant->update();
             return response()->json(['status'=>true, 'message'=>"Successfully the variant's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function productStatusUpdate(Request $request)
    {
        try
        {
            $product = Product::findorfail($request->product_id);
            $product->status = $request->status;
            $product->update();
             return response()->json(['status'=>true, 'message'=>"Successfully the product's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function getSubcategories($id)
    {
        try
        {
            $category = Category::findorfail($id);
            $subcategories = $category->subcategories;
            return response()->json(['status'=>count($subcategories) > 0, 'data'=>$subcategories]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function addProductVariant($id)
    {  
        $product = Product::findorfail($id);
        $variants = Variant::with(['productvariants' => function ($query) use ($id) {
            $query->where('product_id', $id);
        }])->get();
        //return $variants;
        return view('products.add_variant', compact('product','variants'));
    }


    public function saveProductVariant(Request $request)
    {
        try {
            $product_id = $request->product_id;
            $variant_values = $request->variant_values ?? [];
            $variant_prices = $request->variant_prices ?? [];
            $stock_qtys = $request->stock_qtys ?? [];
            $images = $request->file('images') ?? [];
            $productvariant_ids = $request->productvariant_ids ?? [];

            foreach ($variant_values as $variant_id => $values) {
                foreach ($values as $index => $value) {
 
                    if (empty($value)) continue;

                    $pv_id = $productvariant_ids[$variant_id][$index] ?? null;

                    $data = [
                        'product_id'    => $product_id,
                        'variant_id'    => $variant_id,
                        'variant_value' => $value,
                        'variant_price' => $variant_prices[$variant_id][$index] ?? null,
                        'stock_qty'     => $stock_qtys[$variant_id][$index] ?? 0,
                    ];

                    if (isset($images[$variant_id][$index]) && $images[$variant_id][$index]->isValid()) {
                        $file = $images[$variant_id][$index];
                        $imageName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/variants'), $imageName);
                        $data['image'] = 'uploads/variants/' . $imageName;
                    }

                    if ($pv_id && $existing = ProductVariant::find($pv_id)) {
                        $existing->update($data);
                    } else {
                        ProductVariant::create($data);
                    }
                }
            }

            $notification=array(
                'messege'=>"Successfully variant added/updated",
                'alert-type'=>"success",
            );

            return redirect()->back()->with($notification);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteVariant($id)
    {
        try
        {
            $variant = Productvariant::findorfail($id);
            if($variant->image != NULL){
                unlink(public_path($variant->image));
            }
            $variant->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the variant has been deleted']);
        }catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function addToCart(Request $request)
    {
        try
        {
            $product = Product::find($request->element_id);
            $variant = Productvariant::find($request->element_id);
            $count = Cart::count();
            $count+=1;
            $cart_session_id = Session::get('cart_session_id');

            if(!stockCheck($request)){
                return response()->json(['status'=>false, 'message'=>'The product is sold out']);
            }

            if(empty($cart_session_id)){
                $cart_session_id = Session::put('cart_session_id',rand(1000,9000).$count);
            }

            if($product){

                $price = discount($product);

            }else{
                $price = $variant->variant_price == null?$product->product_price:$variant->variant_price;
            }

            $cart = Cart::where('product_id',$product->id)->where('cart_session_id',$cart_session_id)->first();


            if($cart){
                $qty = $cart->cart_qty+1;
                $cart->cart_qty=$qty;
                $cart->unit_total = round($price * $qty,2);
                $cart->update();
            }else{
                
                $cart = new Cart();
                $cart->product_id = $request->use_for=='product'?$product->id:null;
                $cart->cart_session_id = $cart_session_id;
                $cart->variant_id = $request->use_for=='variant'?$variant->id:null;
                $cart->cart_qty = 1;
                $cart->unit_total = round($price * 1,2);
                $cart->save();
            }

            return response()->json(['status'=>true, 'message'=>'Successfully the product has been added to cart']);

        }catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }


}
