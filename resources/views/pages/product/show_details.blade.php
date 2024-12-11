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
                        <br>
                        <h1>Chi Tiết Sản Phẩm</h1>
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Chi Tiết Sản Phẩm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Breadcrumb End -->
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail pb-100">
        <div class="container">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

            @foreach($product as $key => $pro)
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-5">
                    <!-- Hiển thị ảnh sản phẩm -->
                    
                        <img id="big-img" src="{{ asset('uploads/product/' . $pro->product_image) }}" data-zoom-image="{{ asset('uploads/product/' . $pro->product_image) }}" alt="product-image" />
                    
                </div>
                <!-- Thumbnail Description Start -->
                <div class="col-md-7">
                    <div class="thubnail-desc fix">
                        <!-- Tên sản phẩm -->
                       
                            <h2 class="product-header">{{ $pro->product_name }}</h2>
                       
                        <!-- Product Rating Start -->
                        <div class="rating-summary fix mtb-20">
                            <div class="rating f-left mr-10">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa {{ $i <= floor($average_rating) ? 'fa-star' : 'fa-star-o' }}"></i>
                                @endfor
                            </div>
                            <div class="rating-feedback f-left">
                                <a href="#">{{ $total_reviews }} Đánh giá</a>
                            </div>
                        </div>
                        <div class="product-price-desc">
                            <ul class="pro-desc-list">
                                <li>Kho: <span>{{ $pro->product_quantity }}</span></li>
                                <li>Đã bán: <span>{{ $pro->product_sold }}</span></li>
                                <li>Tình trạng: 
                                    <span>
                                        @if (($pro->product_quantity - $pro->product_sold) > 0)
                                            Còn hàng
                                        @else
                                            Hết hàng
                                        @endif
                                    </span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Product Rating End -->
                        <!-- Product Price Start -->
                        <div class="pro-price mt-20 mb-20">
                            <ul class="pro-price-list">
                                <li class="price">{{ number_format($pro->product_price) }} VND</li>
                            </ul>
                        </div>
                        <!-- Product Price End -->
                        <!-- Product Box Quantity Start -->
                        <div class="box-quantity mtb-20">
                            <div class="quantity-item">
                                <div class="cart-plus">
                                    <input class="cart-plus-minus-box cart_product_qty_{{$pro->product_id}}" 
                                           type="number" 
                                           name="qtybutton" 
                                           value="1"
                                           min="1" 
                                           max="{{ $pro->product_quantity - $pro->product_sold }}">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Product Box Quantity End -->
                        <!-- Product Button Actions Start -->
                        <div class="product-button-actions">
                            <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                        
                            @if (($pro->product_quantity - $pro->product_sold) > 0)
                                <button class="add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">Thêm Vào Giỏ Hàng</button>
                            @else
                                <button class="add-to-cart" disabled>Hết hàng</button>
                            @endif
                            
                            <a href="wish-list.html" data-bs-toggle="tooltip" title="Add to Wishlist" class="same-btn mr-15"><i class="pe-7s-like"></i></a>
                        </div>
                        <!-- Product Button Actions End -->
                        
                        <!-- Product Button Actions End -->
                        <!-- Product Social Link Share Start -->
                        <div class="social-shared">
                            <ul>
{{-- <!-- Nút Thích -->
<div class="fb-like" data-href="http://localhost:3000/public/index.php/product-detail/{{$pro->product_id}}" 
    data-width="" 
    data-layout="" 
    data-action="" 
    data-size="" 
    data-share="false">
</div>

<!-- Nút Chia sẻ -->
<div class="fb-share-button" 
     data-href="http://localhost:3000/public/index.php/product-detail/{{$pro->product_id}}" 
     data-layout="button" 
     data-size="small">
</div>

<style>
    .fb-like, .fb-share-button {
        display: block; /* Đảm bảo mỗi nút nằm trên một dòng riêng */
        margin-bottom: 10px; /* Thêm khoảng cách giữa các nút */
    }
</style> --}}


                                



                                <!-- Product Social Link Share Dropdown Start -->
                                {{-- <li class="share-post">
                                    <a href="#">
                                        <span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                                        <span>share</span>
                                    </a>
                                    <ul class="sharable-dropdown">
                                        <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i>facebook</a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>email</a></li>                                     
                                        <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i>google+</a></li>
                                       
                                    </ul>
                                </li> --}}
                                <!-- Product Social Link Share Dropdown End -->
                            </ul>
                        </div>
                        <!-- Product Social Link Share End -->
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
        @endforeach
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail End -->
    
    <!-- Product Thumbnail Description Start -->
    <div class="thumnail-desc pb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="main-thumb-desc text-center nav list-inline">
                        <li><a class="active" data-bs-toggle="tab" href="#detail">Mô Tả Sản Phẩm</a></li>
                        <li><a data-bs-toggle="tab" href="#review">Đánh Giá ({{ $total_reviews }})</a></li>
                    </ul>
                    <!-- Product Thumbnail Tab Content Start -->
                    <div class="tab-content thumb-content">
                        <div id="detail" class="tab-pane fade show active pb-40">
                            <!-- Mô tả sản phẩm -->
                            
                            <p class="mb-10">{!! $pro->product_desc !!}</p>

                            
                        </div>
                        

