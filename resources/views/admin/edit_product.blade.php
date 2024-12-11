@extends('admin_layout')
@section('admin_content')
<div class="card-header d-flex justify-content-center align-items-center">
  <div class="header-title text-center">
    <h4 class="card-title" style="color: orange;">Cập nhật sản phẩm</h4>
  </div>
</div>

<div class="card-body px-5">
  <h5 class="card-title" style="color: green; margin-top: 20px; margin-bottom: 30px;">
    @if(Session::has('message'))
      <span>{!! Session::get('message') !!}</span>
      {{ Session::put('message', null) }}
    @endif
  </h5>

  @if($edit_product)
    <form role="form" action="{{ URL::to('/update-product/'.$edit_product->product_id) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      
      <div class="form-group row">
        <label for="product_name" class="col-sm-2 col-form-label">Tên sản phẩm</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="product_name" id="product_name" value="{{ $edit_product->product_name }}" placeholder="Nhập tên sản phẩm">
        </div>
      </div>

      <div class="form-group row">
        <label for="product_cate" class="col-sm-2 col-form-label">Danh mục sản phẩm</label>
        <div class="col-sm-10">
          <select class="form-control" name="product_cate" id="product_cate">
            @foreach($cate_product as $cate)
              <option value="{{ $cate->category_id }}" {{ $cate->category_id == $edit_product->category_id ? 'selected' : '' }}>
                {{ $cate->category_name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="product_content" class="col-sm-2 col-form-label">Nội dung sản phẩm</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="product_content" id="product_content" rows="7" placeholder="Mô tả chi tiết sản phẩm">{{ $edit_product->product_content }}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="product_desc" class="col-sm-2 col-form-label">Mô tả sản phẩm</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="product_desc" id="product_desc" rows="7" placeholder="Mô tả ngắn về sản phẩm">{{ $edit_product->product_desc }}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="product_price" class="col-sm-2 col-form-label">Giá sản phẩm</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" name="product_price" id="product_price" value="{{ $edit_product->product_price }}" placeholder="Nhập giá sản phẩm">
        </div>
      </div>

      <div class="form-group row">
        <label for="product_quantity" class="col-sm-2 col-form-label">Số lượng sản phẩm</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" name="product_quantity" id="product_quantity" value="{{ $edit_product->product_quantity }}" placeholder="Nhập số lượng sản phẩm">
        </div>
      </div>

      <div class="form-group row">
        <label for="product_image" class="col-sm-2 col-form-label">Hình ảnh sản phẩm</label>
        <div class="col-sm-10">
          <input type="file" class="form-control" name="product_image" id="product_image">
        </div>
        <br><br>
        <div class="col-sm-10">
          <img src="{{ asset('uploads/product/'.$edit_product->product_image) }}" height="150" width="200" alt="Hình ảnh sản phẩm">
        </div>
      </div>

      <button type="submit" name="update_product" class="btn btn-primary mx-auto d-block" style="margin-top: 100px; background-color:#FFD329; color: black; transition: background-color 0.3s;">Cập nhật sản phẩm</button>
    </form>
  @else
    <p>Sản phẩm không tồn tại hoặc không được tìm thấy.</p>
  @endif
</div>
@endsection
