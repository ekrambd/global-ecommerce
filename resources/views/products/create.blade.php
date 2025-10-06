@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/products')}}">All Product
                                </a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_name">Product Name <span class="required">*</span></label>
                                <input type="text" name="product_name" class="form-control" id="product_name"
                                    placeholder="Product Name" required="" value="{{old('product_name')}}">
                                @error('product_name')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_price">Product Price (BDT) <span class="required">*</span></label>
                                <input type="text" name="product_price" class="form-control" id="product_price"
                                    placeholder="Product Price" required="" value="{{old('product_price')}}">
                                @error('product_price')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="text" name="discount" class="form-control" id="discount"
                                    placeholder="Discount (%)" value="{{old('discount')}}">
                                @error('discount')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id">Select Category <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="category_id" id="category_id" required="">
                                    <option value="" selected="" disabled="">Select Category</option>
                                    @foreach(categories() as $category)
                                      <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subcategory_id">Select Subcategory</label>
                                <select class="form-control select2bs4" name="subcategory_id" id="subcategory_id">
                                	<option value="" selected="" disabled="">Select SubCategory</option>
                                    {{-- content --}}
                                </select>
                                @error('subcategory_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="brand_id">Select Brand</label>
                                <select class="form-control select2bs4" name="brand_id" id="brand_id">
                                    <option value="" selected="" disabled="">Select Brand</option>
                                    @foreach(brands() as $brand)
                                      <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unit_id">Select Unit <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="unit_id" id="unit_id" required="">
                                    <option value="" selected="" disabled="">Select Unit</option>
                                    @foreach(units() as $unit)
                                      <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stock_qty">Stock Quantity <span class="required">*</span></label>
                                <input type="text" name="stock_qty" class="form-control" id="stock_qty"
                                    placeholder="Stock Quantity" required="" value="{{old('stock_qty')}}">
                                @error('stock_qty')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Select Status <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="status" id="status" required="">
                                    <option value="" selected="" disabled="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                @error('status')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="image">Image <span class="required">*</span></label>
                            <input name="image" type="file" id="image" accept="image/*" class="dropify" data-height="200" required=""/>
                            @error('image')
                            <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea class="description" name="description">{!!old('description')!!}</textarea>
                            @error('description')
                            <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>

                        
                        <div class="form-group w-100 px-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
@push('scripts')
 <script>
 	$(document).ready(function(){
 		$(document).on('change', '#category_id', function(){
 			let category_id = $(this).val();
 			$.ajax({

               url: "{{url('/get-subcategories')}}/"+category_id,

                type:"GET",
                dataType:"json",
                success:function(res) {
                	$('#subcategory_id').html('<option value="" selected="" disabled="">Select SubCategory</option>');

                	if(res.status == true){
                		$(res.data).each(function(idx,val){
                			let html = `<option value="${val.id}">${val.subcategory_name}</option>`;
                			$('#subcategory_id').append(html);
                		});
                	}
                },
                            
            }); 
 		});
 	});
 </script>
@endpush