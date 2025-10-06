<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Variant;
use App\Models\Product;

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
}
