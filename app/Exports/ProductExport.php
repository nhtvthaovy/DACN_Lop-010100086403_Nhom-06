<?php

namespace App\Exports;

use App\Models\ProductModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ProductExport implements FromCollection, WithHeadings, WithEvents
{
    public function collection()
    {
        $products = ProductModel::all();

        $data = $products->map(function($product) {
            return [
                'ID' => $product->product_id,
                'Tên sản phẩm' => $product->product_name,
                'Danh mục' => $product->category->category_name,
                'Mô tả' => $product->product_desc ?? 'Chưa có mô tả',
                'Giá' => number_format($product->product_price) . ' VND',
                'Ảnh' => $product->product_image,
                'Số lượng' => $product->product_quantity,
                'Đã bán' => $product->product_sold,
                'Ngày thêm' => $product->created_at ? $product->created_at->format('d/m/Y') : 'Chưa có ngày thêm',
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'ID', 
            'Tên sản phẩm', 
            'Danh mục', 
            'Mô tả', 
            'Giá', 
            'Ảnh',
            'Số lượng',
            'Đã bán',
            'Ngày thêm',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                foreach (range('A', 'I') as $column) {
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }

                $row = 2;
                foreach (ProductModel::all() as $product) {
                    $imagePath = public_path('uploads/product/' . $product->product_image);
                    if (file_exists($imagePath)) {
                        $drawing = new Drawing();
                        $drawing->setName('Ảnh sản phẩm');
                        $drawing->setDescription('Ảnh sản phẩm');
                        $drawing->setPath($imagePath);
                        $drawing->setHeight(50);
                        $drawing->setCoordinates('F' . $row);
                        $drawing->setOffsetX(5);
                        $drawing->setOffsetY(5);
                        $drawing->setWorksheet($event->sheet->getDelegate());

                        // Điều chỉnh chiều cao hàng
                        $event->sheet->getRowDimension($row)->setRowHeight(60);

                        $row++;
                    }
                }
            },
        ];
    }
}
