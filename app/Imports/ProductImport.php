<?php

namespace App\Imports;

use App\Models\ProductModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    public function model(array $row)
    {
        // Bỏ qua dòng đầu tiên (dòng tiêu đề)
        static $firstRow = true;
        if ($firstRow) {
            $firstRow = false;
            return null; // Bỏ qua dòng đầu tiên
        }

        // Kiểm tra xem tên sản phẩm có hợp lệ không
        $productName = isset($row[0]) ? trim($row[0]) : null;
        if (empty($productName)) {
            // Nếu không có tên sản phẩm, trả về null để không lưu vào DB
            return null;
        }

        // Kiểm tra xem sản phẩm đã tồn tại chưa (theo tên sản phẩm)
        $existingProduct = ProductModel::whereRaw('BINARY LOWER(product_name) = ?', [mb_strtolower($productName)])->first();

        // Nếu sản phẩm đã tồn tại, bỏ qua dòng này
        if ($existingProduct) {
            return null;
        }

        // Lấy giá sản phẩm từ cột thứ 4
        $productPrice = isset($row[4]) ? $row[4] : 0;

        // Tạo mới sản phẩm
        return new ProductModel([
            'product_name' => $productName, // Tên sản phẩm
            'product_desc' => $row[2], // Mô tả sản phẩm
            'content' => $row[3], // Nội dung sản phẩm (cột 4)
            'category_id' => (int)$row[1],
            'product_quantity' => $row[5],
            'product_sold' => $row[6],
            'product_image' => $row[7],
            'product_price' => $productPrice,
            'product_status' => (int)$row[8],
        ]);
    }
}

