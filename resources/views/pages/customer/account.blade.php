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
                            <li><a href="#">Tài Khoản</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Breadcrumb End -->
    
    <div class="log-in pb-100">
        <div class="container">
            <h2>Thông tin tài khoản</h2>

            <!-- Hiển thị thông báo -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('customer.update') }}">
                @csrf
                <div class="form-group">
                    <label for="customer_name">Họ và tên</label>
                    <input type="text" id="customer_name" name="customer_name" class="form-control" value="{{ $customer->customer_name }}" required>
                </div>
                
                <div class="form-group">
                    <label for="customer_email">Email</label>
                    <input type="email" id="customer_email" name="customer_email" class="form-control" value="{{ $customer->customer_email }}" required>
                </div>

                <div class="form-group">
                    <label for="customer_phone">Số điện thoại</label>
                    <input type="text" id="customer_phone" name="customer_phone" class="form-control" value="{{ $customer->customer_phone }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
            </form>
        </div>
    </div>

</div>

@endsection
