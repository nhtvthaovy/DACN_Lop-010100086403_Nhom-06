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
       
    <!-- Page Breadcrumb Start -->
    <div class="main-breadcrumb mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center ptb-70">
                        <h1>CỬA HÀNG</h1>
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Cửa Hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Breadcrumb End -->

    <!-- Categories Product Start -->
    <div class="all-categories pb-100">
        <div class="container">
            <div class="row">
                <!-- Sidebar Content Start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <!-- Best Seller Product Start -->
                    <div class="best-seller">
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content categorie-list">
                                    <div id="grid-view" class="tab-pane fade show active mt-40">
                                        <div class="row">
                                            @foreach($all_product as $product)
                                                <div class="col-lg-4 col-md-6">
                                                    <!-- Single Product Start -->
                                                    <div class="single-product">
                                                        <!-- Product Image Start -->
                                                        <div class="pro-img">
                                                            <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                                                                <img class="primary-img" src="{{ asset('uploads/product/'.$product->product_image) }}" alt="{{ $product->product_name }}">
                                                            </a>
                                                        </div>
                                                        <!-- Product Image End -->
                                                        <!-- Product Content Start -->
                                                        <div class="pro-content text-center">
                                                            <h4><a href="{{URL::to('/product-detail/'.$product->product_id)}}">{{ $product->product_name }}</a></h4>
                                                            <p class="price"><span>{{ number_format($product->product_price, 0, ',', '.') }}₫</span></p>
                                                            <div class="action-links2">
                                                                <a data-bs-toggle="tooltip" title="Add to Cart" href="{{URL::to('/product-detail/'.$product->product_id)}}">Xem Thêm</a>
                                                            </div>
                                                        </div>
                                                        <!-- Product Content End -->
                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Best Seller Product End -->

<!-- Pagination Start -->
<div class="row mt-40 mb-70">
    <div class="col-md-6">
        <ul class="blog-pagination">


            @for ($i = 1; $i <= $all_product->lastPage(); $i++)
                <li class="{{ $i == $all_product->currentPage() ? 'active' : '' }}">
                    <a href="{{ $all_product->url($i) }}">{{ $i }}</a>
                </li>
            @endfor


        </ul>
    </div>

</div>
<!-- Pagination End -->

                </div>
                <!-- Sidebar Content End -->

                <!-- Sidebar Start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="categorie-sidebar mb-100">
                        <!-- Categories Module Start -->
                        <div class="categorie-module mb-80">
                            <h3>Danh Mục</h3>
                            <ul class="categorie-list">
                                @foreach ($all_product2->unique('category_id') as $cate)
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="{{ URL::to('/category-product/'.$cate->category_id) }}">
                                            <i class="fas fa-apple-alt me-2"></i> 
                                            {{ $cate->category_name }}
                                        </a>
                                        <?php
                                            // Đếm số sản phẩm trong danh mục này
                                            $productCount = $all_product2->where('category_id', $cate->category_id)->count();
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
                <!-- Sidebar End -->

            </div>
        </div>
    </div>
    <!-- Categories Product End -->
</div>
<!-- Wrapper End -->

@endsection