<div id="review" class="tab-pane fade">
    <!-- Đánh Giá Bắt Đầu -->
    <div class="review">
        <h2>Tất Cả Đánh Giá</h2>
        <div id="all-reviews" class="mb-40">
            <!-- Hiển thị các đánh giá -->
            @foreach($reviews as $review)
            <div class="review-item mb-20" style="border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                <!-- Tiêu đề với thông tin người đánh giá, giờ và ngày -->
                <div class="review-header mb-10" style="display: flex; align-items: center; gap: 10px;">
                    <p class="review-meta" style="margin: 0; font-weight: bold;">{{ $review->customer->name }}</p> <!-- Tên người đánh giá -->
                    <p class="review-meta" style="margin: 0;">{{ \Carbon\Carbon::parse($review->created_at)->format('h:i A') }}</p> <!-- Giờ đánh giá -->
                    <p class="review-meta" style="margin: 0;">{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}</p> <!-- Ngày đánh giá -->
                </div>
        
                <div class="d-flex">
                    <!-- Nội dung đánh giá -->
                    <div class="review-content">
                        <h5 class="review-author">{{ $review->customer->customer_name }}</h5> <!-- Tên người đánh giá -->
                        <p class="review-text">{{ $review->comment }}</p> <!-- Bình luận đánh giá -->
        
                        <!-- Hiển thị sao vàng cho rating -->
                        <div class="review-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star {{ $i <= $review->rating ? 'gold' : 'gray' }}">&#9733;</span> <!-- Sao vàng nếu rating >= i, sao xám nếu không -->
                            @endfor
                        </div>
                    </div>
                </div>
        
                <!-- Hiển thị các phản hồi (nếu có) -->
                @foreach($review->replies as $reply)
                <div class="review-reply" style="margin-left: 30px; border-top: 1px solid #ddd; padding-top: 10px;">
                    <p class="review-meta" style="margin: 0; font-weight: bold;">{{ $reply->admin->admin_name }} (Trả lời vào {{ \Carbon\Carbon::parse($reply->created_at)->format('h:i A, d/m/Y') }})</p>
                    <p class="review-text">{{ $reply->reply }}</p>
                </div>
                @endforeach
            </div>
            @endforeach
        
            <!-- Hiển thị thông báo nếu chưa có đánh giá -->
            @if($reviews->isEmpty())
                <p class="no-reviews text-muted">Chưa có đánh giá cho sản phẩm này.</p>
            @endif
        </div>
        
        <!-- CSS cho sao -->
        <style>
            .star {
                font-size: 20px; /* Điều chỉnh kích thước sao */
                color: #d3d3d3; /* Màu xám mặc định */
            }
        
            .star.gold {
                color: gold; /* Màu vàng cho sao được chọn */
            }
        
            .star.gray {
                color: #d3d3d3; /* Màu xám cho sao chưa chọn */
            }
        
            .review-meta {
                font-size: 14px;
                color: #777;
            }
        
            .review-content {
                margin-left: 10px;
            }
        
            .review-reply {
                margin-top: 10px;
            }
        
            .review-author {
                font-weight: bold;
            }
        
            .review-text {
                font-size: 14px;
            }
        </style>
        

        <h2>VIẾT ĐÁNH GIÁ</h2>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    </div>
    <!-- Đánh Giá Kết Thúc -->
    
    <!-- Phần Đánh Giá Bắt Đầu -->


    <div class="review-field mt-30 mb-30">

        <?php
        $customer_id = Session::get('customer_id');
        $reviewer_name = '';
        $can_review = false;
        
        if ($customer_id) {
            $customer = App\Models\CustomerModel::find($customer_id);
            if ($customer) {
                $reviewer_name = $customer->customer_name;
        
                // Kiểm tra nếu người dùng đã mua sản phẩm và trạng thái đơn hàng là 'completed'
                $can_review = App\Models\OrderModel::where('customer_id', $customer_id)
                    ->where('order_status', 'completed')
                    ->whereHas('orderDetails', function ($query) use ($pro) {
                        $query->where('product_id', $pro->product_id);
                    })->exists();
        
                // Kiểm tra nếu người dùng chưa đánh giá sản phẩm này
                if ($can_review) {
                    $can_review = !App\Models\ReviewModel::where('customer_id', $customer_id)
                        ->where('product_id', $pro->product_id)
                        ->exists();
                }
            }
        }
        ?>
        
        
        
    
            @if ($reviewer_name && $can_review)
            <form autocomplete="off" method="POST" action="{{ URL::to('/submit-review')}}">
                @csrf
            
                <div class="form-group">
                    <label class="req" for="sure-name">Tên</label>
                    <input type="text" class="form-control" id="sure-name" name="reviewer_name" value="{{ $reviewer_name }}" required="required" readonly>
                </div>
                <input type="hidden" name="product_id" value="{{ $pro->product_id }}">
                <input type="hidden" name="customer_id" value="{{ $customer_id }}">
            
                <div class="form-group">
                    <label class="req" for="comments">Đánh Giá Của Bạn</label>
                    <textarea class="form-control" rows="5" id="comments" name="comment" required="required" maxlength="300"></textarea>
                    <div class="help-block">
                        <span class="text-danger">Lưu Ý:</span> Đánh giá tối đa 300 ký tự
                    </div>
                </div>
            
                <div class="form-group required radio-label">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label req">Đánh Giá</label> &nbsp;&nbsp;&nbsp;
                            <!-- Các ngôi sao cho người dùng chọn -->
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                            <input type="hidden" name="rating" id="rating" value="">
                        </div>
                    </div>
                </div>
            
                <div class="pull-right">
                    <button type="submit" id="button-review">Tiếp Tục</button>
                </div>
            </form>
            
            <script>
                window.onload = function() {
                    const stars = document.querySelectorAll('.star');
                    const ratingInput = document.getElementById('rating');
            
                    stars.forEach(star => {
                        star.addEventListener('mouseover', function() {
                            // Đổi màu các sao khi hover
                            const value = this.getAttribute('data-value');
                            stars.forEach(s => {
                                if (s.getAttribute('data-value') <= value) {
                                    s.classList.add('hover');
                                } else {
                                    s.classList.remove('hover');
                                }
                            });
                        });
            
                        star.addEventListener('mouseout', function() {
                            // Xóa màu hover khi di chuột ra ngoài
                            stars.forEach(s => {
                                s.classList.remove('hover');
                            });
                        });
            
                        star.addEventListener('click', function() {
                            const ratingValue = this.getAttribute('data-value');
                            ratingInput.value = ratingValue; // Cập nhật giá trị vào input ẩn
            
                            // Tô màu các sao từ 1 đến sao đã chọn
                            stars.forEach(s => {
                                if (s.getAttribute('data-value') <= ratingValue) {
                                    s.classList.add('selected');
                                } else {
                                    s.classList.remove('selected');
                                }
                            });
                        });
                    });
                };
            </script>
            
            <style>
                /* Thêm kiểu CSS cho ngôi sao */
                .star {
                    font-size: 30px;
                    color: #d3d3d3; /* Màu xám khi sao chưa được chọn */
                    cursor: pointer;
                }
            
                .star.selected {
                    color: gold; /* Màu vàng khi sao được chọn */
                }
            
                .star.hover {
                    color: #FFD700; /* Màu vàng sáng khi hover */
                }
            </style>
            
            
            
            
            

            
