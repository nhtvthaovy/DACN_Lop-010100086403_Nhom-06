@extends('layout')
@Section('content')

<!-- Slider Area Start -->
<div class="slider-area pb-100 home-2-slider">
    <!-- Main Slider Area Start -->
    <div class="slider-wrapper theme-default">
        <!-- Slider Background  Image Start-->
        <div id="slider" class="nivoSlider">
            <img src="{{ asset('frontend/img/slider/3.jpg')}}" data-thumb="img/slider/3.jpg" alt="" title="#htmlcaption" />
            <img src="{{ asset('frontend/img/slider/4.jpg')}}" data-thumb="img/slider/4.jpg" alt="" title="#htmlcaption2" />
        </div>
        <!-- Slider Background  Image Start-->
        <!-- Slider htmlcaption Start-->
        <div id="htmlcaption" class="nivo-html-caption slider-caption">
            <!-- Slider Text Start -->
            <div class="slider-text">
                <h2 class="wow fadeInLeft" data-wow-delay="1s">products for your<br>home or office</h2>
                <p class="wow fadeInRight" data-wow-delay="1s">designer lighting</p>
                <a class="wow bounceInDown" data-wow-delay="0.8s" href{{ URL::to('shop') }}">Cửa Hàng</a>
            </div>
            <!-- Slider Text End -->
        </div>
        <!-- Slider htmlcaption End -->
        <!-- Slider htmlcaption Start -->
        <div id="htmlcaption2" class="nivo-html-caption slider-caption">
            <!-- Slider Text Start -->
            <div class="slider-text">
                <h2 class="wow zoomInUp" data-wow-delay="0.5s">hanging and lanterns<br>and sconces</h2>
                <p class="wow zoomInUp" data-wow-delay="0.6s">style for every space</p>
                <a class="wow zoomInUp" data-wow-delay="1s" href="{{ URL::to('shop') }}">Cửa Hàng</a>
            </div>
            <!-- Slider Text End -->
        </div>
        <!-- Slider htmlcaption End -->
    </div>
    <!-- Main Slider Area End -->
</div>
<!-- Slider Area End -->
<!-- home-2 Banner Start -->
<div class="home-home-2-banner pb-100">
    <div class="container-fluid plr-0">
        <div class="row">
            <!-- Single Banner Start -->
            <div class="col-md-4">
                <div class="single-banner zoom">
                    <img src="{{ asset('frontend/img/products-banner/6.jpg')}}" alt="single-banner">
                    <div class="banner-content">
                        <h5>Đèn Vườn</h5>
                        <h3>Giảm Giá</h3>
                        <a href="{{ URL::to('shop') }}">Cửa Hàng</a>
                    </div>
                </div>
            </div>
            <!-- Single Banner End -->
            <!-- Single Banner Start -->
            <div class="col-md-4">
                <div class="single-banner zoom">
                    <img src="{{ asset('frontend/img/products-banner/7.jpg')}}" alt="single-banner">
                    <div class="banner-content">
                        <h5>Trang Trí Nội Thất </h5>
                        <h3>Giảm 30%</h3>
                        <a href="{{ URL::to('shop') }}">Cửa Hàng</a>
                    </div>
                </div>
            </div>
            <!-- Single Banner End -->
            <!-- Single Banner Start -->
            <div class="col-md-4">
                <div class="single-banner zoom">
                    <img src="{{ asset('frontend/img/products-banner/8.jpg')}}" alt="single-banner">
                    <div class="banner-content">
                        <h5>Bộ Sưu Tập Mới</h5>
                        <h3>Đèn Trần</h3>
                        <a href="{{ URL::to('shop') }}">Cửa Hàng</a>
                    </div>
                </div>
            </div>
            <!-- Single Banner End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- home-2 Banner End -->
<!-- home-2 New Products Start -->
<div class="h2-new-products pb-80">
    <div class="container">
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center mb-40">
                   
                    <h3 class="section-info">Sản phẩm</h3>
                </div>
            </div>
            <!-- Section Title End -->
        </div>
        <!-- Row End -->
            
<!-- Tab Content -->
<div class="row">
    <div class="col-12">
        <!-- Tabs -->
