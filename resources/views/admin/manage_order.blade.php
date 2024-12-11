@extends('admin_layout')
@section('admin_content')

<div class="card-header d-flex justify-content-center align-items-center">
    <div class="header-title text-center" >
      <h4 class="card-title" style="color: orange; margin-bottom: 30px;">Liệt kê đơn hàng</h4>
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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#success-message').fadeOut('slow');
                $('#error-message').fadeOut('slow');
            }, 500);  
        });
    </script>
    
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
                    <th>Tên khách hàng</th>
                    <th>Tổng giá tiền</th>
                    <th>Tình trạng</th>
                    <th>Thanh Toán</th>
                    <th></th>
                    <th>Ngày thêm</th>

                </tr>
            </thead>
            <tbody>
@foreach ($all_order as $key => $order )
                <tr>
                    <td>{{$order->customer->customer_name}}</td>
                    <td style="font-size: 14px; max-width: 45px; white-space: normal;">{{ number_format($order->order_total) }} VND</td>

                    <td>
                      <form action="{{ URL::to('status-order/'.$order->order_id)}}" method="POST" id="status-form-{{ $order->order_id }}">
                          @csrf
                          <select name="order_status" class="form-control" onchange="confirmStatusChange(this, {{ $order->order_id }})">
                              <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Đang xử lý</option>
                              <option value="packaged" {{ $order->order_status == 'packaged' ? 'selected' : '' }}>Đã đóng gói</option>
                              <option value="shipping" {{ $order->order_status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                              <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                              <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Hủy</option>
                          </select>
                      </form>
                  </td>
                  
                  <script>
                      function confirmStatusChange(selectElement, orderId) {
                          var newStatus = selectElement.value;
                          var message = '';
                  
                          if (newStatus == 'pending') {
                              message = 'Bạn có chắc chắn muốn đặt trạng thái là "Đang xử lý"?';
                          } else if (newStatus == 'packaged') {
                              message = 'Bạn có chắc chắn muốn đặt trạng thái là "Đã đóng gói"?';
                          } else if (newStatus == 'shipping') {
                              message = 'Bạn có chắc chắn muốn đặt trạng thái là "Đang giao"?';
                          } else if (newStatus == 'completed') {
                              message = 'Bạn có chắc chắn muốn đặt trạng thái là "Hoàn thành"?';
                          } else if (newStatus == 'cancelled') {
                              message = 'Bạn có chắc chắn muốn hủy đơn hàng này?';
                          }
                  
                          if (confirm(message)) {
                              document.getElementById('status-form-' + orderId).submit();
                          } else {
                              selectElement.value = selectElement.options[selectElement.selectedIndex].value;
                          }
                      }
                  </script>
                  
                  
                  <td>

                                            {{-- Hiển thị phương thức thanh toán --}}
                                            <p>
                                              @if ($order->payment->payment_menthod == 1)
                                              Thanh toán MOMO
                                              @elseif ($order->payment->payment_menthod == 2)
                                                  Thanh toán khi nhận hàng
                                              @else
                                                  Phương thức thanh toán khác
                                              @endif
                                          </p> 
                    @if ($order->payment)
                        <form action="{{ URL::to('status-payment/'.$order->order_id)}}" method="POST" id="payment-status-form-{{ $order->order_id }}">
                            @csrf
                            <select name="payment_status" class="form-control" onchange="this.form.submit()">
                                <option value="0" {{ $order->payment->payment_status == 0 ? 'selected' : '' }}>Chưa thanh toán</option>
                                <option value="1" {{ $order->payment->payment_status == 1 ? 'selected' : '' }}>Đã thanh toán</option>
                            </select>
                        </form>
                

                    @endif
                </td>
                
                
                

                    
                        
                    <td>
                        <div class="flex align-items-center list-user-action">
                            <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ URL::to('view-order/'.$order->order_id)}}">
                                <span class="btn-inner">
                                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                        </svg>                                    
                                </span>
                            </a>
                            
                            {{-- <a onclick="return confirm('Bạn muốn xóa danh mục chứ?')" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{ URL::to('delete-order/'.$order->order_id)}}">
                                <span class="btn-inner">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                        <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a> --}}
                        </div>
                    </td>
                    <td></td>

                </tr>
@endforeach               
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
              $('#order-list-table').DataTable();
            });
          </script>    
</div>
</div>

@endsection
