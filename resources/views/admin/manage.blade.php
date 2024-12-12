@extends('admin_layout')

@section('admin_content')
<div class="card-header d-flex justify-content-between mb-5">
    <h4 class="card-title">Thống Kê Doanh Số</h4>
    <form method="GET" action="{{ route('admin.manage') }}">
        <select name="group_by" onchange="this.form.submit()">
            <option value="day" {{ $groupBy == 'day' ? 'selected' : '' }}>Theo Ngày</option>
            <option value="month" {{ $groupBy == 'month' ? 'selected' : '' }}>Theo Tháng</option>
            <option value="year" {{ $groupBy == 'year' ? 'selected' : '' }}>Theo Năm</option>
        </select>
    </form>
</div>

<div class="card-body">
    <canvas id="salesChart" width="300" height="300"></canvas> <!-- Biểu đồ doanh thu -->
</div>

<!-- Biểu đồ thống kê sản phẩm bán -->
<div class="card-header d-flex justify-content-between mb-5 mt-5">
    <h4 class="card-title">Thống Kê Sản Phẩm Bán</h4>
</div>

<div class="card-body">
    <canvas id="productSalesChart" width="300" height="300"></canvas> <!-- Biểu đồ sản phẩm bán -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Biểu đồ doanh thu
    var ctx1 = document.getElementById('salesChart').getContext('2d');
    var salesData = @json($salesData);

    var labels = salesData.map(function(item) {
        return item.period; // Lấy thời gian (ngày/tháng/năm)
    });

    var data = salesData.map(function(item) {
        return item.total_sales; // Lấy tổng doanh thu
    });

    var chart1 = new Chart(ctx1, {
        type: 'bar', // Biểu đồ cột
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh Thu',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Giữ tỷ lệ khung hình khi thay đổi kích thước
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ sản phẩm bán
    var ctx2 = document.getElementById('productSalesChart').getContext('2d');
    var productSalesData = @json($productSalesData);

    var productLabels = productSalesData.map(function(item) {
        return item.product_name; // Tên sản phẩm
    });

    var productData = productSalesData.map(function(item) {
        return item.total_sales; // Tổng số lượng bán
    });

    var chart2 = new Chart(ctx2, {
        type: 'pie', // Biểu đồ tròn
        data: {
            labels: productLabels,
            datasets: [{
                label: 'Sản Phẩm Đã Bán',
                data: productData, // Số lượng sản phẩm bán
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 159, 64, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Giữ tỷ lệ khung hình khi thay đổi kích thước
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' sản phẩm';
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