<!-- Tabs -->
<ul class="text-center list-inline new-products-list nav justify-content-center mb-30">
    <li><a class="active" data-bs-toggle="tab" href="#all">Tất cả</a></li>
    @foreach ($categories as $category)
        <li><a data-bs-toggle="tab" href="#{{ Str::slug($category)}}">{{ $category}}</a></li>
    @endforeach
</ul>


        <!-- Tab Content -->
        <div class="tab-content">
            <!-- All Products Tab -->
            <div id="all" class="tab-pane fade show active">
                <div class="best-seller new-products owl-carousel">
                    @foreach ($all_product as $product)
                        <div class="single-product">
                            <div class="pro-img">
                                <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                                    <img class="primary-img" src="{{ asset('uploads/product/'. $product->product_image) }}" alt="{{ $product->product_name }}">
                                </a>
                            </div>
                            <div class="pro-content text-center">
                                <h4><a href="{{URL::to('/product-detail/'.$product->product_id)}}">{{ $product->product_name }}</a></h4>
                                <p class="price"><span>{{ number_format($product->product_price, 0, ',', '.') }}₫</span></p>
                                <div class="action-links2">
                                    <a data-bs-toggle="tooltip" title="Xem Thêm" href="{{URL::to('/product-detail/'.$product->product_id)}}">Xem Thêm</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Category Tabs -->
            @foreach ($categories as $category)
                <div id="{{ Str::slug($category)}}" class="tab-pane fade">
                    <div class="best-seller new-products owl-carousel">
                        @foreach ($all_product->where('category_name', $category) as $product)
                            <div class="single-product">
                                <div class="pro-img">
                                    <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                                        <img class="primary-img" src="{{ asset('uploads/product/'. $product->product_image) }}" alt="{{ $product->product_name }}">
                                    </a>
                                </div>
                                <div class="pro-content text-center">
                                    <h4><a href="{{URL::to('/product-detail/'.$product->product_id)}}">{{ $product->product_name }}</a></h4>
                                    <p class="price"><span>{{ number_format($product->product_price, 0, ',', '.') }}₫</span></p>
                                    <div class="action-links2">
                                        <a data-bs-toggle="tooltip" title="Xem Thêm" href="{{URL::to('/product-detail/'.$product->product_id)}}">Xem Thêm</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


                
        
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- home-2 New Products End -->
<!-- home-2 Big Banner Start -->
<div class="h2-big-banner pb-100">
    <div class="container">
        <div class="row">
            <!-- Big Banner Start -->
            <div class="col-12">
                <div class="big-banner text-center">
                    <div class="big-banner-desc">
                        <h2>Sáng Tạo Nội Thất</h2>
                        <a href="{{ URL::to('shop') }}">Xem Thêm</a>
                    </div>
                </div>
            </div>
            <!-- Big Banner End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- home-2 Big Banner End -->
