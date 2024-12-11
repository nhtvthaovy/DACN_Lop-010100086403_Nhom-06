<?php


namespace App\Http\Controllers;

use App\Imports\CategoryProductImport;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

session_start();

class CategoryController extends Controller
{   
    public function Authlogin()
    {
        if (!Auth::guard('admin')->check()) {
            return Redirect::to('/login-auth')->with('message', 'Vui lòng đăng nhập!');
        }
    }
    
    public function add_category_product(){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
        
        
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $all_category_product = CategoryModel::all();
        
        return view('admin.all_category_product', compact('all_category_product'));
    }
    
    public function save_category_product(Request $request){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $categoryName = $request->category_product_name;
        

        $existingCategory = CategoryModel::whereRaw('BINARY LOWER(category_name) = ?', [mb_strtolower($categoryName)])->first();
        
        if ($existingCategory) {

            Session::put('message', '<span style="color: red;">Danh mục sản phẩm <span style="color: black;">' . $categoryName . '</span> đã tồn tại.</span> ');
        } else {

            $category = new CategoryModel();
            $category->category_name = $categoryName;
            $category->category_desc = $request->category_product_desc;
            $category->category_status = $request->category_product_status;
            $category->save();
    
            Session::put('message', '<span style="color: green;">Thêm danh mục sản phẩm <span style="color: black;">' . $categoryName . '</span> thành công!</span>');
        }
        
        return Redirect::to('/add-category-product');
    }
    
    public function importCategoryProduct(Request $request)
    {
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
    
        if ($request->hasFile('category_excel_file')) {
            $file = $request->file('category_excel_file');
    
            if ($file->getClientOriginalExtension() == 'xlsx' || $file->getClientOriginalExtension() == 'xls') {
                try {
                    $import = Excel::toArray(new CategoryProductImport, $file);
                    
                    $duplicates = 0;
                    foreach ($import[0] as $key => $row) {
                        if ($key == 0) continue;
    
                        $existingCategory = CategoryModel::whereRaw('BINARY LOWER(category_name) = ?', [mb_strtolower($row[0])])->first();
                        if ($existingCategory) {
                            $duplicates++;
                        }
                    }
    
                    if ($duplicates > 0) {
                        Session::put('message', "Có $duplicates danh mục bị trùng tên và không được nhập.");
                    } else {
                        Session::put('message', 'Import danh mục sản phẩm thành công!');
                    }
    
                    Excel::import(new CategoryProductImport, $file);
    
                } catch (\Exception $e) {
                    Session::put('message', 'Lỗi khi import file Excel: ' . $e->getMessage());
                }
            } else {
                Session::put('message', 'Vui lòng chọn file Excel (.xls, .xlsx)');
            }
        } else {
            Session::put('message', 'Vui lòng chọn file để tải lên!');
        }
    
        return redirect()->to('/add-category-product');
    } 
    
    
    public function active_category_product($category_product_id){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $category_product = CategoryModel::find($category_product_id);
    
        if ($category_product) {
            $category_product->category_status = 1;
            $category_product->save();
    
            Session::put('message', 'Hiện danh mục sản phẩm <span style="color: black;">' . $category_product->category_name . '</span> thành công!');
        }
    
        return Redirect::to('/all-category-product');
    }
    
    public function unactive_category_product($category_product_id){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $category_product = CategoryModel::find($category_product_id);
    
        if ($category_product) {
            $category_product->category_status = 0;
            $category_product->save();
    
            Session::put('message', 'Ẩn danh mục sản phẩm <span style="color: black;">' . $category_product->category_name . '</span> thành công!');
        }
    
        return Redirect::to('/all-category-product');
    }
    
    public function edit_category_product($category_product_id){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $edit_category_product = CategoryModel::findOrFail($category_product_id);
    
        return view('admin.edit_category_product', compact('edit_category_product'));
    }
    
    
    public function update_category_product(Request $request, $category_product_id){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }

        $category_product = CategoryModel::findOrFail($category_product_id);

        $category_product->update([
            'category_name' => $request->category_product_name,
            'category_desc' => $request->category_product_desc,
        ]);
    
        Session::put('message', 'Cập nhật danh mục sản phẩm <span style="color: black;">'.$category_product->category_name.'</span> thành công!');
        return Redirect::to('/all-category-product');
    }
    
    public function delete_category_product($category_product_id)
    {
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
                
        $category_product = CategoryModel::findOrFail($category_product_id);
    
        $category_product->products()->delete();
        
        $category_product->delete();
        
        Session::put('message', 'Xóa danh mục sản phẩm <span style="color: black;">' . $category_product->category_name . '</span> và tất cả sản phẩm trong danh mục thành công!');
        
        return Redirect::to('/all-category-product');
    }
    
    
 
// end function admin page    
public function show_category_shop($category_id){
    $cate_name = DB::table('tbl_category_product')->where('category_id', $category_id)->first();


    $all_cate_product = DB::table('tbl_product')
    ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
    ->where('tbl_product.product_status', '=', 1)
    ->where('tbl_category_product.category_status', '=', 1)
    ->where('tbl_category_product.category_id', '=', $category_id)        
    ->orderBy('tbl_product.product_id', 'asc')
    ->get();
    $all_product = DB::table('tbl_product')
    ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
    ->where('tbl_product.product_status', '=', 1)
    ->where('tbl_category_product.category_status', '=', 1)
    ->orderBy('tbl_product.product_id', 'asc')
    ->get();
    
    return view('pages.category.show_category')->with('all_product',$all_product)->with('cate_name',$cate_name)->with('all_cate_pro',$all_cate_product);
}

}