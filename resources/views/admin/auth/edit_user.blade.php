@extends('admin_layout')

@section('admin_content')
<div class="card-header d-flex justify-content-center align-items-center">
  <div class="header-title text-center">
    <h4 class="card-title" style="color: orange;">Sửa Người Dùng</h4>
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

  <!-- Form Sửa Người Dùng -->
  <form action="{{ url('update-user/' . $user->admin_id) }}" method="POST">
    @csrf
    @method('POST')

    <!-- Tên Người Dùng -->
    <div class="form-group">
      <label for="admin_name">Tên Người Dùng</label>
      <input type="text" name="admin_name" id="admin_name" class="form-control @error('admin_name') is-invalid @enderror" placeholder="Nhập tên người dùng" value="{{ old('admin_name', $user->admin_name) }}">
      @error('admin_name')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Email -->
    <div class="form-group">
      <label for="admin_email">Email</label>
      <input type="email" name="admin_email" id="admin_email" class="form-control @error('admin_email') is-invalid @enderror" placeholder="Nhập email" value="{{ old('admin_email', $user->admin_email) }}">
      @error('admin_email')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Số Điện Thoại -->
    <div class="form-group">
      <label for="admin_phone">Số Điện Thoại</label>
      <input type="text" name="admin_phone" id="admin_phone" class="form-control @error('admin_phone') is-invalid @enderror" placeholder="Nhập số điện thoại" value="{{ old('admin_phone', $user->admin_phone) }}">
      @error('admin_phone')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Mật Khẩu (chỉ yêu cầu nếu có thay đổi) -->
    <div class="form-group">
      <label for="admin_password">Mật Khẩu (nếu thay đổi)</label>
      <input type="password" name="admin_password" id="admin_password" class="form-control @error('admin_password') is-invalid @enderror" placeholder="Nhập mật khẩu mới">
      @error('admin_password')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <!-- Nút Sửa Người Dùng -->
    <button type="submit" class="btn btn-primary mx-auto d-block" style="margin-top: 20px; background-color:#68D651; color: black; transition: background-color 0.3s;">Sửa Người Dùng</button>
  </form>
</div>
@endsection
