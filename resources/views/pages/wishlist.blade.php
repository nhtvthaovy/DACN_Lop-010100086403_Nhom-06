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
                        <h1>Yêu Thích</h1>
                        <ul class="breadcrumb-list breadcrumb">
                            <li><a href="#">Trang Chủ</a></li>
                            <li><a href="#">Yêu Thích</a></li>
                        </ul>
                    </div>
                </div>
                <div class="best-seller">
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content categorie-list">
                                <div id="grid-view" class="tab-pane fade show active mt-40">
                                    <div class="row" id="wishlist-container">



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Breadcrumb End -->
</div>
<!-- Wrapper End -->

<script>
    var customerId = "<?php echo session('customer_id') ? session('customer_id') : ''; ?>"; 

    if (customerId) {
        // Lấy danh sách ID sản phẩm từ LocalStorage
        var wishlistIds = JSON.parse(localStorage.getItem('wishlist_' + customerId)) || [];

        if (wishlistIds.length > 0) {
            // Truy vấn các sản phẩm từ cơ sở dữ liệu qua Ajax
            fetch('api/get-products-by-ids', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ product_ids: wishlistIds })
            })
            .then(response => response.json())
            .then(products => {
                let wishlistHtml = '';
                products.forEach(product => {
                    wishlistHtml += `
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <div class="pro-img">
                                    <a href="{{ URL::to('/product-detail') }}/${product.product_id}">
                                        <img class="primary-img" src="{{ asset('uploads/product') }}/${product.product_image}" alt="${product.product_name}">
                                    </a>
                                </div>
                                <div class="pro-content text-center">
                                    <h4><a href="{{ URL::to('/product-detail') }}/${product.product_id}">${product.product_name}</a></h4>
                                    <p class="price">
                                        <span>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.product_price)}</span>
                                    </p>
                                    <div class="action-links2">
                                        <a data-bs-toggle="tooltip" title="Add to Cart" href="{{ URL::to('/product-detail') }}/${product.product_id}">Xem Thêm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                document.getElementById('wishlist-container').innerHTML = wishlistHtml;
            })
            .catch(error => console.error('Error fetching products:', error));
        } else {
            document.getElementById('wishlist-container').innerHTML = "<p>Không có sản phẩm nào trong danh sách yêu thích.</p>";
        }
    } else {
        document.getElementById('wishlist-container').innerHTML = "<p>Vui lòng đăng nhập để xem danh sách yêu thích.</p>";
    }
</script>

@endsection
