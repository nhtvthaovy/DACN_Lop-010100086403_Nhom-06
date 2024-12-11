<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ReviewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


session_start();

class ProductController extends Controller
{
    public function Authlogin()
    {
        if (!Auth::guard('admin')->check()) {
            return Redirect::to('/login-auth')->with('message', 'Vui lòng đăng nhập!');
        }
    }  
    public function add_product(){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $cate_product = CategoryModel::orderBy('category_id', 'asc')->get();
    
        return view('admin.add_product')->with('cate_product', $cate_product);
    }
    

    public function all_product()
    {
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $all_product = ProductModel::with('category')
            ->orderBy('product_id', 'asc')
            ->get();

            // dd($all_product);
    
        return view('admin.all_product', [
            'all_product' => $all_product
        ]);
    }
    
    public function import_product()
    {
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
    
        $imagePath = public_path('uploads/product');
        
        $images = File::files($imagePath);
        
        return view('admin.import_product', compact('images'));
    }
    
    
    public function save_product(Request $request){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $productName = $request->product_name;
    
        $existingProduct = ProductModel::whereRaw('BINARY LOWER(product_name) = ?', [mb_strtolower($productName)])->first();
    
        if ($existingProduct) {
            Session::put('message', '<span style="color: red;">Sản phẩm <span style="color: black;">' . $productName . '</span> đã tồn tại.</span>');
        } else {

            $data = new ProductModel();
            $data->product_name = $productName;
            $data->category_id = $request->product_cate;
            $data->product_desc = $request->product_desc;
            $data->product_content = $request->product_content;
            $data->product_price = $request->product_price;
            $data->product_quantity = $request->product_quantity;
    
            $slug = Str::slug($data->product_name);

            $timestamp = Carbon::now()->format('Ymd_His');
            $data->product_image = $slug . '_' . $timestamp . '.' . $request->file('product_image')->getClientOriginalExtension();
            
            $request->file('product_image')->move('uploads/product', $data->product_image);
            
            $data->product_status = $request->product_status;
            $data->save();

            Session::put('message', '<span style="color: green;">Thêm sản phẩm <span style="color: black;">'.$productName.'</span> thành công!</span>');
        }
    
        return Redirect::to('/add-product');
    }
    

    public function add_img(Request $request)
    {
        if ($request->hasFile('product_image')) {
            $slug = Str::slug($request->input('product_name'));

            $timestamp = Carbon::now()->format('Ymd_His'); 
            $imageName = $slug . '_' . $timestamp . '.' . $request->file('product_image')->getClientOriginalExtension();

            $request->file('product_image')->move(public_path('uploads/product'), $imageName);

            Session::flash('message', 'Sản phẩm đã được thêm thành công!');
        } else {
            Session::flash('message', 'Vui lòng chọn ảnh sản phẩm!');
        }

        return redirect()->back();
    }

        // Phương thức xóa ảnh
        public function deleteImage($image)
        {
            $imagePath = public_path('uploads/product/' . $image);
    
            // Kiểm tra xem ảnh có tồn tại không
            if (File::exists($imagePath)) {
                // Xóa ảnh
                File::delete($imagePath);
    
                // Cập nhật session thông báo
                Session::flash('message', 'Xóa ảnh thành công!');
            } else {
                Session::flash('message', 'Ảnh không tồn tại!');
            }
    
            // Chuyển hướng lại trang danh sách ảnh
            return redirect()->back();
        }

    public function importProduct(Request $request)
    {
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
    
        if ($request->hasFile('product_excel')) {
            $file = $request->file('product_excel');
            
            try {
                $import = Excel::toArray(new ProductImport, $file);
                
                if (empty($import) || !isset($import[0]) || empty($import[0])) {
                    Session::put('message', 'File Excel không có dữ liệu hợp lệ.');
                    return redirect()->back();
                }
    
                $duplicates = 0;
                foreach ($import[0] as $key => $row) {
                    if ($key == 0) continue;
    
                    $existingProduct = ProductModel::whereRaw('BINARY LOWER(product_name) = ?', [mb_strtolower($row[0])])->first();
                    if ($existingProduct) {
                        $duplicates++;
                    }
                }
                if ($duplicates > 0) {
                    Session::put('message', "Có $duplicates sản phẩm bị trùng tên và không được nhập.");
                } else {
                    Session::put('message', 'Import sản phẩm thành công!');
                }
    
                Excel::import(new ProductImport, $file);
    
            } catch (\Exception $e) {
                Session::put('message', 'Lỗi khi import file Excel' );

                // Session::put('message', 'Lỗi khi import file Excel: ' . $e->getMessage());
            }
        } else {
            Session::put('message', 'Vui lòng chọn file để tải lên!');
        }
    
        // Quay lại trang sau khi import
        return redirect()->back();
    }
    
    
    
