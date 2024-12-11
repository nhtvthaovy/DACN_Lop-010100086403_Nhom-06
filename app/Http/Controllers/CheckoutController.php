<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


session_start();

class CheckoutController extends Controller
{
    public function Authlogin()
    {
        if (!Auth::guard('admin')->check()) {
            return Redirect::to('/login-auth')->with('message', 'Vui lòng đăng nhập!');
        }
    } 
    public function login_checkout(){
        return view('pages.checkout.login_checkout');
    }

    public function sign_customer(){
        return view('pages.checkout.sign_customer');
    }
    public function add_customer(Request $request){

        $existingEmail = DB::table('tbl_customers')
        ->where('customer_email', $request->customer_email)
        ->exists();

        $existingPhone = DB::table('tbl_customers')
        ->where('customer_phone', $request->customer_phone)
        ->exists();

        $errorMessage = '';

        $errorReported = false;

        if ($existingEmail) {
        $errorMessage .= ' <span style="color: red;">Email đã tồn tại trong hệ thống. </span> ';
        $errorReported = true;
        }

        if ($existingPhone) {
        $errorMessage .= ' <span style="color: red;"><br>Số điện thoại đã tồn tại trong hệ thống.</span> ';
        $errorReported = true;
        }

        if ($errorReported) {
        return redirect()->back()->with('message', $errorMessage);
        }



    
        // Nếu không có trùng lặp, thêm khách hàng mới vào cơ sở dữ liệu
        $data = [
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_password' => md5($request->customer_password),
            'customer_phone' => $request->customer_phone
        ];
    
        $customer_id = DB::table('tbl_customers')->insertGetId($data);
    
        if ($customer_id) {

            Session::put('customer_name', $request->customer_name);
            Session::flash('message', 'Đăng ký tài khoản <span style="color: black;">'.$request->customer_name.'</span> thành công!. Vui lòng đăng nhập');
            return redirect('/login-checkout');
        }
    }
    
    public function checkout_payment(){
        return view('pages.checkout.checkout_payment');

    }

    public function save_checkout_customer_payment(Request $request){
        
        $data_shipping = array();
        $data_shipping['shipping_name'] = $request->shipping_name;
        $data_shipping['shipping_email'] = $request->shipping_email;
        $data_shipping['shipping_address'] = $request->shipping_address; 
        $data_shipping['shipping_phone'] = $request->shipping_phone;
        $data_shipping['shipping_note'] = $request->shipping_note;
    
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data_shipping);
        

        //////////////////// payment
        $data_payment = array();
        $data_payment['payment_menthod'] = $request->paymentMethod;
        $data_payment['payment_status'] = 0;
       
        $payment_id = DB::table('tbl_payment')->insertGetId($data_payment);

        ////// order

        $total = 0;

        foreach (Session::get('cart') as $key => $cart) {
            $subtotal = $cart['product_price'] * $cart['product_qty'];
            $total += $subtotal;
        }
        
        $order = new OrderModel();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->payment_id = $payment_id;
        $order->order_total = $total;
        $order->order_status = 'pending'; 
        $order->save(); 
        
