<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();


class AdminController extends Controller
{
    public function Authlogin()
    {
        if (!Auth::guard('admin')->check()) {
            return Redirect::to('/login-auth')->with('message', 'Vui lòng đăng nhập!');
        }
    }

    public function show_dashboard()
    {
        $check = $this->Authlogin();
        if ($check) {
            return Redirect::to('/admin'); 
        }

        return view('admin.dashboard');
    }
    // public function dashboard(Request $request){
    //     $admin_email = $request->admin_email;
    //     $admin_password = md5($request->admin_password);

    //     $result = DB::table('tbl_admin')-> where('admin_email',$admin_email)-> where('admin_password',$admin_password)-> first();
          
    //    if($result){
    //     Session::put('admin_name',$result->admin_name);
    //     Session::put('admin_id',$result->admin_id);
    //     return Redirect::to('/dashboard');
    //    }else 
    //    { 
    //     Session::put('message','Đăng nhập không thành công!');
    //     return Redirect::to('/admin');
    //     }
    // }



    // public function logout(){
    //     $this->Authlogin();
    //     Session::put('admin_name',null);
    //     Session::put('admin_id',null);
    //     return Redirect::to('/admin');

    // }





}