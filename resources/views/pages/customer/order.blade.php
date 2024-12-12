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
    </style>

    <!-- Breadcrumb -->
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

    <!-- Orders Table -->
    <div class="checkout-area pt-30">
        <div class="container">
            <p>Đang tải dữ liệu...</p>
            <table>
                <thead>
                    <tr>
                        <th>ID Đơn Hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Đặt</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <!-- Back to Home -->
            <div class="button-container mt-20">
                <a class="btn-back-home" href="{{ URL::to('home') }}">Về trang chủ</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const customerId = "{{ Session::get('customer_id') }}"; // Lấy customer_id từ session
    const ordersTable = document.querySelector("tbody");
    const messageContainer = document.querySelector("p");

    // Kiểm tra xem customer_id có tồn tại không
    if (!customerId) {
        messageContainer.textContent = "Bạn cần đăng nhập để xem đơn hàng.";
        return;
    }

    fetch(`api/orders/${customerId}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Không có thông tin đơn hàng.");
            }
            return response.json();
        })
        .then((data) => {
            if (data.success && data.data.length > 0) {
                // Hiển thị đơn hàng vào bảng
                data.data.forEach((order) => {
                    // Chuyển đổi trạng thái sang tiếng Việt
                    let statusText = '';
                    switch (order.order_status) {
                        case 'pending':
                            statusText = 'Đang xử lý';
                            break;
                        case 'packaged':
                            statusText = 'Đã đóng gói';
                            break;
                        case 'shipping':
                            statusText = 'Đang giao';
                            break;
                        case 'completed':
                            statusText = 'Hoàn thành';
                            break;
                        case 'cancelled':
                            statusText = 'Hủy';
                            break;
                        default:
                            statusText = 'Chưa xác định';
                    }

                    const row = `
                        <tr>
                            <td>${order.order_id}</td>
                            <td>${Number(order.order_total).toLocaleString()} VND</td>
                            <td>${statusText}</td>
                            <td>${new Date(order.created_at).toLocaleDateString('vi-VN')}</td>
<td>
    <form action="{{ URL::to('/orderid') }}" method="POST" style="display: inline;">
        @csrf
        <input type="hidden" name="order_id" value="${order.order_id}">
        <button type="submit" class="btn-detail">Xem chi tiết</button>
    </form>
</td>


                        </tr>
                    `;
                    ordersTable.innerHTML += row;
                });
                messageContainer.style.display = "none"; // Ẩn thông báo "Đang tải dữ liệu"
            } else {
                messageContainer.textContent = "Không có đơn hàng nào.";
            }
        })
        .catch((error) => {
            messageContainer.textContent = error.message;
        });
});
</script>

@endsection
