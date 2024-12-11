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

    <!-- Page Breadcrumb Start -->
    <div class="main-breadcrumb mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center ptb-70">
                        <h1>CỬA HÀNG</h1>
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Giỏ Hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Breadcrumb End -->

    <!-- Cart Main Area Start -->
    <div class="cart-main-area pb-100">
        <div class="container">

            <!-- Section Title Start -->
            <div class="section-title mb-50">
                <h2>Giỏ Hàng</h2>



                
            </div>
            <!-- Section Title End -->
            <div class="row">
                <div class="col-12">
                    <!-- Form Start -->
                    <form action="{{ URL::to('/update-cart') }}" method="POST">
                        @csrf
                        <!-- Table Content Start -->
                        <div class="table-content table-responsive mb-50">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Ảnh</th>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Số lượng</th>
                                        <th class="product-subtotal">Tổng</th>
                                        <th class="product-remove">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @if (session('cart'))
                                    @foreach (session('cart') as $key => $cart)
                                    @php
                                    $product = \App\Models\ProductModel::find($cart['product_id']);
                                    if ($product) {
                                        $quantity_left = $product->product_quantity - $product->product_sold;
                                    } else {
                                        $quantity_left = 0;
                                    }
                            
                                    $subtotal = $cart['product_price'] * $cart['product_qty'];
                                    $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="{{ asset('uploads/product/'.$cart['product_image']) }}" alt="cart-image" /></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{ $cart['product_name'] }}</a></td>
                                        <td class="product-price"><span class="amount">{{ number_format($cart['product_price'], 0, ',', '.') }} VND</span></td>
                                        <td class="product-quantity">
                                            <input type="number" name="cart_qty[{{ $cart['session_id'] }}]" 
                                                value="{{ $cart['product_qty'] }}" 
                                                min="1" 
                                                max="{{ $quantity_left }}" 
                                                onchange="this.form.submit()" />
                                            <span> / {{ $quantity_left }} còn lại</span> 
                                        </td>
                                        <td class="product-subtotal">{{ number_format($subtotal, 0, ',', '.') }} VND</td>
                                        <td class="product-remove">
                                            <a href="{{ URL::to('/delete-pro-cart/'.$cart['session_id']) }}">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" class="text-center" style="color: red; font-size: 18px; font-weight: bold; opacity: 0.5;">
                                            Giỏ hàng rỗng.
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            
                            
                        </div>
                        <!-- Table Content End -->

                        <!-- Row Start -->
                        <div class="row">
                            <!-- Cart Button Start -->
                            <div class="col-lg-8 col-md-7">
                                <div class="buttons-cart">
                                    
                                    <a href="{{ URL::to('shop') }}">Tiếp tục mua sắm</a>
                                </div>

                            </div>
                            <!-- Cart Button End -->

                            <!-- Cart Totals Start -->
                            <div class="col-lg-4 col-md-5">
                                <div class="cart_totals">
                                    <h2>Tổng Giỏ Hàng</h2>
                                    <br />
                                    <table>
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Tổng tiền hàng</th>
                                                <td><span class="amount">{{ number_format($total, 0, ',', '.') }} VND</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Tổng thanh toán</th>
                                                <td>
                                                    <strong><span class="amount">{{ number_format($total, 0, ',', '.') }} VND</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        @if(session('customer_id'))
                                        <a href="{{ URL::to('checkout-payment') }}">Thanh toán</a>
                                        @else
                                        <a href="{{ URL::to('login-checkout') }}">Đăng nhập để thanh toán</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Cart Totals End -->
                        </div>
                        <!-- Row End -->
                    </form>
                    <!-- Form End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Cart Main Area End -->
</div>


@endsection