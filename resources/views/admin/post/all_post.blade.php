@extends('admin_layout')
@section('admin_content')
<style>
    table th, table td {
        white-space: normal; /* Cho phép dòng mới */
        word-wrap: break-word; /* Tự động xuống dòng khi cần */
        max-width: 200px; /* Giới hạn chiều rộng của cột */
        overflow-wrap: break-word; /* Tách từ dài khi cần thiết */
    }

    table {
        table-layout: fixed; /* Cố định chiều rộng của bảng */
        width: 100%; /* Đảm bảo bảng chiếm hết chiều rộng */
    }
</style>



<div class="card-header d-flex justify-content-center align-items-center">
    <div class="header-title text-center">
        <h4 class="card-title" style="color: orange; margin-bottom: 30px;">Liệt kê bài viết</h4>
    </div>
</div>

<div class="card-body px-0">
    <div class="table-responsive">
        <!-- Hiển thị thông báo -->
        <h5 class="card-title" style="color: green; margin-top: 20px; margin-bottom: 30px;">
            @if (Session::has('message'))
                <span style="color: green;">{{ Session::get('message') }}</span>
                @php
                    Session::forget('message');
                @endphp
            @endif
        </h5>

        <!-- Bảng hiển thị bài viết -->
        <table id="product-list-table" class="table table-striped" role="grid" data-toggle="data-table">         
            <thead>
                <tr>

                    <th >Tiêu Đề</th>
                    <th>Mô Tả</th>
                    <th>Tác Giả</th>
                    <th style="width: 100px;">
                        Trạng Thái
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $key => $post)
                    <tr>

                        <td>{{ $post->post_title }}</td>
                        <td>{{ $post->post_desc }}</td> 
                        <td>{{ $post->post_author }}</td>
                        <td style="text-align: center;">
                            @if ($post->post_status == 1)
                                <a href="{{ URL::to('/unactive-post/'.$post->post_id) }}">
                                    <span class="fa-thumb-styling fa-solid fa-circle-check" style="color: green; font-size: 2em;"></span>
                                </a>
                            @else
                                <a href="{{ URL::to('/active-post/'.$post->post_id) }}">
                                    <span class="fa-thumb-styling fa-solid fa-circle-xmark" style="color: red; font-size: 2em;"></span>
                                </a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('edit-post', $post->post_id) }}" class="btn btn-warning">Sửa</a>
                            <a href="{{ route('delete-post', $post->post_id) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
