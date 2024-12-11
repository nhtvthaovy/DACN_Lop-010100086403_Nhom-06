@extends('admin_layout')
@Section('admin_content')
<div class="card-header d-flex justify-content-center align-items-center">
  <div class="header-title text-center">
    <h4 class="card-title" style="color: orange;">Thêm danh mục sản phẩm</h4>
  </div>
</div>

<div class="card-body px-5">
  <h5 class="card-title" style="margin-top: 20px; margin-bottom: 30px;">
    <div id="message-container"></div>
  </h5>

  <form id="category-form" method="POST">
    {{ csrf_field() }}
    <div class="form-group row">
      <label for="category_product_name" class="col-sm-2 col-form-label">Tên danh mục</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="category_product_name" id="category_product_name" placeholder="">
      </div>
    </div>

    <div class="form-group row">
      <label for="category_product_desc" class="col-sm-2 col-form-label">Mô tả danh mục</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="category_product_desc" id="category_product_desc" rows="7"></textarea>
      </div>
    </div>

    <div class="form-group row">
      <label for="category_product_status" class="col-sm-2 col-form-label">Hiển thị</label>
      <div class="col-sm-10">
        <select class="form-control" name="category_product_status" id="category_product_status">
          <option value="0">Ẩn</option>
          <option value="1">Hiện</option>
        </select>
      </div>
    </div>

    <button type="submit" class="btn btn-primary mx-auto d-block" style="margin-top: 100px; background-color:#68D651; color: black; transition: background-color 0.3s;">Thêm danh mục</button>
  </form>

  <br>
  <hr>

  <form role="form" action="{{ URL::to('/import-category-product')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Tải lên file Excel</label>
        <div class="col-sm-10">
            <input type="file" class="form-control-file" name="category_excel_file" id="exampleFormControlFile1" accept=".xls, .xlsx">
        </div>
    </div>
    <button type="submit" name="import_category_product" class="btn btn-primary mx-auto d-block" style="background-color:#68D651; color: black ;transition: background-color 0.3s;">Import Danh Mục</button>
  </form>

  <script>

    function validateForm() {
      var productName = document.getElementById("category_product_name").value;
      if (productName.trim() === "") {
        alert("Vui lòng nhập tên danh mục.");
        return false;
      }
      return true;
    }
  
    document.getElementById('category-form').onsubmit = function(e) {
      e.preventDefault();
  

      if (!validateForm()) {
        return;
      }
  
      var formData = new FormData(this);
  

      fetch("{{ URL::to('api/add-category-product') }}", {
        method: "POST",
        headers: {
          "Accept": "application/json",
          "X-CSRF-TOKEN": formData.get('_token')
        },
        body: formData
      })
      .then(response => response.json())
      .then(data => {

        if (data.message) {
          document.getElementById("message-container").innerHTML = "<div class='alert alert-success'>" + data.message + "</div>";
        }
      })
      .catch(error => {

        document.getElementById("message-container").innerHTML = "<div class='alert alert-danger'>Đã xảy ra lỗi, vui lòng thử lại.</div>";
      });
    };
  </script>
  
</div>
@endsection









