@extends('admin_layout')
@section('admin_content')

<div class="card-header d-flex justify-content-center align-items-center">
  <div class="header-title text-center">
    <h4 class="card-title" style="color: orange;">Sửa Bài Viết</h4>
  </div>
</div>

<div class="card-body px-5">
  <!-- Hiển thị thông báo thành công -->
  <h5 class="card-title" style="margin-top: 20px; margin-bottom: 30px;">
    @if(Session::has('message'))
      <span style="color: green;">{{ Session::get('message') }}</span>
      @php
        Session::forget('message');
      @endphp
    @endif
  </h5>

  <!-- Form Sửa Bài Viết -->
  <form action="{{ url('update-post/'.$post->post_id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Tiêu Đề -->
    <div class="form-group">
      <label for="post_title">Tiêu Đề</label>
      <input type="text" name="post_title" id="post_title" class="form-control @error('post_title') is-invalid @enderror" placeholder="Nhập tiêu đề bài viết" value="{{ old('post_title', $post->post_title) }}">
      @error('post_title')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Mô Tả -->
    <div class="form-group">
      <label for="post_desc">Mô Tả</label>
      <textarea name="post_desc" id="post_desc" class="form-control @error('post_desc') is-invalid @enderror" placeholder="Nhập mô tả">{{ old('post_desc', $post->post_desc) }}</textarea>
      @error('post_desc')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Nội Dung -->
    <div class="form-group">
      <label for="post_content">Nội Dung</label>
      <textarea name="post_content" id="post_content" class="form-control @error('post_content') is-invalid @enderror">{{ old('post_content', $post->post_content) }}</textarea>
      @error('post_content')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Tác Giả -->
    <div class="form-group">
      <label for="post_author">Tác Giả</label>
      <input type="text" name="post_author" id="post_author" class="form-control @error('post_author') is-invalid @enderror" placeholder="Nhập tên tác giả" value="{{ old('post_author', $post->post_author) }}">
      @error('post_author')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Ảnh Đại Diện -->
    <div class="form-group">
      <label for="post_thumbnail">Ảnh Đại Diện</label>
      <!-- Hiển thị ảnh cũ nếu có -->
      @if ($post->post_thumbnail)
        <div>
          <img src="{{ asset('uploads/post/'.$post->post_thumbnail) }}" alt="Ảnh cũ" style="width: 100px; height: 100px; object-fit: cover;">
        </div>
      @endif
      <input type="file" name="post_thumbnail" id="post_thumbnail" class="form-control-file @error('post_thumbnail') is-invalid @enderror">
      @error('post_thumbnail')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Trạng Thái -->
    <div class="form-group">
      <label for="post_status">Trạng Thái</label>
      <select name="post_status" id="post_status" class="form-control @error('post_status') is-invalid @enderror">
        <option value="0" {{ old('post_status', $post->post_status) == '0' ? 'selected' : '' }}>Ẩn</option>
        <option value="1" {{ old('post_status', $post->post_status) == '1' ? 'selected' : '' }}>Hiển Thị</option>
      </select>
      @error('post_status')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Nút Lưu -->
    <button type="submit" class="btn btn-primary mx-auto d-block" style="margin-top: 20px; background-color: #68D651; color: black; transition: background-color 0.3s;">Cập Nhật Bài Viết</button>
  </form>
</div>

@endsection
