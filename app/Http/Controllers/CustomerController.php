<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function account()
    {
        $customer_id = session('customer_id');
        
        if (!$customer_id) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để truy cập tài khoản.');
        }
    
        $customer = CustomerModel::find($customer_id);
    
        if (!$customer) {
            return redirect()->route('customer.account')->with('error', 'Không tìm thấy thông tin khách hàng.');
        }
    
        return view('pages.customer.account', compact('customer'));
    }

    public function updateAccount(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'required|email|max:255',
        'customer_phone' => 'required|string|max:15',
    ]);

    $customer_id = session('customer_id');

    if (!$customer_id) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để cập nhật tài khoản.');
    }

    $customer = CustomerModel::find($customer_id);

    if (!$customer) {
        return redirect()->back()->with('error', 'Không tìm thấy thông tin khách hàng.');
    }

    $customer->update($request->only(['customer_name', 'customer_email', 'customer_phone']));

    return redirect()->back()->with('success', 'Thông tin tài khoản đã được cập nhật!');
}

    
}