    public function active_product($product_id){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $product = ProductModel::find($product_id);
    
        if ($product) {
            $product->product_status = 1;
            $product->save();
    
            Session::put('message', 'Hiện sản phẩm <span style="color: black;">' . $product->product_name . '</span> thành công!');
        } else {
            Session::put('message', 'Sản phẩm không tồn tại!');
        }
    
        return Redirect::to('/all-product');
    }
    
    public function unactive_product($product_id){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $product = ProductModel::find($product_id);
    
        if ($product) {
            $product->product_status = 0;
            $product->save();
    
            Session::put('message', 'Ẩn sản phẩm <span style="color: black;">' . $product->product_name . '</span> thành công!');
        } else {
            Session::put('message', 'Sản phẩm không tồn tại!');
        }
    
        return Redirect::to('/all-product');
    }
    public function edit_product($product_id)
    {
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $cate_product = CategoryModel::all();
        $edit_product = ProductModel::find($product_id);
    
        if ($edit_product) {
            return view('admin.edit_product', compact('edit_product', 'cate_product'));
        }

        return Redirect::to('/all-product')->with('error', 'Sản phẩm không tồn tại');
    }
    


    public function update_product(Request $request, $product_id)
    {
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
    
        $product = ProductModel::find($product_id);
    
        if ($product) {
            $productName = $request->product_name;
            
            $existingProduct = ProductModel::whereRaw('BINARY LOWER(product_name) = ?', [mb_strtolower($productName)])
                                          ->where('product_id', '!=', $product_id) // Loại trừ sản phẩm hiện tại
                                          ->first();
            
            if ($existingProduct) {
                Session::put('message', '<span style="color: red;">Sản phẩm <span style="color: black;">' . $productName . '</span> đã tồn tại.</span>');
                return Redirect::to('/all-product');
            } else {
                $data = [
                    'product_name' => $productName,
                    'category_id' => $request->product_cate,
                    'product_desc' => $request->product_desc,
                    'product_content' => $request->product_content,
                    'product_price' => $request->product_price,
                    'product_quantity' => $request->product_quantity,
                ];
                if ($request->hasFile('product_image')) {
                    $slug = Str::slug($data['product_name']);
                    $timestamp = Carbon::now()->format('Ymd_His');
                    $newImageName = $slug . '_' . $timestamp . '.' . $request->file('product_image')->getClientOriginalExtension();
    
                    $request->file('product_image')->move('uploads/product', $newImageName);
                    $data['product_image'] = $newImageName;
    
                    if (file_exists('uploads/product/' . $product->product_image)) {
                        unlink('uploads/product/' . $product->product_image);
                    }
                }
    
                // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
                $product->update($data);
    
                // Thông báo thành công
                Session::put('message', 'Cập nhật sản phẩm <span style="color: black;">' . $product->product_name . '</span> thành công!');
                return Redirect::to('/all-product');
            }
        }
    
        // Trả về nếu không tìm thấy sản phẩm
        return Redirect::to('/all-product');
    }
    
    
    

    public function delete_product($product_id)
    {
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
        
        $product = ProductModel::find($product_id);

        if ($product) {
            $product->delete();
            Session::put('message', 'Xóa sản phẩm <span style="color: black;">' . $product->product_name . '</span> thành công!');
        } else {
            Session::put('message', 'Không tìm thấy sản phẩm!');
        }

        return Redirect::to('/all-product');
    }


    /// end
    
    public function details_product_shop($product_id)
    {
        // Lấy danh mục sản phẩm
        $cate_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->orderBy('tbl_product.product_id', 'asc')
            ->get(); 
    
        // Lấy thông tin sản phẩm
        $product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_product.product_id', $product_id)
            ->get();
    
        // Lấy tất cả đánh giá cho sản phẩm bằng Eloquent
        $reviews = ReviewModel::where('product_id', $product_id)
            ->where('review_status', 1) // Chỉ tính những đánh giá đã được duyệt
            ->with('customer', 'replies') // Lấy thông tin customer và replies liên quan
            ->get();
    
        // Tính tổng số sao và số lượng đánh giá
        $total_reviews = $reviews->count();
        $total_rating = $reviews->sum('rating');
        $average_rating = $total_reviews > 0 ? $total_rating / $total_reviews : 0;
    
        // Lấy các sản phẩm liên quan
        $related_products = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('tbl_product.category_id', '=', $product[0]->category_id) 
            ->where('tbl_product.product_id', '!=', $product_id)
            ->get();      
    
        return view('pages.product.show_details')
            ->with('cate_pro', $cate_product)
            ->with('product', $product)
            ->with('related_products', $related_products)
            ->with('average_rating', $average_rating)
            ->with('total_reviews', $total_reviews)
            ->with('reviews', $reviews);  // Gửi danh sách các đánh giá và phản hồi đến view
    }
    
    
    
}
