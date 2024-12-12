<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApiController extends Controller

{

    // public function Authlogin()
    // {
    //     if (!Auth::guard('admin')->check()) {
    //         return Redirect::to('/login-auth')->with('message', 'Vui lòng đăng nhập!');
    //     }
    // }

    public function saveCategoryProduct(Request $request)
    {
        try {
            $request->validate([
                'category_product_name' => 'required|string|max:255',
                'category_product_desc' => 'nullable|string',
                'category_product_status' => 'required|boolean',
            ]);
            
            $existingCategory = CategoryModel::where('category_name', $request->category_product_name)->first();
            if ($existingCategory) {
                return response()->json(['message' => 'Danh mục với tên này đã tồn tại!'], 400);
            }
    
            $category = new CategoryModel();
            $category->category_name = $request->category_product_name;
            $category->category_desc = $request->category_product_desc;
            $category->category_status = $request->category_product_status;
            $category->save();
    
            return response()->json(['message' => 'Danh mục sản phẩm đã được thêm thành công!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Đã xảy ra lỗi khi thêm danh mục.', 'error' => $e->getMessage()], 500);
        }
    }
    


    public function updateCategoryProduct(Request $request, $id)
    {
    try {
        $request->validate([
            'category_product_name' => 'required|string|max:255',
            'category_product_desc' => 'nullable|string',
            'category_product_status' => 'required|boolean',
        ]);

        $existingCategory = CategoryModel::where('category_name', $request->category_product_name)
                                          ->where('category_id', '!=', $id)
                                          ->first();

        if ($existingCategory) {
            return response()->json(['message' => 'Tên danh mục đã tồn tại!'], 400);
        }

        $category = CategoryModel::find($id);
        if (!$category) {
            return response()->json(['message' => 'Danh mục không tồn tại!'], 404);
        }

        $category->category_name = $request->category_product_name;
        $category->category_desc = $request->category_product_desc;
        $category->category_status = $request->category_product_status;
        $category->save();

        return response()->json(['message' => 'Cập nhật danh mục sản phẩm thành công!'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Có lỗi xảy ra!', 'error' => $e->getMessage()], 500);
    }
    }



    public function delete_category_product($category_product_id)
    {
        $category_product = CategoryModel::find($category_product_id);
    
        if ($category_product) {
            $category_product->delete();
            return response()->json(['message' => 'Danh mục sản phẩm đã được xóa thành công!']);
        }
    
        return response()->json(['message' => 'Danh mục sản phẩm không tồn tại!'], 404);
    }



    public function deleteProduct(Request $request)
    {
        $product_id = $request->input('product_id'); 

        $product = ProductModel::find($product_id);

        if ($product) {
            $product->delete();

            return response()->json([
                'message' => 'Sản phẩm đã được xóa thành công!'
            ], 200);
        }

        return response()->json([
            'message' => 'Sản phẩm không tồn tại!'
        ], 404);
    }
    
    public function shop(Request $request)
    {
        $categories = CategoryModel::where('category_status', 1)
            ->whereHas('products', function ($query) {
                $query->where('product_status', 1); 
            })
            ->get();
    
        $products = ProductModel::with('category')
            ->where('product_status', 1)
            ->whereHas('category', function ($query) {
                $query->where('category_status', 1); 
            })
            ->paginate(9);
    
        return response()->json([
            'products' => $products,
            'categories' => $categories
        ]);
    }
    

    
    
    public function getCategories(Request $request)
    {
        $categories = CategoryModel::paginate(10);

        return response()->json($categories);
    }















    // customer

    public function getCustomerOrders($customerId)
    {
        $orders = OrderModel::where('customer_id', $customerId)->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }



    public function DetailsOrders($orderId)
    {
        $order = OrderModel::with(['orderDetails', 'customer', 'shipping', 'payment'])
            ->find($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng không tồn tại.'
            ]);
        }

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }
    
}

