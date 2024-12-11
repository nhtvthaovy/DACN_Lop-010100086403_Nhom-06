<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

session_start();

class CartController extends Controller
{
    public function show_cart()
    {
        $cartItems = session('cart');
        
        return view('pages.cart.show_cart', ['cartItems' => $cartItems]);
    }
    
    
    
    
    
    public function add_cart(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        
        if ($cart == true) {
            $is_available = false;
        
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_available = true;
        
                    // Cập nhật số lượng nếu sản phẩm đã có trong giỏ hàng
                    $cart[$key]['product_qty'] += $data['cart_product_qty'];
                    break;
                }
            }
        
            if (!$is_available) {
                // Thêm sản phẩm mới vào giỏ hàng nếu chưa có
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
            }
        } else {
            // Thêm sản phẩm vào giỏ hàng nếu giỏ hàng trống
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        
        Session::put('cart', $cart);
        Session::save();
        
}
public function update_cart(Request $request)
{
    $data = $request->all();
    $cart = Session::get('cart', []);

    $ProductName = ''; 

    if ($cart) {
        foreach ($data['cart_qty'] as $key => $qty) {
            foreach ($cart as $session => $val) {
                if ($val['session_id'] == $key) {
                    $ProductName = $cart[$session]['product_name']; 
                    $cart[$session]['product_qty'] = $qty;
                    break;
                }
            }
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('message', '<span style="color: green;">Cập nhật số lượng thành công cho sản phẩm <span style="color: black;">' . $ProductName . '</span></span>!');
    } else {
        return redirect()->back()->with('message', '<span style="color: red;">Không tìm thấy giỏ hàng</span>!');
    }
}



public function delete_pro_cart($session_id)
{
    $cart = Session::get('cart', []);
    $deletedProductName = '';

    if ($cart) {
        foreach ($cart as $key => $val) {
            if ($val['session_id'] == $session_id) {
                $deletedProductName = $val['product_name'];
                unset($cart[$key]);
                break;
            }
        }

        Session::put('cart', $cart);

        if ($deletedProductName) {
            return redirect()->back()->with('message', '<span style="color: green;">Xóa sản phẩm <span style="color: black;">' . $deletedProductName . '</span> thành công</span>!');
        } else {
            return redirect()->back()->with('message', '<span style="color: red;">Không tìm thấy sản phẩm để xóa</span>!');
        }
    } 
    // else {
    //     return redirect()->back()->with('message', '<span style="color: red;">Không tìm thấy giỏ hàng</span>!');
    // }
}
}