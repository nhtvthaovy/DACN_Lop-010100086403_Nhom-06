@extends('admin_layout')

@Section('admin_content')
<div class="card-header d-flex justify-content-center align-items-center">
  <div class="header-title text-center">
    <h4 class="card-title" style="color: orange;">Cập nhật danh mục sản phẩm</h4>
    <h5 class="card-title" style="color: green; margin-top: 20px; margin-bottom: 30px;">
      <div id="message-container"></div>
    </h5>
  </div>
</div>

<div class="card-body px-5">
  @if($edit_category_product)
  <form id="update-category-form">
      {{ csrf_field() }}
      <div class="form-group row">
          <label for="category_product_name" class="col-sm-2 col-form-label">Tên danh mục</label>
          <div class="col-sm-10">
              <input type="text" value="{{ $edit_category_product->category_name }}" class="form-control" name="category_product_name" id="category_product_name">
          </div>
      </div>        

      <div class="form-group row">
          <label for="category_product_desc" class="col-sm-2 col-form-label">Mô tả danh mục</label>
          <div class="col-sm-10">
              <textarea class="form-control" name="category_product_desc" id="category_product_desc" rows="7">{{ $edit_category_product->category_desc }}</textarea>
          </div>
      </div>

      <div class="form-group row">
          <label for="category_product_status" class="col-sm-2 col-form-label">Hiển thị</label>
          <div class="col-sm-10">
              <select class="form-control" name="category_product_status" id="category_product_status">
                  <option value="0" {{ $edit_category_product->category_status == 0 ? 'selected' : '' }}>Ẩn</option>
                  <option value="1" {{ $edit_category_product->category_status == 1 ? 'selected' : '' }}>Hiện</option>
              </select>
          </div>
      </div>

      <button type="submit" class="btn btn-primary mx-auto d-block" style="margin-top: 100px; background-color:#FFD329; color: black; transition: background-color 0.3s;">Cập nhật danh mục</button>
  </form>
  @endif
</div>

<script>
  document.getElementById('update-category-form').onsubmit = function(e) {
    e.preventDefault(); 
    const formData = new FormData(this);

    fetch("{{ url('/api/update-category-product/'.$edit_category_product->category_id) }}", {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': formData.get('_token')
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      document.getElementById('message-container').innerHTML = 
        `<div class="alert alert-success">${data.message}</div>`;
    })
    .catch(error => {
      document.getElementById('message-container').innerHTML = 
        `<div class="alert alert-danger">Đã xảy ra lỗi, vui lòng thử lại.</div>`;
    });
  };
</script>

@endsection
