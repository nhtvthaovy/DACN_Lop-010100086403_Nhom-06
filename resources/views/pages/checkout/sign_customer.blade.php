@extends('layout')

@section('content')
<div class="wrapper">

    <!-- Header Sticky -->
    <style>
        .header-top-area.header-sticky {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333333;
            z-index: 9999;
        }
        
        .register-account .form-group {
        text-align: center;
        }

        .register-account .btn {
            display: inline-block;
            padding: 5px 20px; /* Khoảng cách bên trong nút */
            font-size: 16px; /* Kích thước chữ */
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center; /* Đảm bảo căn giữa chữ */
            line-height: 1.5; /* Đảm bảo căn giữa trong nút */
            width: auto; /* Không cần chiều rộng cố định */
            margin: 0 auto; /* Căn giữa nút trong form */
            box-sizing: border-box; /* Đảm bảo padding không làm méo chiều rộng */
        }

        .register-account .btn:hover {
            background-color: #45a049;
        }

    </style>

    <!-- Page Breadcrumb Start -->
    <div class="main-breadcrumb mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center ptb-70">
                        <h1>CỬA HÀNG</h1>
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Đăng Ký</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Breadcrumb End -->

    <!-- Register Account Start -->
    <div class="register-account">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="register-title">
                        <h3 class="mb-10">ĐĂNG KÝ TÀI KHOẢN</h3>
                        <p class="mb-10">Nếu bạn đã có tài khoản, vui lòng đăng nhập tại trang <a href="{{ URL::to('login-checkout') }}">Đăng Nhập</a></p>
                        <?php
                        $message = Session::get('message');
                        
                        if ($message) {
                          echo $message;
                          Session::flash('message', null);
                        }
                      ?>
                    </div>
                    <form action="{{ URL::to('add-customer') }}" method="post" class="form-horizontal pb-100">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend>Thông Tin Cá Nhân</legend>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="customer_name"><span class="require">*</span>Họ và Tên</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="customer_name" placeholder="Họ và tên" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="customer_email"><span class="require">*</span>Email</label>
                                <div class="col-md-10">
                                    <input type="email" class="form-control" name="customer_email" placeholder="Địa chỉ email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="customer_password"><span class="require">*</span>Mật khẩu</label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control" name="customer_password" placeholder="Mật khẩu" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="customer_phone"><span class="require">*</span>SĐT</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="customer_phone" placeholder="Số điện thoại" required>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-default">Đăng Ký</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Register Account End -->

</div>
@endsection
