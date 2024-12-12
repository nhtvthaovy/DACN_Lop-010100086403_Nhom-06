@extends('layout')

@section('content')
<div class="wrapper">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .header-top-area.header-sticky {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333333;
            z-index: 9999;
        }

        .post-detail {
            margin: 50px auto;
            max-width: 100%;
            background-color: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .post-detail img {
            width: 150px; /* Kích thước thu nhỏ của ảnh */
            height: auto;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .post-detail-content {
            padding: 30px;
        }

        .post-detail-title {
            font-size: 32px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 20px;
        }

        .post-detail-meta {
            font-size: 14px;
            color: #999999;
            margin-bottom: 30px;
        }

        .post-detail-meta span {
            margin-right: 20px;
        }

        .post-detail-body {
            font-size: 18px;
            color: #555555;
            line-height: 1.8;
        }

        .btn-back {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 20px;
            background-color: plum;
            color: black;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: pink;
        }
    </style>

        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <h1>Bài Viết</h1>
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">Trang Chủ</a></li>
                                <li><a href="#">Bài Viết</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Breadcrumb End -->

    <div class="post-detail">

        <!-- Nội dung bài viết -->
        <div class="post-detail-content">
            <!-- Tiêu đề -->
            <h1 class="post-detail-title">{{ $post->post_title }}</h1>

            <!-- Thông tin meta -->
            <div class="post-detail-meta">
                <span><strong>Tác giả:</strong> {{ $post->post_author }}</span>
                <span><strong>Ngày đăng:</strong> {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</span>
            </div>

<!-- Ảnh thumbnail -->
<div class="post-detail-thumbnail" style="text-align: center;">
    <img src="{{ asset('uploads/post/'.$post->post_thumbnail) }}" alt="{{ $post->post_title }}" style="width: 100%; max-width: 600px; height: auto; margin-bottom: 20px;">
</div>


            <!-- Nội dung bài viết -->
            <div class="post-detail-body">
                {!! $post->post_content !!}
            </div>

            <!-- Nút quay lại -->
            <a href="{{ url()->previous() }}" class="btn-back">Quay lại</a>
        </div>
    </div>
</div>
@endsection
