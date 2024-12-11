@extends('layout')

@section('content')

<!-- Wrapper Start -->
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
       


    <div class="main-breadcrumb mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center ptb-70">
                        <h1>{{ $cate_name->category_name }}</h1> <!-- Tên danh mục -->
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Cửa Hàng</a></li>
                            <li>{{ $cate_name->category_name }}</li> <!-- Tên danh mục -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Product Start -->
    <div class="all-categories pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="best-seller">
                        <div class="row">
                            @foreach($all_cate_pro as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-product">
                                        <div class="pro-img">
                                            <a href="#">
                                                <img class="primary-img" src="{{ asset('uploads/product/'.$product->product_image) }}" alt="{{ $product->product_name }}">
                                            </a>
                                        </div>
                                        <div class="pro-content text-center">
                                            <h4><a href="#">{{ $product->product_name }}</a></h4>
                                            <p class="price"><span>${{ number_format($product->product_price, 2) }}</span></p>
                                            <div class="action-links2">
                                                <a data-bs-toggle="tooltip" title="Add to Cart" href="#">Xem Thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="categorie-sidebar mb-100">
                        <!-- Categories Module Start -->
                        <div class="categorie-module mb-80">
                            <h3>Danh Mục</h3>
                            <ul class="categorie-list">
                                @foreach ($all_product->unique('category_id') as $cate)
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="{{ URL::to('/category-product/'.$cate->category_id) }}">
                                            <i class="fas fa-apple-alt me-2"></i> 
                                            {{ $cate->category_name }}
                                        </a>
                                        <?php
                                            // Đếm số sản phẩm trong danh mục này
                                            $productCount = $all_product->where('category_id', $cate->category_id)->count();
                                        ?>
                                        <span>({{ $productCount }})</span>
                                    </div>
                                </li>
                                @endforeach
                            
                            
                            
                            </ul>
                        </div>
                        <!-- Categories Module End -->
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
