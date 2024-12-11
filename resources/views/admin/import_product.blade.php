@extends('admin_layout')

@section('admin_content')
<div class="card-header d-flex justify-content-center align-items-center">
  <div class="header-title text-center">
    <h4 class="card-title" style="color: orange;">Import sản phẩm</h4>
  </div>
</div>

<div class="card-body px-5">
  <!-- Tab Nav -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="images-tab" data-bs-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true">Ảnh sản phẩm</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="add-product-tab" data-bs-toggle="tab" href="#add-product" role="tab" aria-controls="add-product" aria-selected="false">Thêm sản phẩm</a>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content mt-3" id="myTabContent">
    <!-- Tab: Ảnh sản phẩm -->
    <div class="tab-pane fade show active" id="images" role="tabpanel" aria-labelledby="images-tab">
      <h5 class="card-title" style="margin-top: 20px; margin-bottom: 30px;">
        <?php
        $message = Session::get('message');
        
        if ($message) {
            echo $message;
            Session::put('message', null);
        }
    ?>

    @if (session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif
      </h5>

      <form id="import-product-form" role="form" action="{{ URL::to('/add-img') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group row">
          <label for="product_name" class="col-sm-2 col-form-label">Tên sản phẩm</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Nhập tên sản phẩm" value="{{ old('product_name') }}">
            <small id="product_name_error" class="text-danger" style="display: none;">Tên sản phẩm là bắt buộc.</small>
          </div>
        </div>

        <div class="form-group row">
          <label for="product_image" class="col-sm-2 col-form-label">Hình ảnh sản phẩm</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" name="product_image" id="product_image">
          </div>
        </div>     

        <button type="submit" name="product_image" class="btn btn-primary mx-auto d-block" style="background-color:#68D651; color: black;transition: background-color 0.3s;">Thêm Ảnh</button>
      </form>



            <!-- Hiển thị danh sách ảnh hiện có -->
<table id="product-list-table" class="table table-striped" role="grid" data-toggle="data-table"> 
  <thead>
    <tr class="ligth">
      <th>Tên ảnh</th>
      <th>Ảnh</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($images as $image)
      <tr>
        <td>{{ basename($image) }}</td>
        <td><img src="{{ asset('uploads/product/' . basename($image)) }}" alt="Product Image" width="100"></td>
        <td>
          <div class="flex align-items-center list-user-action">
            <!-- Form xóa ảnh -->
            <form action="{{ route('delete.image', basename($image)) }}" method="POST" style="display:inline;">
              @csrf
              @method('POST')
              <button type="submit" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                <span class="btn-inner">
                  <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </span>
              </button>
            </form>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

    </div>

    <!-- Tab: Thêm sản phẩm -->
    <div class="tab-pane fade" id="add-product" role="tabpanel" aria-labelledby="add-product-tab">
      <h5 class="card-title" style="margin-top: 20px; margin-bottom: 30px;">Import sản phẩm</h5>
      <form role="form" action="{{ URL::to('/import-product')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Tải lên file Excel</label>
            <div class="col-sm-10">
                <input type="file" class="form-control-file" name="product_excel" id="exampleFormControlFile1" accept=".xls, .xlsx">
            </div>
        </div>
        <button type="submit" name="product_excel" class="btn btn-primary mx-auto d-block" style="background-color:#68D651; color: black ;transition: background-color 0.3s;">Import Sản Phẩm</button>
      </form>


      
    </div>
  </div>
</div>

<script>
  // Kiểm tra khi form được submit
  document.getElementById('import-product-form').addEventListener('submit', function(e) {
    var productName = document.getElementById('product_name').value;
    var errorMessage = document.getElementById('product_name_error');
    
    // Kiểm tra xem người dùng đã nhập tên sản phẩm hay chưa
    if (productName.trim() === '') {
      e.preventDefault(); // Ngừng gửi form nếu chưa nhập tên sản phẩm
      errorMessage.style.display = 'block'; // Hiển thị thông báo lỗi
    } else {
      errorMessage.style.display = 'none'; // Ẩn thông báo lỗi nếu đã nhập tên sản phẩm
    }
  });
</script>
@endsection