        $order_id = $order->order_id;


//// order_details
foreach (Session::get('cart') as $key => $cart) {
    // Thêm sản phẩm vào chi tiết đơn hàng
    $data_orderd = array();
    $data_orderd['order_id'] = $order_id;
    $data_orderd['product_id'] = $cart['product_id'];
    $data_orderd['product_name'] = $cart['product_name']; 
    $data_orderd['product_price'] = $cart['product_price'];
    $data_orderd['product_sales_qty'] = $cart['product_qty'];

    $orderd_id = DB::table('tbl_order_details')->insertGetId($data_orderd);


    $product = ProductModel::find($cart['product_id']); 
    if ($product) {
        if ($product->product_quantity >= $cart['product_qty']) {
            $product->product_quantity -= $cart['product_qty']; 
            $product->product_sold += $cart['product_qty']; 
            $product->save(); 
        } else {
            return redirect()->back()->with('error', 'Sản phẩm ' . $cart['product_name'] . ' không đủ số lượng trong kho!');
        }
    } else {
        return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
    }
}

Session::forget('cart');


if ($data_payment['payment_menthod'] == 1) {
    return redirect('/thank-momo/' . $order_id);
} elseif ($data_payment['payment_menthod'] == 2) {
    return redirect('/thank-handcash/' . $order_id);
}


    }
   

    public function logout_checkout(){
        session()->forget('customer_id');
        return Redirect('/login-checkout');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
    
        $result = DB::table('tbl_customers')
            ->where('customer_email', $email)
            ->where('customer_password', $password)
            ->first();
    
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return redirect('/checkout-payment');
        } else {
            Session::flash('message','<span style="color: red;">Đăng nhập không thành công.</span>');
            return redirect('/login-checkout');
        }
    }


    //// manage_order
    public function manage_order(){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
    
        $all_order = OrderModel::with(['customer', 'payment'])
            ->orderBy('customer_id', 'desc')
            ->get();
    

            // foreach ($all_order as $order) {
            //     dd($order->payment);
            // }        
            return view('admin_layout', ['admin.manage_order' => view('admin.manage_order', compact('all_order'))]);
    }
    
    public function status_order(Request $request, $orderid)
    {
        $order = OrderModel::find($orderid);
    
        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại');
        }
    
        // Lấy trạng thái hiện tại của đơn hàng
        $current_status = $order->order_status;
    
        // Cập nhật trạng thái mới
        $order->order_status = $request->input('order_status');
        $order->save();
    
        // Nếu trạng thái chuyển thành 'cancelled' và trước đó không phải 'cancelled'
        if ($current_status !== 'cancelled' && $order->order_status === 'cancelled') {
            // Lấy danh sách sản phẩm trong đơn hàng
            $order_details = DB::table('tbl_order_details')
                ->where('order_id', $orderid)
                ->get();
    
            foreach ($order_details as $detail) {
                $product = ProductModel::find($detail->product_id);
                if ($product) {
                    // Trả lại số lượng sản phẩm
                    $product->product_quantity += $detail->product_sales_qty;
                    $product->save();
                }
            }
        }
    
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
    
    
    
    public function updatePaymentStatus(Request $request, $order_id)
    {
    $order = OrderModel::find($order_id);

    if ($order && $order->payment) {
        if ($order->payment->payment_menthod == 2) {
            $payment = $order->payment;
            $payment->payment_status = $request->input('payment_status');
            $payment->save();

            return back()->with('success', 'Trạng thái thanh toán đã được cập nhật');
        } else {
            return back()->with('error', 'Phương thức thanh toán không phải là "Thanh toán khi nhận hàng", không thể cập nhật trạng thái');
        }
    }

    return back()->with('error', 'Không tìm thấy đơn hàng hoặc thông tin thanh toán');
    }


    public function view_order($orderid){
        $check = $this->Authlogin();
        if ($check) {
            return $check; 
        }
                
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
           
            ->where('tbl_order.order_id', $orderid)
            ->get();  
        
        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
        
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
    }

    //// handcash
    public function thank_handcash($orderid){
        
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->where('tbl_order.order_id', $orderid)
            ->get();  
        
        return view('pages.checkout.handcash')->with('order_by_id', $order_by_id);
    }

    // public function thank_vnpay($orderid){
        
    //     $order_by_id = DB::table('tbl_order')
    //         ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
    //         ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
    //         ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
    //         ->where('tbl_order.order_id', $orderid)
    //         ->get();
            


    //     return view('pages.checkout.vnpay')->with('order_by_id', $order_by_id);
    // }


    // public function vnpay_payment(){

    //     $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    //     $vnp_Returnurl = "http://localhost:3000/demo/webbanrauqua_nhom6demo/webbanrauqua/index.php/thank-vnpay";
    //     $vnp_TmnCode = "X5FBNOBZ";//Mã website tại VNPAY 
    //     $vnp_HashSecret = "JPTKXGEVGNQAIZZHMZRMHHKJKGOQFWVO"; //Chuỗi bí mật

    //     $vnp_TxnRef = rand(00,99999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    //     $vnp_OrderInfo = 'Thanh Toán Đơn Hàng';
    //     $vnp_OrderType = 'billpayment';
    //     $vnp_Amount = 20000 * 100;
    //     $vnp_Locale = 'vn';
    //     $vnp_BankCode = 'NCB';
    //     $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //     //Add Params of 2.0.1 Version
    //     // $vnp_ExpireDate = $_POST['txtexpire'];
    //     //Billing
        
       
    //     $inputData = array(
    //         "vnp_Version" => "2.1.0",
    //         "vnp_TmnCode" => $vnp_TmnCode,
    //         "vnp_Amount" => $vnp_Amount,
    //         "vnp_Command" => "pay",
    //         "vnp_CreateDate" => date('YmdHis'),
    //         "vnp_CurrCode" => "VND",
    //         "vnp_IpAddr" => $vnp_IpAddr,
    //         "vnp_Locale" => $vnp_Locale,
    //         "vnp_OrderInfo" => $vnp_OrderInfo,
    //         "vnp_OrderType" => $vnp_OrderType,
    //         "vnp_ReturnUrl" => $vnp_Returnurl,
    //         "vnp_TxnRef" => $vnp_TxnRef
            
           
    //     );

    //     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    //         $inputData['vnp_BankCode'] = $vnp_BankCode;
    //     }
    //     if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    //         $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    //     }

    //     //var_dump($inputData);
    //     ksort($inputData);
    //     $query = "";
    //     $i = 0;
    //     $hashdata = "";
    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    //         } else {
    //             $hashdata .= urlencode($key) . "=" . urlencode($value);
    //             $i = 1;
    //         }
    //         $query .= urlencode($key) . "=" . urlencode($value) . '&';
    //     }

    //     $vnp_Url = $vnp_Url . "?" . $query;
    //     if (isset($vnp_HashSecret)) {
    //         $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    //         $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    //     }
    //     $returnData = array('code' => '00'
    //         , 'message' => 'success'
    //         , 'data' => $vnp_Url);
    //         if (isset($_POST['redirect'])) {
    //             header('Location: ' . $vnp_Url);
    //             die();
    //         } else {
    //             echo json_encode($returnData);
    //         }
    //         // vui lòng tham khảo thêm tại code demo

    //         }
    
    public function thank_momo($orderid){
        
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->where('tbl_order.order_id', $orderid)
            ->get();  
        
        return view('pages.checkout.momo')->with('order_by_id', $order_by_id);
    }

    public function momo_o(Request $request)
    {
        $orderId = $request->get('orderId'); 
        $resultCode = $request->get('resultCode'); 
    
        $orderIdParts = explode('_', $orderId);
        $cleanOrderId = $orderIdParts[0]; 
    
        $order = OrderModel::where('order_id', $cleanOrderId)->first();
    
        if ($resultCode == 0 && $order) { 
            $payment = PaymentModel::find($order->payment_id);
            if ($payment) {
                $payment->payment_status = 1; 
                $payment->save();
            }
        }
    
        return view('pages.checkout.momo_o', [
            'order' => $order,
        ]);
    }
    
    
    

    public function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }
    
        public function momo_payment(Request $request) {
            $order = OrderModel::find($request->order_id);
        
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $order->order_total; 
            $orderId = $order->order_id . '_' . time(); // Gắn thời gian hiện tại vào order_id
            $redirectUrl = url('/momo-o');
            $ipnUrl = url('/momo-o');
            $extraData = "";
        
            $requestId = time() . rand(1000, 9999); // Thêm thời gian và số ngẫu nhiên để unique
            $requestType = "payWithATM";
        
            // Chuẩn bị dữ liệu ký hash
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
            // Dữ liệu gửi đến MoMo
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
        
            // Gửi yêu cầu đến MoMo
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
        
            // Redirect đến URL thanh toán
            return redirect()->to($jsonResult['payUrl']);
        }
        


                
}
      
    


