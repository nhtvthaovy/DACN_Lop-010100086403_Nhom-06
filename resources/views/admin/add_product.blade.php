@extends('admin_layout')
@section('admin_content')
<div class="card-header d-flex justify-content-center align-items-center">
  <div class="header-title text-center" >
    <h4 class="card-title" style="color: orange;">Thêm sản phẩm</h4>
  </div>
</div>
<div class="card-body px-5">
  <h5 class="card-title" style="margin-top: 20px; margin-bottom: 30px;">
    <?php
      $message = Session::get('message');
      if ($message) {
        echo $message;
        Session::put('message', null);
      }
    ?>
    
  </h5>

    <form role="form" action="{{ URL::to('/save-product')}}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          {{ csrf_field()}}
    <div class="form-group row">
    <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Tên sản phẩm</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="product_name" id="exampleFormControlInput1" placeholder="">
    </div>
    </div>
    <div class="form-group row">
      <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Danh mục sản phẩm</label>
      <div class="col-sm-10">
          <select class="form-control" name="product_cate" id="exampleFormControlSelect1">
              @foreach($cate_product as $key => $cate)
                  <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
              @endforeach
          </select>    
      </div>
  </div>
  <div class="form-group row">
    <label for="exampleFormControlInput2" class="col-sm-2 col-form-label">Giá sản phẩm</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="product_price" id="exampleFormControlInput2" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleFormControlInput4" class="col-sm-2 col-form-label">Số lượng sản phẩm</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="product_quantity" id="exampleFormControlInput4" placeholder="">
    </div>
  </div>   
  <div class="form-group row">
    <label for="exampleFormControlInput3" class="col-sm-2 col-form-label">Hình ảnh sản phẩm</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="product_image" id="exampleFormControlInput3" >
    </div>
  </div>     

  <div class="form-group row">
    <label for="exampleFormControlTextarea2" class="col-sm-2 col-form-label">Nội dung sản phẩm</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="product_content" id="exampleFormControlTextarea2ck2" prows="7"></textarea>
    </div>
  </div>

  <div class="form-group row">
    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Mô tả sản phẩm</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="product_desc" id="exampleFormControlTextarea1ck1" prows="7"></textarea>
    </div>
  </div>
  
    
  <div class="form-group row">
    <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">Hiển thị</label>
    <div class="col-sm-10">
      <select class="form-control" name="product_status" id="exampleFormControlSelect2">
        <option value="0">Ẩn</option>
        <option value="1">Hiện</option>
      </select>    
    </div>
  </div> 
  
  <button type="submit" name="add_product" class="btn btn-primary mx-auto d-block" style="margin-top: 100px; background-color:#68D651; color: black ;transition: background-color 0.3s;">Thêm sản phẩm</button>
  </form>
  <br></br>







  <script>
    function validateForm() {
        // Kiểm tra trường tên sản phẩm
        var productName = document.getElementById("exampleFormControlInput1").value;
        if (productName.trim() === "") {
            alert("Vui lòng nhập tên sản phẩm.");
            return false;
        }

        var productCate = document.getElementById("exampleFormControlSelect1").value;
        if (productCate === "0") {
            alert("Vui lòng chọn danh mục sản phẩm.");
            return false;
        }

        // var productDesc = document.getElementById("exampleFormControlTextarea1ck1").value;
        // if (productDesc.trim() === "") {
        //     alert("Vui lòng nhập mô tả sản phẩm.");
        //     return false;
        // }

        // var productContent = document.getElementById("exampleFormControlTextarea2ck2").value;
        // if (productContent.trim() === "") {
        //     alert("Vui lòng nhập nội dung sản phẩm.");
        //     return false;
        // }

        var productPrice = document.getElementById("exampleFormControlInput2").value;
        if (productPrice.trim() === "") {
            alert("Vui lòng nhập giá sản phẩm.");
            return false;
        }

        var productImage = document.getElementById("exampleFormControlInput3").value;
        if (productImage.trim() === "") {
            alert("Vui lòng chọn hình ảnh sản phẩm.");
            return false;
        }

        var productQty = document.getElementById("exampleFormControlInput4").value;
        if (productImage.trim() === "") {
            alert("Vui lòng nhập số lượng sản phẩm.");
            return false;
        }

        return true;
    }
</script>

</div>

@endsection