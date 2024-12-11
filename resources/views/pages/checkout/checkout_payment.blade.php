@extends('layout')

@section('content')

<div class="wrapper">

    <style>
        .header-top-area.header-sticky {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333333;  
            z-index: 9999;  
        }
    </style> 

    <!-- Bắt đầu Breadcrumb -->
    <div class="main-breadcrumb mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center ptb-70">
                        <h1>CỬA HÀNG</h1>
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Thanh Toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kết thúc Breadcrumb -->


   <div class="coupon-area">
    <div class="container">
       <!-- Tiêu đề Phần Bắt đầu -->
        <div class="section-title mb-50">
            <h2>Thanh Toán</h2>

            <?php
            $message = Session::get('message');
            
            if ($message) {
                echo $message;
                Session::put('message', null);
            }
        ?>
    
        @if (session('success'))
            <div class="alert alert-success" id="success-message">
                {{ session('success') }}
            </div>
        @endif
    
        @if (session('error'))
            <div class="alert alert-danger" id="error-message">
                {{ session('error') }}
            </div>
        @endif
        </div>
        
             
     
    </div>
</div>

<!-- Bắt đầu khu vực thanh toán -->
<div class="checkout-area pt-30">
    <div class="container">
        <form class="row" action="{{ URL::to('save-checkout-customer-payment') }}" method="post" onsubmit="return validateForm()">
            {{ csrf_field() }}
            <div class="col-lg-6">
                <div class="checkbox-form pb-50">
                    <h3>Thông Tin Hóa Đơn</h3>
                    <div class="row">   
                        
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Họ Tên <span class="required">*</span></label>
                                <input type="text" name="shipping_name" placeholder="Họ và tên" />
                            </div>
                        </div>
                        

                        
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Địa chỉ <span class="required">*</span></label>
                                <input type="text" name="shipping_address" placeholder="Địa chỉ đường phố" />
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="checkout-form-list mb-30">
                                <label>Email <span class="required">*</span></label>
                                <input type="email" name="shipping_email"  placeholder="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list mb-30">
                                <label>Điện Thoại <span class="required">*</span></label>
                                <input type="text" name="shipping_phone"  placeholder="Điện Thoại" />
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="checkout-form-list create-acc mb-30">
                                <input id="cbox" type="checkbox" />
                                <label>Tạo tài khoản?</label>
                            </div>
                            <div id="cbox_info" class="checkout-form-list create-accounts mb-25">
                                <p class="mb-10">Tạo tài khoản bằng cách nhập thông tin dưới đây. Nếu bạn là khách hàng quay lại, vui lòng đăng nhập ở đầu trang.</p>
                                <label>Mật khẩu tài khoản <span class="required">*</span></label>
                                <input type="password" placeholder="mật khẩu" />
                            </div>
                        </div> --}}
                    </div>


                    
                    {{-- <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <label>Gửi đến địa chỉ khác?</label>
                                <input id="ship-box" type="checkbox" />
                            </h3>
                        </div>
                        <div id="ship-box-info" class="row">
                            <div class="col-md-12">
                                <div class="country-select mb-30">
                                    <label>Quốc gia <span class="required">*</span></label>
                                    <select>
                                        <option value="volvo">Bangladesh</option>
                                        <option value="saab">Algeria</option>
                                        <option value="mercedes">Afghanistan</option>
                                        <option value="audi">Ghana</option>
                                        <option value="audi2">Albania</option>
                                        <option value="audi3">Bahrain</option>
                                        <option value="audi4">Colombia</option>
                                        <option value="audi5">Cộng hòa Dominica</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Họ <span class="required">*</span></label>
                                            <input type="text" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Tên <span class="required">*</span></label>
                                            <input type="text" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Tên công ty</label>
                                    <input type="text" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Địa chỉ <span class="required">*</span></label>
                                    <input type="text" placeholder="Địa chỉ đường phố" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Thành phố / Thị trấn <span class="required">*</span></label>
                                    <input type="text" placeholder="Thành phố / Thị trấn" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Bang / Huyện <span class="required">*</span></label>
                                    <input type="text" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Mã Bưu Điện <span class="required">*</span></label>
                                    <input type="text" placeholder="Mã Bưu Điện" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Điện Thoại <span class="required">*</span></label>
                                    <input type="text" placeholder="Điện Thoại" />
                                </div>
                            </div>
                        </div>--}}
                        <div class="order-notes">
                            <div class="checkout-form-list mb-30">
                                <label>Ghi chú đơn hàng</label>
                                <textarea name="shipping_note" id="checkout-mess" cols="30" rows="10" placeholder="Ghi chú về đơn đặt hàng của bạn"></textarea>
                            </div>
                        </div>
                    {{-- </div>  --}}



                </div>
            </div>

            <div class="col-lg-6">
                <div class="your-order mb-50">
                    <h3>Đơn Hàng Của Bạn</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Sản Phẩm</th>
                                    <th class="product-total">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $cartItems = Session::get('cart');
            
                                if (!empty($cartItems)) {
                                    foreach ($cartItems as $cart) {
                                        $subtotal = $cart['product_price'] * $cart['product_qty'];
                                        $total += $subtotal;
                                ?>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                <?php echo $cart['product_name']; ?>
                                                <strong class="product-quantity"> × <?php echo $cart['product_qty']; ?></strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount"><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</span>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="2" class="text-center" style="color: red; font-size: 17px; font-weight: bold; opacity: 0.65;">
                                            Không có sản phẩm nào --- <a href="{{ URL::to('home') }}">đến Trang chủ</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Tạm Tính</th>
                                    <td><span class="amount"><?php echo number_format($total, 0, ',', '.'); ?> VND</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Tổng</th>
                                    <td><strong><span class="amount"><?php echo number_format($total, 0, ',', '.'); ?> VND</span></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div id="accordion">
                                <div class="card mb-20">
                                    <div class="card-header" id="payment-1">
                                        <h5 class="panel-title">
                                            <label>
                                                <input type="radio" id="MOMO-1" name="paymentMethod" value="1" {{ old('paymentMethod') == 'MOMO' ? 'checked' : '' }}>
                                                Thanh toán MOMO
                                            </label>
                                        </h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="payment-2">
                                        <h5 class="panel-title">
                                            <label>
                                                <input type="radio" id="Delivery-1" name="paymentMethod" value="2" {{ old('paymentMethod') == 'delivery' ? 'checked' : '' }}>
                                                Thanh toán khi nhận hàng
                                            </label>
                                        </h5>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="order-button-payment mt-20">
                                <input name="send_order" type="submit" value="Đặt Hàng" />
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </form>
    </div>
</div>
<!-- Kết thúc khu vực thanh toán -->



</div>


<script>
    function validateForm() {
        var shippingName = document.getElementsByName("shipping_name")[0].value;
        var shippingAddress = document.getElementsByName("shipping_address")[0].value;
        var shippingPhone = document.getElementsByName("shipping_phone")[0].value;
        var shippingEmail = document.getElementsByName("shipping_email")[0].value;
        var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

        if (shippingName.trim() == "") {
            alert("Vui lòng nhập họ tên.");
            return false;
        }
        if (shippingAddress.trim() == "") {
            alert("Vui lòng nhập địa chỉ.");
            return false;
        }
        if (shippingPhone.trim() == "") {
            alert("Vui lòng nhập số điện thoại.");
            return false;
        }
        if (shippingEmail.trim() == "") {
            alert("Vui lòng nhập email.");
            return false;
        }
        if (!paymentMethod) {
            alert("Vui lòng chọn phương thức thanh toán.");
            return false;
        }
        
        // Nếu các trường nhập liệu đều hợp lệ, cho phép submit form
        return true;
    }
</script>

@endsection
