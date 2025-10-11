<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use App\Models\Whishlist;
use App\Models\Category;
use App\Models\Brand;
use Blade;
use Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use View;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $countCart = Cart::where('cart_session_id', Session::get('cart_session_id'))->count();
            $view->with('countCart', $countCart);
        });

        View::composer('*', function ($view) {
            $query = Whishlist::query();

            if (Auth::check()) {
                $query->where('user_id', Auth::id());
            }

            $countWhishlist = $query->count();

            $view->with('countWhishlist', $countWhishlist);
        });

        View::composer('*', function ($view) {
            $menuCategories = Category::whereHas('products')
			    ->with(['subcategories' => function ($query) {
		
			        $query->whereHas('products')
			        ->where('is_mega_menu', 1)
			        ->where('status','Active')
			        ->with(['products' => function ($q) {
			            $q->where('status', 'Active');
			        }]);
			    }])
			    ->where('status', 'Active')
			    ->latest()
			    ->get();
            $view->with('menuCategories', $menuCategories);
        });


        View::composer('*', function ($view) {
            $menuBrands = Brand::whereHas('products')->with(['products'=>function($query){
                $query->where('status','Active');
            }])->where('status','Active')->where('is_mega_menu',1)->latest()->get();
            $view->with('menuBrands', $menuBrands);
        });
        

        View::composer('*', function ($view) {
            $topCategories = Category::where('is_top',1)->where('status','Active')->latest()->get();
            $view->with('topCategories', $topCategories);
        });

        View::composer('*', function ($view) {
            $featuredCategories = Category::whereHas('products')
	                   ->with(['products'=>function($query){
	                   	    $query->where('status','Active');
	                   }])
	                   ->where('status','Active')
	                   ->where('is_featured',1)
	                   ->get();
            $view->with('featuredCategories', $featuredCategories);
        });


        View::composer('*', function ($view) {
            $homeCategories = Category::whereHas('products')
	                   ->with(['products'=>function($query){
	                   	    $query->where('status','Active');
	                   }])
	                   ->where('status','Active')
	                   ->where('is_featured',1)
	                   ->get();
            $view->with('homeCategories', $homeCategories);
        });
    
        

        Blade::directive('toastr', function ($expression){
            return "<script>
                    toastr.{{ Session::get('alert-type') }}($expression)
                 </script>";
        });
    }
}
