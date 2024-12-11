<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng Ký</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico')}}" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/libs.min.css')}}">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/logik.css?v=1.0.0')}}">
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <div class="signup-robot">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-md-5">
                        <div class="card" style="transform: translate(0px, 25px);">
                            <div class="card-header">
                                <a href="{{ asset('backend/dashboard/index.html')}}" class="navbar-brand d-flex align-items-center justify-content-center">
                                    <!--Logo start-->
                                    <svg width="88" class="iq-logo" viewBox="0 0 88 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 33.0964V2.00584L5 0V33.0964H0Z" fill="#FE9436" />
                                        <path d="M32.4599 13.3035C32.0607 14.1452 32.5455 15.6849 32.5455 15.6849L33.2074 15.1367C33.4419 14.9424 33.8351 14.7486 34.0002 15.0045C34.1533 15.2419 33.8716 15.5141 33.6509 15.6906C33.4232 15.8726 33.1385 16.1252 32.9734 16.3653C32.6511 16.8338 32.4758 17.1587 32.4599 17.7261C32.4246 18.9938 33.4012 19.7673 34.7703 20.0224C36.5859 20.3606 37.5941 18.4065 38.022 17.7261C38.4499 17.0457 38.2578 16.397 38.7066 15.6849C39.133 15.0082 40.1612 14.239 40.1612 14.239C40.1612 14.239 40.6378 13.865 40.9314 13.9839C41.1064 14.0548 41.2483 14.1379 41.2737 14.3241C41.2997 14.516 41.0169 14.7493 41.0169 14.7493C41.0169 14.7493 39.7391 15.4373 39.3055 16.1952C38.997 16.7346 38.8777 17.7261 38.8777 17.7261L38.4498 18.5766C38.4498 18.5766 39.1238 18.7768 39.5623 18.7467C40.0157 18.7155 40.5035 18.4916 40.5891 18.4065C40.8458 18.1515 40.5035 17.8962 41.1881 16.8756C41.8482 15.8915 42.9915 15.6743 43.0706 14.4942C43.1562 13.2185 41.5489 12.6761 41.3592 11.2623C41.1881 9.98666 42.2149 8.79589 42.2149 8.79589C42.2149 8.79589 41.1236 7.96126 40.3324 8.03044C39.6015 8.09434 38.7066 8.96598 38.7066 8.96598C38.7066 8.96598 40.3324 9.81656 40.418 11.2623C40.4716 12.1679 40.061 12.6917 39.4767 13.3886C39.0488 13.8988 37.9364 14.239 37.3374 14.6643C36.8179 15.0331 36.4706 15.2274 36.1395 15.7699C35.9943 16.0077 35.8874 16.3475 35.8168 16.628L35.8163 16.6298C35.7343 16.9555 35.6173 17.4202 35.2838 17.3859C35.0054 17.3573 34.962 16.9752 35.02 16.7014C35.0995 16.3261 35.2414 15.7867 35.4549 15.4297C35.8172 14.8241 36.2061 14.6193 36.7384 14.154C37.6573 13.3507 38.9561 13.5336 39.3055 12.368C39.7483 10.8907 39.3507 10.0356 38.2787 9.56133C37.2843 9.12135 36.3796 9.63111 35.626 10.4118C34.9562 11.1058 34.993 12.5674 35.06 13.2963C35.0856 13.5742 35.0479 13.9554 34.7703 13.9839C34.4404 14.0178 34.3425 13.5466 34.3425 13.215V11.8577C34.3425 11.8577 32.8562 12.4682 32.4599 13.3035Z" fill="#FE9436" />
                                        <path d="M47.2635 20.0225C46.6641 20.082 45.8088 19.5122 45.8088 19.5122C45.8088 19.5122 46.255 18.8187 46.4078 18.3215C46.4857 18.0681 46.5284 17.7324 46.5517 17.4579C46.5794 17.1317 46.5612 16.6641 46.2367 16.6205C45.916 16.5774 45.8623 17.0641 45.85 17.3875C45.8407 17.6304 45.7901 17.9334 45.6377 18.2364C45.2954 18.9168 44.8676 20.1926 43.3273 20.0225C41.6914 19.8418 41.4448 19.3421 41.4448 18.0663C41.4448 16.8756 43.5496 16.5353 43.8407 14.6643C44.1318 12.7933 41.5471 12.2093 42.1293 10.582C42.5174 9.4975 43.1116 8.59081 44.2686 8.54082C46.2367 8.45577 46.9212 10.582 46.9212 10.582C46.9212 10.582 48.1518 10.2315 48.9749 10.7521C49.9162 11.3474 50.0018 12.7082 50.0018 12.7082C50.0018 12.7082 51.2442 12.9805 51.7132 13.5587C52.4833 14.5082 52.141 15.5999 52.141 15.5999L51.3709 15.1747L50.7719 15.0896C50.7719 15.0896 49.865 13.5543 48.8894 13.1335C48.2087 12.8399 47.0068 12.8783 47.0068 12.8783C47.0068 12.8783 46.5232 11.8215 45.98 11.3474C45.6129 11.0272 45.0012 10.7832 44.5751 10.6404C44.2692 10.5379 43.791 10.5165 43.7552 10.8371C43.7132 11.2126 44.2878 11.2968 44.6454 11.4188C44.8974 11.5049 45.1835 11.6245 45.381 11.7727C45.8988 12.1613 46.3223 13.1335 46.3223 13.1335L45.659 13.5392C45.3687 13.7167 45.0049 14.0524 45.2099 14.3241C45.4605 14.6564 45.9773 14.2712 46.3498 14.0855C46.8625 13.83 47.6697 13.5559 48.4615 13.8139C49.7668 14.2392 50.2585 15.9401 50.2585 15.9401C50.2585 15.9401 52.3122 15.9401 52.4833 17.471C52.6074 18.581 51.1997 18.7467 51.1997 18.7467C51.1997 18.7467 50.9617 19.5871 50.5152 19.7673C50.1079 19.9317 49.4028 19.5972 49.4028 19.5972L49.6595 19.0869V18.4065L50.3424 17.8844C50.6193 17.6727 50.9706 17.2476 50.6863 17.0458C50.4485 16.8769 50.1393 17.1346 49.9054 17.3089L49.5739 17.5561L49.307 17.0254C49.1594 16.732 48.7554 16.4517 48.5471 16.7056C48.5438 16.7095 48.5408 16.7137 48.5379 16.7181C48.3531 17.0014 48.6334 17.3646 48.7467 17.6833C48.8269 17.9089 48.8988 18.1794 48.8894 18.4065C48.8524 19.2982 48.157 19.9338 47.2635 20.0225Z" fill="#FE9436" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M70.1034 1.12295L67.7126 2.24589L67.6955 11.1053L67.6784 19.9647H74.285H80.8917L80.7266 19.6788C80.6358 19.5216 80.2211 18.7334 79.8049 17.9275L79.0483 16.462L82.1446 13.3189C83.8476 11.5901 85.3051 10.118 85.3834 10.0475C85.4617 9.97701 85.5258 9.89379 85.5258 9.8625C85.5258 9.83122 84.1969 9.80565 82.5726 9.80565H79.6194L76.129 13.4555C74.2092 15.463 72.6137 17.1154 72.5834 17.1277C72.5531 17.14 72.5207 13.2913 72.5113 8.57506L72.4942 0L70.1034 1.12295ZM59.6142 0.283781C59.0394 0.412687 58.5879 0.673055 58.1572 1.12416C57.0105 2.32522 57.0237 4.06181 58.1884 5.22533C59.3782 6.414 61.2548 6.37895 62.3969 5.14668C62.8516 4.65601 63.0651 4.22563 63.1645 3.5992C63.4867 1.56867 61.6274 -0.167591 59.6142 0.283781ZM17.4717 9.33685C15.0035 9.61471 13.0875 10.5103 11.44 12.1562C9.70535 13.8891 8.6676 16.1031 8.24883 18.9642C8.19125 19.3575 8.14418 19.7434 8.14418 19.822V19.9647H10.5903H13.0363L13.1126 19.477C13.3123 18.2006 13.8916 16.8213 14.6031 15.928C15.6426 14.6229 16.9516 13.9555 18.6503 13.8645C21.9002 13.6905 24.2498 15.8967 24.8781 19.7124L24.9197 19.9647H27.3705H29.8214L29.7931 19.7461C29.3457 16.2892 28.4494 14.1846 26.6179 12.2908C25.1487 10.7717 23.3747 9.8399 21.2363 9.46415C20.323 9.30362 18.3571 9.23721 17.4717 9.33685ZM57.8462 14.8852V19.9647H60.2707H62.6952V14.8852V9.80565H60.2707H57.8462V14.8852ZM8.11414 23.4464C8.33793 25.6952 8.77225 27.3114 9.56499 28.8455C11.0236 31.6682 13.4962 33.4935 16.6299 34.0607C17.4712 34.213 19.6464 34.2708 20.5215 34.164C24.7076 33.6534 27.7584 31.1416 29.1105 27.0924C29.4682 26.0213 29.8299 24.1103 29.8299 23.2916V23.0595H27.4084H24.987L24.9536 23.2782C24.7158 24.8353 24.4064 25.8926 23.9495 26.7085C23.436 27.6256 22.6366 28.4692 21.809 28.9671C20.4897 29.761 18.2639 29.8798 16.7181 29.2389C15.2025 28.6105 14.0219 27.1965 13.4123 25.2797C13.2201 24.6756 12.9932 23.558 12.9932 23.2159V23.0595H10.5344H8.07568L8.11414 23.4464ZM32.4914 23.48C32.7305 25.8961 33.1048 27.3828 33.8675 28.9464C35.1693 31.6153 37.4365 33.4364 40.235 34.0613C40.8759 34.2044 42.7731 34.2659 43.5118 34.1675C45.1874 33.9444 46.5146 33.3172 47.5673 32.2511L48.0303 31.7822L47.9948 33.2573C47.9562 34.8622 47.8967 35.2063 47.5308 35.9434C46.7955 37.4243 45.3157 38.3427 42.8716 38.8349C41.9366 39.0232 40.8015 39.1773 39.8478 39.2453C39.4866 39.2711 39.1911 39.3025 39.1911 39.3152C39.1911 39.3562 41.489 42.8703 41.5721 42.9564C41.7601 43.1511 44.8064 42.6577 46.2537 42.1981C49.6947 41.1055 51.594 39.2337 52.3896 36.1513C52.8189 34.4879 52.8174 34.5136 52.8451 28.5259L52.8704 23.0595H50.442H48.0136V24.9664V26.8733L47.6853 27.3403C46.9782 28.3462 45.8994 29.1308 44.7809 29.4526C44.059 29.6604 42.7724 29.7081 42.0148 29.5554C39.6298 29.0746 38.0095 27.0912 37.4813 24.0064C37.4216 23.6576 37.3728 23.3019 37.3728 23.2159V23.0595H34.9112H32.4498L32.4914 23.48ZM57.8462 28.3745V33.6895H60.2707H62.6952V28.3745V23.0595H60.2707H57.8462V28.3745ZM67.6789 28.3745V33.6895H70.1034H72.5279V28.3745V23.0595H70.1034H67.6789V28.3745ZM77.2422 23.084C77.2422 23.1368 82.6231 33.5751 82.6793 33.6312C82.7129 33.6648 83.8948 33.6834 85.3697 33.6735L88.0002 33.6559L85.2405 28.3577L82.4808 23.0595H79.8615C78.4209 23.0595 77.2422 23.0705 77.2422 23.084Z" fill="black" />
                                    </svg>
                                    <!--logo End-->
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="text-center mb-2">Đăng Ký</h5>

