@extends('admin_layout')
@Section('admin_content')

<div class="card-header d-flex justify-content-center align-items-center">
    <div class="header-title text-center" >
      <h4 class="card-title" style="color: orange; margin-bottom: 30px;">Liệt kê danh mục sản phẩm</h4>
    </div>
</div>
<div class="card-body px-0">
    <div class="table-responsive">
        <h5 class="card-title" style="color: green; margin-top: 20px; margin-bottom: 30px;">
            <?php
              $message = Session::get('message');
              
              if ($message) {
                echo $message;
                Session::put('message', null);
              }
            ?>
          </h5>
        <a href="{{ url('export-category') }}" class="btn btn-success" style="margin-bottom: 20px;">Xuất Excel</a>

        <table id="product-list-table" class="table table-striped" role="grid" data-toggle="data-table">         
          <thead>
                <tr class="ligth">
                    <th>Tên danh mục</th>
                    <th>Mô tả danh mục</th>
                    <th>Hiển thị</th>
                    <th></th>
                    <th>Ngày thêm</th>

                </tr>
            </thead>
            <tbody>
@foreach ($all_category_product as $key => $cate_pro )
                <tr>
                    <td>{{$cate_pro->category_name}}</td>
                    <td>
                        <span data-toggle="modal" data-target="#descriptionModal{{ $cate_pro->category_id }}">
                            {{ Str::limit($cate_pro->category_desc, 20, '...') }}
                        </span>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="descriptionModal{{ $cate_pro->category_id }}" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="descriptionModalLabel">Mô tả danh mục {{$cate_pro->category_name}} đầy đủ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $cate_pro->category_desc }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                        <td style="text-align: center;">
                        <?php
                        
                        if ($cate_pro->category_status == 1) {
                           ?>
                           <a href="{{ URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa-solid fa-circle-check" style="color: green;font-size: 2em;" ></span></a>
                        <?php        
                        } else {
                        ?>                                                        
                        <a href="{{ URL::to('/active-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa-solid fa-circle-xmark" style="color: red;font-size: 2em;" ></span></a>
                        <?php      
                                }
                        ?>
                    
                    </td>
                    <td>
                        <div class="flex align-items-center list-user-action">
                            
                            <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ URL::to('edit-category-product/'.$cate_pro->category_id)}}">
                                <span class="btn-inner">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                            <a href="javascript:void(0);" onclick="deleteCategory({{ $cate_pro->category_id }}, '{{ $cate_pro->category_name }}')" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa">
                                <span class="btn-inner">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                        <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                            
                            <script>
function deleteCategory(categoryId, categoryName) {
    if (confirm('Bạn muốn xóa danh mục ' + categoryName + ' chứ?')) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch('api/delete-category-product/' + categoryId, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                _method: 'DELETE'
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Lỗi HTTP: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.message) {
                alert(data.message);
                if (data.message === 'Danh mục sản phẩm đã được xóa thành công!') {
                    window.location.reload();
                }
            }
        })
        .catch(error => {
            alert('Đã xảy ra lỗi khi xóa danh mục! Lỗi: ' + error.message);
            console.error('Error:', error);
        });
    }
}

                            </script>
                            
                            
                        </div>
                    </td>
                    <td></td>

                </tr>
@endforeach               
            </tbody>
        </table>

</div>
</div>
@endsection
