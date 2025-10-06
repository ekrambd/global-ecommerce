<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth_check');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::latest();

            return DataTables::of($products)
                ->addIndexColumn()


                ->addColumn('category', function ($row) {

                    return $row->category->category_name;
                })

                ->addColumn('unit', function ($row) {

                    return $row->unit->unit_name;
                })
                
                ->addColumn('status', function ($row) {
                    $checked = $row->status === 'Active' ? 'checked' : '';
                    $class   = $row->status === 'Active' ? 'active-product' : 'decline-product';

                    return '
                        <label class="switch">
                            <input 
                                type="checkbox" 
                                class="' . $class . '" 
                                id="status-product-update" 
                                data-id="' . $row->id . '" 
                                ' . $checked . '
                            >
                            <span class="slider round"></span>
                        </label>
                    ';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('products.show', $row->id);

                    return '
                        <a href="' . $editUrl . '" 
                           class="btn btn-primary btn-sm action-button edit-product" 
                           data-id="' . $row->id . '">
                            <i class="fa fa-edit"></i>
                        </a>
                        &nbsp;
                        <button type="button" 
                           class="btn btn-danger btn-sm delete-product action-button" 
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })

                ->rawColumns(['status', 'action','category','unit'])
                ->make(true);
        }

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try
        {   
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/products/', $name);
                $path = 'uploads/products/' . $name;
            }
            Product::create([
                'user_id' => user()->id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'brand_id' => $request->brand_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'discount' => $request->discount,
                'status' => $request->status,
                'image' => $path,
                'description' => $request->description,
                'stock_qty' => $request->stock_qty,
            ]);

            $notification=array(
                'messege'=>"Successfully a product has been added",
                'alert-type'=>"success",
            );

            return redirect()->back()->with($notification);

        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {  
        $subcategories = Subcategory::where('category_id',$product->category_id)->latest()->get();
        return view('products.edit', compact('product','subcategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try
        {   
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/products/', $name);
                unlink(public_path($product->image));
                $path = 'uploads/products/' . $name;
            }else{
                $path = $product->image;
            }

            $product->unit_id = $request->unit_id;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand_id = $request->brand_id;
            $product->product_name = $request->product_name;
            $product->discount = $request->discount;
            $product->status = $request->status;
            $product->image = $path;
            $product->description = $request->description;
            $product->stock_qty = $request->stock_qty;
            $product->update();

            $notification=array(
                'messege'=>"Successfully the product has been updated",
                'alert-type'=>"success",
            );

            return redirect('/products')->with($notification);

        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try
        {
            unlink(public_path($product->image));
            $product->delete();
            return response()->json(['status'=>true, 'message'=>"Successfully the product has been deleted"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
}
