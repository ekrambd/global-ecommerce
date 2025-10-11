@extends('front_master')
@section('front_content')
<!-- Start of Main -->
        <main class="main wishlist-page">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Products</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Products</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                  <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                  @foreach($products as $product)
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-default.html">
                                    <img src="{{URL::to($product->image)}}" alt="Product"
                                        width="300" height="338" />
                                    <img src="{{URL::to($product->image)}}" alt="Product"
                                        width="300" height="338" />
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart add-to-cart"
                                        title="Add to cart" data-id="{{$product->id}}"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart add-wishlist"
                                        title="Add to wishlist" data-id="{{$product->id}}"></a>
                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search d-none"
                                        title="Quickview"></a>
                                    <a href="#" class="btn-product-icon btn-compare w-icon-compare d-none"
                                        title="Add to Compare"></a>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="{{URL::to('/product-details/'.$product->id)}}">{{$product->product_name}}</a></h4>
                                <div class="ratings-container d-none">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 60%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-default.html" class="rating-reviews d-none">(1 Reviews)</a>
                                </div>
                                <div class="product-price">
                                  @if($product->discount > 0)
                                    <ins class="new-price">{{discount($product)}} BDT</ins><del
                                        class="old-price">{{$product->product_price}}BDT</del>
                                  @else
                                    <ins class="new-price">{{$product->product_price}} BDT</ins>
                                  @endif
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach
                  </div>
                  <div style="margin-top: 5px; margin-bottom: 5px;">{{$products->links()}}</div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
@endsection

@push('scripts') 
 <script>
   
 </script>
@endpush