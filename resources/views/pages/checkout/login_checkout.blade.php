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
                            <li><a href="#">Đăng Nhập</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Breadcrumb End -->
    <!-- Trang Điều Hướng Kết Thúc -->
    <!-- Trang Đăng Nhập Bắt Đầu -->
    <div class="log-in pb-100">
        <div class="container">
            <div class="row">
                <!-- Khách Hàng Mới Bắt Đầu -->
                <div class="col-md-6">
                    <div class="well">
                        <div class="new-customer">
                            <h3>KHÁCH HÀNG MỚI</h3>
                            <p class="mtb-10"><strong>Đăng Ký</strong></p>
                            <p>Bằng cách tạo tài khoản, bạn sẽ mua sắm nhanh hơn, cập nhật được trạng thái đơn hàng và theo dõi những đơn hàng đã đặt trước đây.</p>
                            <a class="customer-btn" href="{{ URL::to('sign-customer') }}">tiếp tục</a>
                        </div>
                    </div>
                </div>
                <!-- Khách Hàng Mới Kết Thúc -->
                <!-- Khách Hàng Cũ Bắt Đầu -->
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="well">
                        <div class="return-customer">
                            <h3 class="mb-10">KHÁCH HÀNG CŨ</h3>
                            <p class="mb-10"><strong>Tôi là khách hàng cũ</strong></p>
                            <p class="mb-10"><strong style="color: green; margin-top: 20px; margin-bottom: 30px;"><?php
                                $message = Session::get('message');
                                
                                if ($message) {
                                  echo $message;
                                  Session::flash('message', null);
                                }
                              ?></strong></p>
                            <form action="{{ URL::to('login-customer') }}" method="post">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <label class="control-label">Nhập địa chỉ email của bạn...</label>
                                    <input type="text" name="email_account" placeholder="Nhập địa chỉ email của bạn..." id="input-email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mật khẩu</label>
                                    <input type="text" name="password_account" placeholder="Mật khẩu" id="input-password" class="form-control">
                                </div>
                                <p class="lost-password"><a href="forgot-password.html">Quên mật khẩu?</a></p>
                                <input type="submit" value="Đăng Nhập" class="return-customer-btn">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Khách Hàng Cũ Kết Thúc -->
            </div>
            <!-- Kết Thúc Hàng -->
        </div>
        <!-- Kết Thúc Container -->
    </div>
    <!-- Trang Đăng Nhập Kết Thúc -->

@endsection