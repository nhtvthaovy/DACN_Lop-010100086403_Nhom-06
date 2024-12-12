<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    public function index() {
       
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_product.product_status', '=', 1)
            ->where('tbl_category_product.category_status', '=', 1)
            ->orderBy('tbl_product.product_id', 'asc')
            ->get();
    
        
        $categories = $all_product->pluck('category_name')->unique()->take(5);
    
        return view('pages.home')
            ->with('all_product', $all_product)
            ->with('categories', $categories);
    }
    
    
    
    public function shop() {
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_product.product_status', '=', 1)
            ->where('tbl_category_product.category_status', '=', 1)
            ->orderBy('tbl_product.product_id', 'asc')
            ->paginate(9);  

            $all_product2 = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_product.product_status', '=', 1)
            ->where('tbl_category_product.category_status', '=', 1)
            ->orderBy('tbl_product.product_id', 'asc')
            ->get();

            return view('pages.shop')
                ->with('all_product', $all_product)
                ->with('all_product2', $all_product2);
    }
    

    public function search(Request $request){

        $keys = $request->key_submit;
    
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_product.product_status', '=', 1)
            ->where('tbl_category_product.category_status', '=', 1)
            ->orderBy('tbl_product.product_id', 'asc')
            ->get();
    
        $search_all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_product.product_status', '=', 1)
            ->where('tbl_category_product.category_status', '=', 1)
            ->where('tbl_product.product_name', 'like', '%'.$keys.'%')
            ->orderBy('tbl_product.product_id', 'asc')
            ->get();  
            
        return view('pages.product.search')
            ->with('search_all_product', $search_all_product)
            ->with('all_product', $all_product)
            ->with('keys', $keys);
    }




    public function wishlist() {
       
   
    
        return view('pages.wishlist');

    }
    
    
   
}