<form action="{{ URL::to('register')}}" method="post">
    {{ csrf_field() }}

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <input type="text" class="form-control" id="full-name" name="admin_name" placeholder="Tên" value="{{ old('admin_name') }}">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="admin_email" placeholder="Email" value="{{ old('admin_email') }}">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <input type="text" class="form-control" id="phone" name="admin_phone" placeholder="SĐT" value="{{ old('admin_phone') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="admin_password" placeholder="Mật Khẩu">
                </div>
            </div>
    
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="password" class="form-control" id="confirm-password" name="admin_password_confirmation" placeholder="Nhập Lại Mật Khẩu">
                </div>
                <span id="password-error" style="color: red; display: none;">Mật khẩu không khớp!</span>
            </div>
    
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" id="customCheck1" name="agree_terms">
                    <label class="form-check-label text-dark" for="customCheck1">Tôi đồng ý với các điều khoản sử dụng</label>
                </div>
            </div>
    
            <div class="text-center my-2">
                <button type="submit" class="btn btn-primary" id="register-btn" disabled>Đăng Ký</button>
            </div>
        </div>
    </form>
    
    <script>
        // Lấy các phần tử trong form
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm-password');
        const checkbox = document.getElementById('customCheck1');
        const registerButton = document.getElementById('register-btn');
        const passwordError = document.getElementById('password-error');
    
        // Hàm kiểm tra và cập nhật trạng thái nút Đăng Ký
        function validateForm() {
            const password = passwordField.value;
            const confirmPassword = confirmPasswordField.value;
    
            // Kiểm tra mật khẩu và mật khẩu xác nhận
            const passwordsMatch = password === confirmPassword;
    
            // Kiểm tra checkbox
            const isChecked = checkbox.checked;
    
            // Hiển thị thông báo lỗi nếu mật khẩu không khớp
            passwordError.style.display = passwordsMatch ? 'none' : 'block';
    
            // Kích hoạt nút Đăng Ký nếu mật khẩu khớp và checkbox được tick
            if (passwordsMatch && isChecked) {
                registerButton.disabled = false;
            } else {
                registerButton.disabled = true;
            }
        }
    
        // Thêm sự kiện lắng nghe thay đổi trên các trường form
        passwordField.addEventListener('input', validateForm);
        confirmPasswordField.addEventListener('input', validateForm);
        checkbox.addEventListener('change', validateForm);
    
        // Gọi lần đầu khi tải trang để cập nhật trạng thái nút
        validateForm();
    </script>

                                <div class="new-account text-center mt-2">
                                    <p class="mb-0 text-dark">Đã Có Tài Khoản <a class="text-secondary text-decoration-underline" href="{{ URL::to('/admin')}}">Đăng Nhập</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="auth-img">
                <div class="signup-bottom-img">
                    <svg width="250" height="250" viewBox="0 0 527 462" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Group">
                            <path id="Vector" d="M449.982 440.777L523 435.655L512.359 304.116L440.211 309.206C429.369 272.355 411.968 238.034 389.212 207.429L438.739 158.961L336.507 67.8955L287.349 115.989C250.74 94.1909 209.68 78.3574 165.642 70.144V4H24.3246V70.144C-31.1582 80.5122 -81.9895 102.904 -125.024 134.196L-178.9 90.5682L-271.527 190.222L-217.182 234.162C-239.837 271.7 -254.896 313.735 -260.485 358.518L-333 363.608L-322.392 495.147L-249.107 489.994C-237.93 526.314 -220.361 560.105 -197.573 590.241L-248.772 640.333L-146.541 731.368L-94.9734 680.963C-59 702.043 -18.7766 717.314 24.2911 725.371V795.263H165.608V725.371C220.054 715.222 270.015 693.486 312.48 663.1L368.833 708.726L461.46 609.073L405.576 563.852C428.499 526.72 443.859 485.122 449.982 440.777ZM94.9998 504.61C32.8912 504.61 -17.4715 457.609 -17.4715 399.647C-17.4715 341.716 32.8578 294.716 94.9998 294.716C157.108 294.716 207.471 341.716 207.471 399.647C207.471 457.578 157.108 504.61 94.9998 504.61Z" fill="#F7F7F7" stroke="#183372" stroke-width="6.384" stroke-miterlimit="10" />
                            <path id="Vector_2" d="M320.046 399.647C320.046 515.634 219.287 609.635 95.0027 609.635C-29.2813 609.635 -130.007 515.634 -130.007 399.647C-130.007 283.661 -29.2813 189.628 95.0027 189.628C219.287 189.628 320.046 283.661 320.046 399.647Z" fill="#EAEFFB" stroke="#183372" stroke-width="6.384" stroke-miterlimit="10" />
                            <path id="Vector_3" d="M207.468 399.616C207.468 457.578 157.105 504.579 94.9967 504.579C32.8881 504.579 -17.4746 457.578 -17.4746 399.616C-17.4746 341.685 32.8547 294.685 94.9967 294.685C157.105 294.685 207.468 341.685 207.468 399.616Z" fill="#F7F7F7" stroke="#183372" stroke-width="6.384" stroke-miterlimit="10" />
                            <path id="Vector_4" d="M95.0017 124.983C251.411 124.983 389.315 242.281 389.315 399.647" stroke="#183372" stroke-width="6.384" stroke-miterlimit="10" />
                        </g>
                    </svg>
                </div>
                <img src="{{ asset('backend/assets/images/auth/03.png')}}" alt="bulp" class="signup-right-img w-25">
            </div>
        </div>
    </div>

    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/libs.min.js')}}"></script>

    <!-- Dashboard Charts JavaScript -->
    <script src="{{ asset('backend/assets/js/charts/dashboard.js')}}"></script>
    <script src="{{ asset('backend/assets/js/charts/apexcharts.js')}}"></script>

    <!-- fslightbox JavaScript -->
    <script src="{{ asset('backend/assets/js/fslightbox.js')}}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js')}}"></script>


</body>

</html>