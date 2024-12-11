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
    
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    
        .btn {
            background-color: #e63946; /* Red background */
            color: white; /* Text color */
            padding: 12px 30px; /* Adjusted padding for better text fitting */
            font-size: 16px; /* Font size */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease; /* Smooth transition */
            display: inline-flex; /* Use inline-flex to enable centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            text-align: center; /* Center text horizontally */
        }

        .btn:hover {
            background-color: #d62d20; /* Darker red on hover */
        }
    
        .btn-back-home {
            background-color: #2a9d8f; /* Different color for the back button */
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Remove underline */
        }
    
        .btn-back-home:hover {
            background-color: #21867a; /* Darker color on hover */
        }

        .section-title {
            margin-bottom: 30px; /* Add spacing below the title */
        }

        .checkout-area {
            padding-top: 30px;
            margin-bottom: 30px; /* Add spacing below the checkout area */
        }

        .card-header {
            margin-bottom: 20px; /* Add spacing between header and body */
        }

        .table {
            margin-bottom: 30px; /* Add spacing below the table */
        }

        .button-container {
            margin-top: 40px; /* Increase space for the back button */
        }

        /* Add bold style for payment amount */
        .payment-amount {
            font-weight: bold;
        }

        /* Add margin-top to "Thông Tin Vận Chuyển" section */
        .shipping-info {
            margin-top: 40px; /* Extra space above "Thông Tin Vận Chuyển" */
        }
    </style>

    <!-- Bắt đầu Breadcrumb -->
    <div class="main-breadcrumb mb-20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center ptb-70">
                        <h1>CỬA HÀNG</h1>
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Thanh Toán Khi Nhận Hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kết thúc Breadcrumb -->

    <div class="coupon-area">
        <div class="container">
            <div class="section-title mb-10">
                <h2>Thanh Toán Khi Nhận Hàng</h2>
            </div>
        </div>
    </div>

    <div class="checkout-area pt-30">
        <div class="container">
            <!-- Thông báo thanh toán -->
            <h1 class="display-1" style="font-size: 20px; text-align: center; white-space: nowrap;">Cảm ơn quý khách!</h1>
            <hr style="border-top: 2px solid green;">
            <p style="text-align: center; font-size: 20px" class="payment-note">
                @foreach ($order_by_id as $order) 
                Vui lòng thanh toán <strong class="payment-amount">{{ number_format($order->order_total) }} VND</strong> thanh toán khi nhận hàng
                @break 
                @endforeach
            </p>

            <!-- Thông tin Vận Chuyển -->
            <div class="card-header d-flex justify-content-center align-items-center shipping-info">
                <div class="header-title text-center">
                    <h4 class="card-title">Thông Tin Vận Chuyển</h4>
                </div>
            </div>
            
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tên khách hàng</th>                
                                <th>Địa chỉ</th>
                                <th>SĐT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_by_id as $order_s)
                            <tr>
                                <td>{{ $order_s->shipping_name }}</td>
                                <td>{{ $order_s->shipping_address }}</td>
                                <td>{{ $order_s->shipping_phone }}</td>
                            </tr>
                            @break
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Chi Tiết Đơn Hàng -->
            <div class="card-header d-flex justify-content-center align-items-center">
                <div class="header-title text-center">
                    <h4 class="card-title">Chi Tiết Đơn Hàng</h4>
                </div>
            </div>
            
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table id="order-list-table-2" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng giá tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_by_id as $order_d)
                            <tr>
                                <td>{{ $order_d->product_name }}</td>
                                <td>{{ $order_d->product_sales_qty }}</td>
                                <td>{{ number_format($order_d->product_price) }} VND</td>
                                <td>{{ number_format($order_d->product_price * $order_d->product_sales_qty) }} VND</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="button-container">
                <a class="btn-back-home" href="{{ URL::to('home') }}">Về trang chủ</a>
            </div>
        </div>
    </div>
</div>

@endsection
