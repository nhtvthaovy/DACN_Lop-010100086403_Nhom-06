<?php

namespace App\Imports;

use App\Models\CategoryModel;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryProductImport implements ToModel
{
    public function model(array $row)
    {
        if ($row[0] == 'Tên danh mục') {
            return null; 
        }

        $existingCategory = CategoryModel::whereRaw('BINARY LOWER(category_name) = ?', [mb_strtolower($row[0])])->first();

        if ($existingCategory) {
          
            return null;
        }

        return new CategoryModel([
            'category_name' => $row[0], // Cột tên danh mục
            'category_desc' => $row[1], // Cột mô tả danh mục
            'category_status' => (int)$row[2], // Cột hiển thị (0 hoặc 1)
        ]);
    }
}

