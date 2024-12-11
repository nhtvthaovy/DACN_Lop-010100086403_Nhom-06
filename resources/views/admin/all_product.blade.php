@extends('admin_layout')
@section('admin_content')

<div class="card-header d-flex justify-content-center align-items-center">
    <div class="header-title text-center" >
      <h4 class="card-title" style="color: orange; margin-bottom: 30px;">Liệt kê sản phẩm</h4>
    </div>
</div>
<div class="card-body px-0">
        <h5 class="card-title" style="color: green; margin-top: 20px; margin-bottom: 30px;">
            <?php
              $message = Session::get('message');
              
              if ($message) {
                echo $message;
                Session::put('message', null);
              }
            ?>
        </h5>
        <div class="table-responsive">

            <a href="{{ url('export-products') }}" class="btn btn-success" style="margin-bottom: 20px;">Xuất Excel</a>

        <table id="product-list-table" class="table table-striped" role="grid" data-toggle="data-table" data-language='{
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Hiển thị _MENU_ mục",
            "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
            "sInfo": "",
            "sInfoEmpty": "",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Tìm:",
            "sUrl": "",
            "oPaginate": {
              "sFirst": "",
              "sPrevious": "<",
              "sNext": ">",
              "sLast": ""
            }
          }'>         
          <thead>
                <tr class="ligth">
                    <th style="font-size: 14px;">Sản phẩm</th>
                    <th style="font-size: 14px;">Danh mục</th>
                    <th style="font-size: 14px;">Mô tả</th>
                    <th style="font-size: 14px;">Nội dung</th>
                    <th style="max-width: 45px; font-size: 14px;">Giá</th>
                    <th style="font-size: 14px;">Ảnh</th>
                    <th style="font-size: 14px;">Hiển thị</th>
                    <th style="font-size: 14px;">Số lượng</th>
                    <th style="font-size: 14px;">Đã bán</th>
                    <th style="font-size: 14px;"></th>
                    <th style="font-size: 14px;">Ngày thêm</th>
                    
                    


                </tr>
            </thead>
            <tbody>
                @foreach ($all_product as $key => $pro )
                    <tr>
                        <td>{{$pro->product_name}}</td>
                        <td>{{$pro->category->category_name}}</td>

                            <td>
                                {{ Str::limit(strip_tags($pro->product_desc), 13) }}

                                <a href="#" data-toggle="modal" data-target="#descModal{{ $pro->product_id }}">...</a>
                            </td>
                        
                            <td>
                                {{ Str::limit($pro->product_content, 13) }}
                                <a href="#" data-toggle="modal" data-target="#contentModal{{ $pro->product_id }}">...</a>
                            </td>

                            <!-- Modal for Description -->
<div class="modal fade" id="descModal{{ $pro->product_id }}" tabindex="-1" aria-labelledby="descModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Tăng kích thước modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descModalLabel">Mô tả sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto; max-width: 600px;">
                {!! $pro->product_desc !!}
            </div>
        </div>
    </div>
</div>

<!-- Modal for Content -->
<div class="modal fade" id="contentModal{{ $pro->product_id }}" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Tăng kích thước modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentModalLabel">Nội dung sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto; max-width: 600px;">
                {{ $pro->product_content }}
            </div>
        </div>
    </div>
</div>

                            
                        
                        
                        <td style="font-size: 15px; max-width: 45px; white-space: normal;">{{ number_format($pro->product_price) }} VND</td>
                        <td><img src="{{ asset('uploads/product/' . $pro->product_image) }}" height="60" width="70"></td>


                    <td style="text-align: center;">
                        <?php
                        
                        if ($pro->product_status == 1) {
                           ?>
                           <a href="{{ URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa-solid fa-circle-check" style="color: green;font-size: 2em;" ></span></a>
                        <?php        
                        } else {
                        ?>                                                        
                        <a href="{{ URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa-solid fa-circle-xmark" style="color: red;font-size: 2em;" ></span></a>
                        <?php      
                                }
                        ?>
                    
                    </td>
                    
                    <td>{{$pro->product_quantity}}</td>
                    <td>{{$pro->product_sold}}</td>
                    <td>
                        <div class="flex align-items-center list-user-action">
                            
                            <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ URL::to('edit-product/'.$pro->product_id)}}">
                                <span class="btn-inner">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                            <a onclick="return confirm('Bạn muốn xóa sản phẩm ' + '{{ $pro->product_name }}' + ' chứ?')" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{ URL::to('delete-product/'.$pro->product_id)}}">
                                <span class="btn-inner">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                        <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
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
