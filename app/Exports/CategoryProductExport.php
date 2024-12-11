<?php

namespace App\Exports;

use App\Models\CategoryModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CategoryProductExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * 
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $categories = CategoryModel::all();

        $data = $categories->map(function($category) {
            return [
                'ID' => $category->category_id,
                'Tên danh mục' => $category->category_name,
                'Mô tả danh mục' => $category->category_desc, 
                'Trạng thái' => $category->category_status,
                'Ngày thêm' => $category->created_at ? $category->created_at->format('d/m/Y') : 'Chưa có ngày thêm', 
            ];
        });

        return $data;
    }

    /**
     * Định nghĩa các tiêu đề cột trong file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID', 
            'Tên danh mục', 
            'Mô tả danh mục', 
            'Trạng thái', 
            'Ngày thêm',
        ];
    }

    /**
     * 
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                foreach (range('A', 'E') as $column) {
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
