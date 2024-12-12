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

        .single-post {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #eaeaea;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .single-post .post-thumbnail {
            flex: 0 0 150px; /* Chiều rộng cố định cho hình ảnh */
            margin-right: 20px;
        }

        .single-post .post-thumbnail img {
            width: 100%;
            border-radius: 5px;
        }

        .single-post .post-content {
            flex: 1; /* Để nội dung chiếm phần còn lại */
        }

        .single-post .post-content h3 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #333;
        }

        .single-post .post-content p {
            margin-bottom: 15px;
            color: #666;
        }

        .single-post .post-content .btn {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 15px;
            border-radius: 3px;
        }

        .single-post .post-content .btn:hover {
            background-color: #0056b3;
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

    <div class="best-seller">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content categorie-list">
                        <div id="grid-view" class="tab-pane fade show active mt-40">

                            @foreach($posts as $post)
                                <div class="single-post">
                                    <div class="post-thumbnail">
                                        <img src="{{ asset('uploads/post/'.$post->post_thumbnail) }}" alt="{{ $post->post_title }}">
                                    </div>
                                    <div class="post-content">
                                        <h3>{{ $post->post_title }}</h3>
                                        <p>{{ Str::limit($post->post_desc, 150) }}</p>
                                        <a href="{{ route('post-detail', $post->post_id) }}" >Xem Chi Tiết</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End -->
@endsection