<!-- home-2 Featured Products Start -->
<div class="h2-featured-products pb-80">
    <div class="container-fluid plr-0">
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center mb-40">
                    {{-- <span class="section-desc mb-20">Chúng tôi cung cấp trang trí lựa chọn tốt nhất</span> --}}
                    <h3 class="section-info">Sản Phẩm Nổi Bật</h3>
                </div>
            </div>
            <!-- Section Title End -->
        </div>
        <!-- Row End -->
        <div class="row">
            <div class="col-12">
                <div class="featured-pro owl-carousel">
                    @foreach ($all_product as $product)
                        <!-- Single Product Start -->
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                                    <img class="primary-img" src="{{ asset('uploads/product/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                                </a>
                                {{-- <span class="sticker-sale">sale</span> --}}
                            </div>
                            <!-- Product Image End -->
                            
                            <!-- Product Content Start -->
                            <div class="pro-content text-center">
                                <h4><a href="{{URL::to('/product-detail/'.$product->product_id)}}">{{ $product->product_name }}</a></h4>
                                <p class="price"><span>{{ number_format($product->product_price, 0, ',', '.') }}₫</span></p>
                                <div class="action-links2">
                                    <a data-bs-toggle="tooltip" title="" href="{{URL::to('/product-detail/'.$product->product_id)}}">Xem Thêm</a>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                        <!-- Single Product End -->
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- home-2 Featured Products End -->
<!-- Latest Blog Start -->
<div class="latest-blog off-white-bg ptb-100">
    <div class="container">
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center mb-40">
                    {{-- <span class="section-desc mb-20">Latest News From Our Blog</span> --}}
                    <h3 class="section-info">BLOG MỚI NHẤT</h3>
                </div>
            </div>
            <!-- Section Title End -->
         </div>
         <!-- Row End -->
        <div class="row">
            <div class="col-12">
                <!-- Blog Activation Start -->
                <div class="blog owl-carousel">
                    <!-- Single Blog Start -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="{{ URL::to('post') }}"><img src="{{ asset('frontend/img/blog/1.jpg')}}" alt="blog-image"></a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-content-upper">
                                <h6 class="blog-title"><a href="{{ URL::to('post') }}">Amber Interiors</a></h6>
                                <p>Interior designer Amber Lewis’s blog takes you inside the creative workings of her Los Angeles–based studio.</p>
                            </div>
                            <div class="blog-content-lower">
                                <a href="{{ URL::to('post') }}">Nevara</a>
                                <span class="f-right">05 Nov, 2022</span>
                            </div>
                        </div>
                    </div>
                    <!-- Single Blog End -->
                     <!-- Single Blog Start -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="{{ URL::to('post') }}"><img src="{{ asset('frontend/img/blog/2.jpg')}}" alt="blog-image"></a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-content-upper">
                                <h6 class="blog-title"><a href="{{ URL::to('post') }}">Coco Lapine Design</a></h6>
                                <p>The blog of Belgian designer Sarah Van Peteghem, Coco Lapine Design is the space where she shares all.</p>
                            </div>
                            <div class="blog-content-lower">
                                <a href="{{ URL::to('post') }}">Nevara</a>
                                <span class="f-right">04 Oct, 2022</span>
                            </div>
                        </div>
                    </div>
                    <!-- Single Blog End -->
                    <!-- Single Blog Start -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="{{ URL::to('post') }}"><img src="{{ asset('frontend/img/blog/3.jpg')}}" alt="blog-image"></a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-content-upper">
                                <h6 class="blog-title"><a href="{{ URL::to('post') }}">Style by Emily Henderson</a></h6>
                                <p>The list wouldn’t be complete without the ever-stylish blog of interior design extraordinaire Emily Henderson.</p>
                            </div>
                            <div class="blog-content-lower">
                                <a href="{{ URL::to('post') }}">Nevara</a>
                                <span class="f-right">16 Aug, 2022</span>
                            </div>
                        </div>
                    </div>
                    <!-- Single Blog End -->
                    
                    
                    
                </div>
                <!-- Blog Activation End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Latest Blog End -->
<!-- Footer Start -->
<footer>
    <!-- Footer Top Start -->
    <div class="footer-top ptb-50">
        <div class="container">
            <div class="row">
                <div class="banner-slider owl-carousel">
                    <!-- Single Banner Start -->
                    <div class="single-banner">
                        <a href="#"><img src="{{ asset('frontend/img/banner-slider/1.png')}}" alt="banner-image"></a>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="single-banner">
                        <a href="#"><img src="{{ asset('frontend/img/banner-slider/2.png')}}" alt="banner-image"></a>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="single-banner">
                       <a href="#"><img src="{{ asset('frontend/img/banner-slider/3.png')}}" alt="banner-image"></a>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="single-banner">
                        <a href="#"><img src="{{ asset('frontend/img/banner-slider/4.png')}}" alt="banner-image"></a>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="single-banner">
                        <a href="#"><img src="{{ asset('frontend/img/banner-slider/5.png')}}" alt="banner-image"></a>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="single-banner">
                        <a href="#"><img src="{{ asset('frontend/img/banner-slider/6.png')}}" alt="banner-image"></a>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="single-banner">
                        <a href="#"><img src="{{ asset('frontend/img/banner-slider/3.png')}}" alt="banner-image"></a>
                    </div>
                    <!-- Single Banner End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Top End -->

    @endsection