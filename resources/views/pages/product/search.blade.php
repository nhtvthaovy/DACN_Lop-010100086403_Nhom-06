@extends('layout')
@Section('content')


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
                        <!-- <div class="row mt-20">
                            <div class="col-md-7">
                                <div class="grid-list-view">
                                     <ul class="list-inline nav">
                                         <li><a class="active" data-bs-toggle="tab" href="#grid-view" aria-expanded="false"><i class="zmdi zmdi-view-dashboard"></i><i class="pe-7s-keypad"></i></a></li>
                                         <li><a data-bs-toggle="tab" href="#list-view" aria-expanded="true"><i class="zmdi zmdi-view-list"></i><i class="pe-7s-menu"></i></a></li>
                                     </ul>
                                </div>
                            </div>
                             <div class="col-md-2">
                                 <select class="form-select mb-2 mb-md-0" class="form-control select-varient">
                                     <option value="#">Show: 9</option>
                                     <option value="#">Show: 24</option>
                                     <option value="#">Show: 36</option>
                                 </select>
                             </div>
                            <div class="col-md-3">
                                <select class="form-select mb-2 mb-md-0" class="form-control select-varient">
                                    <option value="#">Sort By:Default</option>
                                    <option value="#">Sort By:Name (A - Z)</option>
                                    <option value="#">Sort By:Name (Z - A)</option>
                                    <option value="#">Sort By:Price (Low > High)</option>
                                    <option value="#">Sort By:Price (High > Low)</option>
                                    <option value="#">Sort By:Rating (Highest)</option>
                                    <option value="#">Sort By:Rating (Lowest)</option>
                                    <option value="#">Sort By:Model (A - Z)</option>
                                    <option value="#">Sort By:Model (Z - A)</option>
                                </select>
                            </div>
                        </div> -->



                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content categorie-list ">

        @if ($search_all_product->isEmpty())
        <h5 class="mb-4" style="text-align: center; color: red;">Không tìm thấy kết quả cho "{{ $keys }}" --- <a href="{{ URL::to('shop') }}" style="color: green;">Đến Cửa Hàng</a></h5>
        @else 
        <h5 class="mb-4" style="text-align: center; color: orange;">Kết quả tìm kiếm cho <span style="color: inherit;">"{{ $keys }}"</span></h5>
        @endif
                                    <div id="grid-view" class="tab-pane fade show active mt-40">
                                        <div class="row">
                                            @foreach($search_all_product as $product)
                                                <div class="col-lg-4 col-md-6">
                                                    <!-- Single Product Start -->
                                                    <div class="single-product">
                                                        <!-- Product Image Start -->
                                                        <div class="pro-img">
                                                            <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                                                                <img class="primary-img" src="{{ asset('uploads/product/'.$product->product_image) }}" alt="{{ $product->product_name }}">
                                                                
                                                            </a>
                                                            <!-- <div class="quick-view">
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                                            </div> -->
                                                            {{-- <span class="sticker-new">new</span> --}}
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
                                        <!-- Row End -->
                                        <div class="row mt-40 mb-70">
                                            <div class="col-md-6">
                                                <ul class="blog-pagination">
                                                    <li class="active"><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                                </ul>
                                                <!-- End of .blog-pagination -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="pro-list-details text-end">
                                                    <p class="mr-15 mt-10">Showing 1 to 8 of 8 (1 Pages)</p>
                                                </div>
                                                <!-- Pro List Details End -->
                                            </div>
                                        </div>
                                        <!-- Row End -->
                                    </div>
                                    <!-- #Grid-view End -->
                                </div>
                                <!-- .Tab Content End -->
                            </div>
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Best Seller Product End -->
                </div>
                <!-- Sidebar Content End -->
                <!-- Sidebar Start -->
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
                
                <!-- Sidebar End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Categories Product End -->
    
</div>


@endsection