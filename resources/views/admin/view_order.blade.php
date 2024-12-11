@extends('admin_layout')
@section('admin_content')

<div class="card-header d-flex justify-content-center align-items-center">
    <div class="header-title text-center">
        <h4 class="card-title" style="color: orange; ">Thông Tin Khách Hàng</h4>
    </div>
</div>

<div class="card-body px-0">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="ligth">
                    <th>Tên khách hàng</th>
                    <th>SĐT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_by_id as $order)
                <tr>
                    <td>{{$order->customer_name}}</td>
                    <td>{{$order->customer_phone}}</td>
                </tr>
                @break
                @endforeach
            </tbody>
        </table>
        <hr>
        <hr>
    </div>
</div>

<div class="card-header d-flex justify-content-center align-items-center">
    <div class="header-title text-center">
        <h4 class="card-title" style="color: orange; ">Thông Tin Vận Chuyển</h4>
    </div>
</div>

<div class="card-body px-0">
    <div class="table-responsive">
        <table id="product-list-table" class="table table-striped" role="grid" data-toggle="data-table">
            <thead>
                <tr class="ligth">
                    <th>Tên khách hàng</th>                
                    <th>Địa chỉ</th>
                    <th>SĐT</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($order_by_id as $order)
                <tr>
                    <td>{{$order->shipping_name}}</td>
                    <td>{{$order->shipping_address}}</td>
                    <td>{{$order->shipping_phone}}</td>
                </tr>
                @break
                @endforeach

            </tbody>
        </table>
        <hr>
        <hr>
    </div>
</div>

<div class="card-header d-flex justify-content-center align-items-center">
    <div class="header-title text-center">
        <h4 class="card-title" style="color: orange; ">Chi Tiết Đơn Hàng</h4>
    </div>
</div>

<div class="card-body px-0">
    <div class="table-responsive">
        <table id="order-list-table-2" class="table table-striped" role="grid" data-toggle="data-table" data-language='{
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
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng giá tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_by_id as $key => $order)
                <tr>
                    <td>{{$order->product_name}}</td>
                    <td>{{$order->product_sales_qty}}</td>
                    <td>{{ number_format($order->product_price)}} VND</td>
                    <td>{{ number_format($order->product_price * $order->product_sales_qty) }} VND</td>

                </tr>
               
                @endforeach
            </tbody>
        </table>
        <script>
            $(document).ready(function () {
                $('#order-list-table').DataTable();
            });
        </script>
    </div>
</div>

@endsection
