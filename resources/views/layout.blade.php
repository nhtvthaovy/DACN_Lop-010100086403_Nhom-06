<!doctype html>
<html class="no-js" lang="en-US">


<!-- Mirrored from htmldemo.net/nevara/nevara/home-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 18:29:15 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DARWIN</title>
    <meta name="description" content="Default Description">
    <meta name="keywords" content="E-commerce" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/icon/sofa.png')}}">
    <!-- mobile menu css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.min.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css')}}">
    <!-- nivo slider css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/nivo-slider.css')}}">
    <!-- owl carousel css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css')}}">
    <!-- price slider css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css')}}">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css')}}">
    <!-- icon font pack css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/pe-icon-7-stroke.css')}}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <!-- default css  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/default.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('frontend/style.css')}}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}">

    <!-- modernizr js -->
    <script src="{{ asset('frontend/js/vendor/modernizr-3.11.2.min.js')}}"></script>
</head>

<body>
    
    <!-- Wrapper Start -->
    <div class="wrapper home-2">
       <!-- Preloader Start -->
        
        <!-- Preloader End -->
        
       <!-- Header Area Start -->
        <header>
           <div class="container-fluid header-top-area header-sticky">
               <div class="row">
                    <!-- Logo Start -->
                    <div class="col-lg-2 col-5 col-full-xs">
                        <div class="logo">
                            <a class="primary-img" href="{{ URL::to('home') }}"><h3>DARWIN</h3></a>
                            <a class="sticky-logo" href="{{ URL::to('home') }}"><h3 style="color: white">DARWIN</h3></a>
                        </div>
                    </div>
                    <!-- Logo End -->
                    <div class="col-12 xs-device d-none">
                        <ul class="search-form mobile-form">
                            <li>
                                <form action="{{ URL::to('/search') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="search" class="search" name="key_submit" placeholder="...">
                                </form>
                                <i class="pe-7s-search"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- Primary-Menu Start -->
                    <div class="col-lg-7 d-none d-lg-block">
                        <div class="primary-menu">
                            <nav>
                                <ul class="primary-menu-list text-center">
                                    <li><a href="{{ URL::to('home') }}">Trang Chủ</a>                                        
                                    </li>
                                    
                                    <li><a href="{{ URL::to('shop') }}">Cửa Hàng</a>                                       
                                    </li>

                                    <li><a href="{{ URL::to('post') }}">Bài Viết</a>                                       
                                    </li>
                                   
                                    
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Primary-Menu End -->
                    <!-- Header All Shopping Selection Start -->
                    <div class="col-lg-3 col-7 col-full-xs">
                        <div class="main-selection">
                            <ul class="selection-list text-end">
                                <!-- Searcch Box Start -->
                                <li class="hidden-control"><i class="pe-7s-search"></i>
                                    <ul class="search-form ht-dropdown">
                                        <li>
                                            <form id="searchForm" action="{{ URL::to('/search') }}" method="post">
                                                {{ csrf_field() }}
                                                <input name="key_submit" type="search" class="search" placeholder="...">
                                                <!-- Icon -->
                                                <i class="pe-7s-search" id="searchIcon" style="cursor: pointer;"></i>
                                            </form>
                                            
                                            <script>
                                                document.getElementById('searchIcon').addEventListener('click', function() {
                                                    document.getElementById('searchForm').submit();
                                                });
                                            </script>
                                            
                                        </li>
                                    </ul>
                                </li>
                                <!-- Search Box End -->
                                <li><a href="{{ URL::to('wishlist') }}"><i class="pe-7s-like"></i></a></li>
                                <li><a href="{{URL::to('/show-cart')}}"><i class="pe-7s-shopbag"></i></a></li>

                                <!-- Dropdown Currency Selection Start -->
                                <li><i class="pe-7s-config"></i>
                                    <ul class="ht-dropdown currrency">
                                        <li>
                                            <h3>Tài Khoản</h3>
                                            <ul>
                                                <?php
                                                $customer_id = Session::get('customer_id');
                                                if ($customer_id != null) {
                                                    // Nếu có customer_id thì hiển thị "Đăng Xuất"
                                                ?>
                                                
<li><a href="{{ URL::to('account') }}">Tài Khoản</a></li>


<li><a href="{{ URL::to('order') }}">Đơn Hàng</a></li>
                                                    

                                                    <br>
                                                    <hr>
                                                    <li><a href="{{ URL::to('logout-checkout') }}">Đăng Xuất</a></li>
                                                    

                                                <?php
                                                } else {
                                                    // Nếu không có customer_id thì hiển thị "Đăng Nhập"
                                                ?>
                                                    <li><a href="{{ URL::to('login-checkout') }}">Đăng Nhập</a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>
                                
                                <!-- Dropdown Currency Selection End -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header All Shopping Selection End -->
                    <!-- Mobile Menu  Start -->
                    <div class="mobile-menu d-block d-lg-none">
                        <nav>
                            <ul>
                                <li><a href="#">Trang Chủ</a>                                    
                                </li>
                                
                                <li><a href="#">Cửa Hàng</a>                                       
                                </li>

                                <li><a href="#">Bài Viết</a>                                       
                                </li>
                                
                                </li>
                                
                            </ul>
                        </nav>
                    </div>
                    <!-- Mobile Menu  End -->
               </div>
           </div>
        </header>
        <!-- Header Area End -->
        

        @yield('content')

           <!-- Footer Middle Start -->
            <div class="footer-middle">
                <div class="container">
                    <div class="container-footer ptb-100">
                          <div class="row">
                            <!-- Single Footer Start -->
                            <div class="single-footer col-lg-3 col-md-6">
                                <div class="footer-logo">
                                    <h3>DARWIN</h3>
                                </div>
                                <div class="footer-content">
                                    <p>Cá đi bộ.</p>
                                    <h5 class="contact-info mtb-10">Thông tin liên hệ:</h5>
                                    <ul class="footer-list first-content">
                                        <li><i class="pe-7s-map-marker"></i>Địa chỉ</li>
                                        <li><i class="pe-7s-mail"></i>xxx@example.com</li>
                                        <li><i class="pe-7s-call"></i>+00 123 45678</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Single Footer Start -->
                            <!-- Single Footer Start -->
                            <div class="single-footer col-lg-3 col-md-6">
                                <h4 class="footer-title">Thông tin</h4>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li><a href="#">Về chúng tôi</a></li>
                                        <li><a href="#">Thông tin giao hàng</a></li>
                                        <li><a href="#">Chính sách bảo mật</a></li>
                                        <li><a href="#">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Single Footer Start -->
                            <!-- Single Footer Start -->
                            {{-- <div class="single-footer col-lg-3 col-md-6">
                                <h4 class="footer-title">extras</h4>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li><a href="#">brands</a></li>
                                        <li><a href="#">gift certificates</a></li>
                                        <li><a href="#">Affiliate</a></li>
                                        <li><a href="#">Specials</a></li>
                                        <li><a href="#">contact us</a></li>
                                        <li><a href="#">returns</a></li>
                                        <li><a href="#">Map</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                            <!-- Single Footer Start -->
                            <!-- Single Footer Start -->
                            <div class="single-footer col-lg-3 col-md-6">
                                <h4 class="footer-title">TIN</h4>
                                <div class="footer-content subscribe-form">
                                    <p class="mb-25">Đăng ký nhận bản tin của chúng tôi và được giảm giá 10% cho lần mua hàng đầu tiên của bạn</p>
                                    <div class="subscribe-box">
                                        <form action="#">
                                            <input type="text" name="subscribe_email" id="subscribe_email" placeholder="Nhập email của bạn ở đây...">
                                            <input type="submit" class="submit" value="Đăng ký">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Footer Start -->
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Container Footer End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Footer Middle End -->
            <!-- Footer Bottom Start -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="container-footer ptb-30">
                        <div class="row">
                            <div class="col-md-7">
                                {{-- <p class="text-md-start copyright-text">Copyright ©  <a target="_blank" href="#">Nevara</a> All Rights Reserved.</p> --}}
                            </div>
                            <div class="col-md-5">
                                <!-- Footer Social List Start -->
                                <div class="socila-footer">
                                    <ul class="social-footer-list list-inline text-end">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Footer Social List End -->
                            </div>
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Container Footer End -->
                </div>
                 <!-- Container End -->
            </div>
            <!-- Footer Bottom End -->
        </footer>
        <!-- Footer End -->
        <!-- Quick View Content Start -->
        
        <!-- Quick View Content End -->
    </div>
    <!-- Wrapper End -->
    <!-- jquery 3.12.4 -->
    <script src="{{ asset('frontend/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
    <!-- mobile menu js  -->
    <script src="{{ asset('frontend/js/jquery.meanmenu.min.js')}}"></script>
    <!-- scroll-up js -->
    <script src="{{ asset('frontend/js/jquery.scrollUp.js')}}"></script>
    <!-- owl-carousel js -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
    <!-- wow js -->
    <script src="{{ asset('frontend/js/wow.min.js')}}"></script>
    <!-- price slider js -->
    <script src="{{ asset('frontend/js/jquery-ui.min.js')}}"></script>
    <!-- elevateZoom js -->
    <script src="{{ asset('frontend/js/jquery.elevateZoom-3.0.8.min.js')}}"></script>
    <!-- nivo slider js -->
    <script src="{{ asset('frontend/js/jquery.nivo.slider.js')}}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <!-- plugins -->
    <script src="{{ asset('frontend/js/plugins.js')}}"></script>
    <!-- main js -->
    <script src="{{ asset('frontend/js/main.js')}}"></script>


    
    {{-- sweetalert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    url: '{{url('/add-cart')}}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token
                    },
                    success: function(data){
                        console.log('Ajax request successful:', data);
    
                        swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            icon: "success",
                            buttons: {
                                xemtiep: {
                                    text: "Xem tiếp",
                                    value: "xemtiep"
                                },
                                giohang: {
                                    className: "btn-success",
                                    text: "Đi đến giỏ hàng"
                                }
                            }
                        }).then((value) => {
                            if (value === "giohang") {
                                window.location.href = "{{url('/show-cart')}}";
                            } else {
                               
                            }
                        });
                    }
                });
            });
        });
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v21.0"></script>
    


</body>


<!-- Mirrored from htmldemo.net/nevara/nevara/home-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 18:29:16 GMT -->
</html>