@elseif (!$reviewer_name)
    <p class='text-danger'>Vui lòng đăng nhập để thực hiện đánh giá.</p>
@else
    <p class='text-danger'>Bạn chỉ có thể đánh giá sau khi đã mua sản phẩm này với trạng thái đơn hàng hoàn tất.</p>
@endif

    
            
    </div>
    


    <!-- Phần Đánh Giá Kết Thúc -->
</div>



                    <!-- Product Thumbnail Tab Content End -->
                </div>
            </div>

            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail Description End -->
    <!-- Best Seller Products Start -->
    <div class="best-seller-products pb-100">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-12">
                    <div class="section-title text-center mt-40 mb-40">
                        <h3 class="section-info">SẢN PHẨM LIÊN QUAN</h3>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>
            <!-- Row End -->
            <div class="row">
                <div class="col-12">
                    <!-- Best Seller Product Activation Start -->
                    <div class="best-seller new-products owl-carousel">
                        @foreach($related_products as $related_product)
                            <!-- Single Product Start -->
                            <div class="single-product">
                                <!-- Product Image Start -->
                                <div class="pro-img">
                                    <a href="{{URL::to('/product-detail/'.$related_product->product_id)}}">
                                        <img class="primary-img" src="{{ asset('uploads/product/' .$related_product->product_image) }}" alt="single-product">
                                    </a>
                                    {{-- <div class="quick-view">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                    </div> --}}
                                    {{-- <span class="sticker-new">new</span> --}}
                                </div>
                                <!-- Product Image End -->
                                <!-- Product Content Start -->
                                <div class="pro-content text-center">
                                    <h4><a href="{{URL::to('/product-detail/'.$related_product->product_id)}}">{{ $related_product->product_name }}</a></h4>
                                    <p class="price"><span>{{ number_format($related_product->product_price, 0, ',', '.') }}₫</span></p>
                                    <div class="action-links2">
                                        <a data-bs-toggle="tooltip" title="Add to Cart" href="{{URL::to('/product-detail/'.$related_product->product_id)}}">Xem Thêm</a>
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
    <!-- Best Seller Products End -->
  

</div>
<!-- Wrapper End -->


@endsection
