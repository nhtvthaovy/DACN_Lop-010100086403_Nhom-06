@extends('layout')

@section('content')

<div class="wrapper">
    <style>
                .header-top-area.header-sticky {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333333;
            z-index: 9999;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    
        .btn {
        background-color: #e63946; /* Red background */
        color: white; /* Text color */
        padding: 12px 30px; /* Adjusted padding for better text fitting */
        font-size: 16px; /* Font size */
        border: none; /* Remove border */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        transition: background-color 0.3s ease; /* Smooth transition */
        display: inline-flex; /* Use inline-flex to enable centering */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        text-align: center; /* Center text horizontally */
    }

    .btn:hover {
        background-color: #d62d20; /* Darker red on hover */
    }
    
        .btn-back-home {
            background-color: #2a9d8f; /* Different color for the back button */
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Remove underline */
        }
    
        .btn-back-home:hover {
            background-color: #21867a; /* Darker color on hover */
        }
    </style>


<div class="main-breadcrumb mb-20">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content text-center ptb-70">
                    <h1>CỬA HÀNG</h1>
                    <ul class="breadcrumb-list breadcrumb">
                        <li><a href="#">Trang Chủ</a></li>
                        <li><a href="#">Đơn Hàng</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Customer Information -->
    <div class="card-body px-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="customer-info-table">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>SĐT</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dữ liệu khách hàng sẽ được thêm vào đây -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Shipping Information -->
    <div class="card-header d-flex justify-content-center align-items-center">
        <div class="header-title text-center">
            <h4 class="card-title" style="color: orange;">Thông Tin Vận Chuyển</h4>
        </div>
    </div>

    <div class="card-body px-0">
        <div class="table-responsive">
            <table id="shipping-info-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>SĐT</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dữ liệu vận chuyển sẽ được thêm vào đây -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Order Details -->
    <div class="card-header d-flex justify-content-center align-items-center">
        <div class="header-title text-center">
            <h4 class="card-title" style="color: orange;">Chi Tiết Đơn Hàng</h4>
        </div>
    </div>

    <div class="card-body px-0">
        <div class="table-responsive">
            <table id="order-details-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng giá tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Chi tiết đơn hàng sẽ được thêm vào đây -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="card-header d-flex justify-content-center align-items-center">
        <div class="header-title text-center">
            <h4 class="card-title" style="color: orange;">Thông Tin Thanh Toán</h4>
        </div>
    </div>

    <div class="card-body px-0">
        <div class="table-responsive">
            <table id="payment-info-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Phương Thức Thanh Toán</th>
                        <th>Trạng Thái Thanh Toán</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Thông tin thanh toán sẽ được thêm vào đây -->
                </tbody>
            </table>
        </div>
    </div>

@if($order->payment->payment_status == 0 && $order->payment->payment_menthod == 1 && $order->order_status != 'cancelled')
    <!-- Chỉ hiển thị nút thanh toán MOMO khi phương thức thanh toán là MOMO, trạng thái đơn hàng không phải là 'Cancelled' và chưa thanh toán -->
    <form action="{{ url('/momo-payment') }}" method="POST">
        @csrf
        <p style="text-align: center; font-weight: bold; color: blue;">Click vào nút để thanh toán</p>
        <input type="hidden" name="total_momo" value="{{ $order->order_total }}">
        <div class="button-container">
            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
            <button class="btn" type="submit">Thanh Toán MOMO Ngay</button>
        </div>
    </form>
@endif



</div>

<!-- Fetch API Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderId = @json($orderId);

        fetch(`api/details_orders/${orderId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật thông tin khách hàng
                    const customer = data.order.customer;
                    const customerTable = document.getElementById('customer-info-table').getElementsByTagName('tbody')[0];
                    const customerRow = customerTable.insertRow();
                    customerRow.insertCell(0).innerText = customer.customer_name;
                    customerRow.insertCell(1).innerText = customer.customer_phone;

                    // Cập nhật thông tin vận chuyển
                    const shipping = data.order.shipping;
                    const shippingTable = document.getElementById('shipping-info-table').getElementsByTagName('tbody')[0];
                    const shippingRow = shippingTable.insertRow();
                    shippingRow.insertCell(0).innerText = shipping.shipping_name;
                    shippingRow.insertCell(1).innerText = shipping.shipping_address;
                    shippingRow.insertCell(2).innerText = shipping.shipping_phone;

                    // Cập nhật chi tiết đơn hàng
                    const orderDetails = data.order.order_details;
                    const orderTable = document.getElementById('order-details-table').getElementsByTagName('tbody')[0];
                    orderDetails.forEach(item => {
                        const orderRow = orderTable.insertRow();
                        orderRow.insertCell(0).innerText = item.product_name;
                        orderRow.insertCell(1).innerText = item.product_sales_qty;
                        orderRow.insertCell(2).innerText = `${Number(item.product_price).toLocaleString()} VND`;
                        orderRow.insertCell(3).innerText = `${(item.product_price * item.product_sales_qty).toLocaleString()} VND`;
                    });

// Cập nhật thông tin thanh toán
const payment = data.order.payment;
const paymentTable = document.getElementById('payment-info-table').getElementsByTagName('tbody')[0];
const paymentRow = paymentTable.insertRow();

// Hiển thị phương thức thanh toán
const paymentMethod = 
    payment.payment_menthod == 1 ? 'Thanh toán MOMO' :
    payment.payment_menthod == 2 ? 'Thanh toán khi nhận hàng' :
    'Phương thức khác';
paymentRow.insertCell(0).innerText = paymentMethod;




                    // Hiển thị trạng thái thanh toán
                    const paymentStatus = payment.payment_status === 1 ? 'Đã thanh toán' : 'Chưa thanh toán';
                    paymentRow.insertCell(1).innerText = paymentStatus;

                } else {
                    alert('Không tìm thấy đơn hàng!');
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>

@endsection
