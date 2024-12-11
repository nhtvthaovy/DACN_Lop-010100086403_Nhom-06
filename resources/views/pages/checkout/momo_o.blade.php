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
        .success-message {
            text-align: center;
            font-size: larger;
            font-weight: bold;
            color: green;
        }

        .failure-message {
            text-align: center;
            font-size: larger;
            font-weight: bold;
            color: red;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .btn {
            background-color: #e63946;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #d32f2f;
        }
    </style>

    <!-- Breadcrumb -->
    <div class="main-breadcrumb mb-20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center ptb-70">
                        <h1>CỬA HÀNG</h1>
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Kết Quả Thanh Toán MOMO</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Result -->
    <div class="coupon-area">
        <div class="container">
            <div class="section-title mb-10">
                @if (isset($order) && $order->payment && $order->payment->payment_status == 1)
                    <!-- Hiển thị khi thanh toán thành công -->
                    <p class="success-message">Thanh toán thành công! Cảm ơn bạn đã đặt hàng.</p>
                    <hr style="border-top: 2px solid green;">
                    <div class="button-container">
                        <a class="btn border-secondary rounded-pill" href="{{ URL::to('home') }}">Về trang chủ</a>
                    </div>
                @else
                    <!-- Hiển thị khi thanh toán thất bại -->
                    <p class="failure-message">Thanh toán thất bại! Vui lòng thử lại.</p>
                    <hr style="border-top: 2px solid red;">
                    @if (isset($order))
                        <form action="{{ url('/momo-payment') }}" method="POST">
                            @csrf
                            <p style="text-align: center; font-weight: bold; color: blue;">Click vào nút để thanh toán</p>
                            <input type="hidden" name="total_momo" value="{{ $order->order_total }}">
                            <div class="button-container">
                                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                <button class="btn" type="submit">Thanh Toán MOMO Lại</button>
                            </div>
                        </form>
                    @else
                        <p style="color: red; text-align: center;">Không tìm thấy thông tin đơn hàng!</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
