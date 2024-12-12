<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\OrderDetailsModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{


    public function Authlogin()
    {
        if (!Auth::guard('admin')->check()) {
            return Redirect::to('/login-auth')->with('message', 'Vui lòng đăng nhập!');
        }
    }

    public function index(){

        
        return view('admin.auth.admin_login_auth');
    }

    public function register_auth(){
        
        return view('admin.auth.admin_register_auth');
    }
    

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/admin')->with('message', 'Đã đăng xuất thành công!');
    }

    public function register(Request $request)
    {

        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:tbl_admin,admin_email',
            'admin_phone' => 'required|string|max:15',
            'admin_password' => 'required|string|min:6|confirmed',
            'agree_terms' => 'accepted',
        ]);

        $admin = new AdminModel();
        $admin->admin_name = $request->admin_name;
        $admin->admin_email = $request->admin_email;
        $admin->admin_phone = $request->admin_phone;
        $admin->admin_password = Hash::make($request->admin_password);
        $admin->save();

        $role = RoleModel::where('name', 'user')->first(); // Gán vai trò mặc định là 'user'
        
        if ($role) {
            $admin->roles()->attach($role->role_id); // Gán vai trò vào bảng tbl_admin_roles
        }

        return back()->with('message', 'Đăng ký thành công!'); 
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email|exists:tbl_admin,admin_email',
            'admin_password' => 'required|string|min:6',
        ]);

        $admin = AdminModel::where('admin_email', $request->input('admin_email'))->first();

        if ($admin && Hash::check($request->input('admin_password'), $admin->getAuthPassword())) {
            Auth::guard('admin')->login($admin);
        return Redirect::to('/dashboard')->with('message', 'Đăng nhập thành công!');
    }

    return back()->withErrors([
        'admin_password' => 'Thông tin đăng nhập không chính xác.',
    ]);
    }



    // manage

        public function manage(Request $request)
        {
            // Kiểm tra người dùng chọn nhóm theo ngày, tháng hay năm
            $groupBy = $request->input('group_by', 'day'); // Mặc định là theo ngày
    
            // Truy vấn dữ liệu theo ngày, tháng, hoặc năm
            if ($groupBy == 'month') {
                // Nhóm theo tháng-năm (yyyy-mm)
                $salesData = OrderDetailsModel::join('tbl_order', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
                    ->where('tbl_order.order_status', 'completed') // Chỉ tính đơn hàng đã hoàn thành
                    ->selectRaw('SUM(tbl_order_details.product_sales_qty * tbl_order_details.product_price) as total_sales, DATE_FORMAT(tbl_order.created_at, "%Y-%m") as period')
                    ->groupBy(DB::raw('DATE_FORMAT(tbl_order.created_at, "%Y-%m")')) // Nhóm theo tháng-năm
                    ->orderBy('period')
                    ->get();
            } elseif ($groupBy == 'year') {
                // Nhóm theo năm
                $salesData = OrderDetailsModel::join('tbl_order', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
                    ->where('tbl_order.order_status', 'completed')
                    ->selectRaw('SUM(tbl_order_details.product_sales_qty * tbl_order_details.product_price) as total_sales, YEAR(tbl_order.created_at) as period')
                    ->groupBy(DB::raw('YEAR(tbl_order.created_at)')) // Nhóm theo năm
                    ->orderBy('period')
                    ->get();
            } else {
                // Nhóm theo ngày (ngày-tháng-năm)
                $salesData = OrderDetailsModel::join('tbl_order', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
                    ->where('tbl_order.order_status', 'completed')
                    ->selectRaw('SUM(tbl_order_details.product_sales_qty * tbl_order_details.product_price) as total_sales, DATE(tbl_order.created_at) as period')
                    ->groupBy(DB::raw('DATE(tbl_order.created_at)')) // Nhóm theo ngày
                    ->orderBy('period')
                    ->get();
            }

            
    

    // Thêm thống kê sản phẩm bán được
    $productSalesData = OrderDetailsModel::join('tbl_order', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
        ->where('tbl_order.order_status', 'completed')
        ->selectRaw('product_name, SUM(product_sales_qty) as total_sales')
        ->groupBy('product_name')
        ->orderByDesc('total_sales')
        ->get();

    // Truyền dữ liệu vào view
    return view('admin.manage', compact('salesData', 'groupBy', 'productSalesData'));
        }



    // user


    public function add_user()
    {

        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }

        $roles = RoleModel::all();  
        return view('admin.auth.add_user', compact('roles'));
    }


    public function create_user(Request $request)
    {
        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }
        
    $request->validate([
        'admin_name' => 'required|string|max:255',
        'admin_email' => 'required|email|unique:tbl_admin,admin_email',
        'admin_phone' => 'nullable|string|max:15',  
        'admin_password' => 'required|string|min:6',
        'role_id' => 'required|exists:tbl_roles,role_id',
    ]);

    $admin = new AdminModel();
    $admin->admin_name = $request->input('admin_name');
    $admin->admin_email = $request->input('admin_email');
    $admin->admin_phone = $request->input('admin_phone');
    $admin->admin_password = bcrypt($request->input('admin_password')); 
    $admin->save();

    $admin->roles()->attach($request->input('role_id'));

    return redirect()->back()->with('message', 'Người dùng đã được tạo thành công!');
    }


    public function all_user()
    {

        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }

        $users = AdminModel::with('roles')->get(); 

        $allRoles = RoleModel::all();

        return view('admin.auth.all_user', compact('users', 'allRoles'));
    }


    public function update_role(Request $request, $user_id)
    {

        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }

        $roleId = $request->input('role_id');
        
        $user = AdminModel::find($user_id);
    
        if ($user) {
            $user->roles()->detach();
    
            $user->roles()->attach($roleId);
    
            return redirect()->back()->with('message', 'Cập nhật vai trò thành công');
        } else {
            return redirect()->back()->with('message', 'Không tìm thấy người dùng');
        }
    }
    
    
    
    public function delete_user($user_id)
    {

        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }

        $user = AdminModel::find($user_id);
        
        if (!$user) {
            return redirect()->back()->with('message', 'Người dùng không tồn tại.');
        }
        
        $user->delete();
        
        return redirect()->back()->with('message', 'Xóa người dùng thành công!');
    }


    public function edit_user($admin_id)
    {

        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }

        $user = AdminModel::where('admin_id', $admin_id)->firstOrFail();
        return view('admin.auth.edit_user', compact('user'));
    }
    
    
    
    public function update_user(Request $request, $id)
    {

        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }

        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:tbl_admin,admin_email,' . $id . ',admin_id', 
            'admin_phone' => 'nullable|string|max:15',
            'admin_password' => 'nullable|string|min:6', 
        ]);
    
        $user = AdminModel::findOrFail($id);
    
        $user->admin_name = $request->input('admin_name');
        $user->admin_email = $request->input('admin_email');
        $user->admin_phone = $request->input('admin_phone');
    
        if ($request->filled('admin_password')) {
            $user->admin_password = bcrypt($request->input('admin_password')); // Mã hóa mật khẩu mới
        }
    
        $user->save();
    
    
        return Redirect::to('/all-user')->with('message', 'Sửa Thành Công');
    }
    

}