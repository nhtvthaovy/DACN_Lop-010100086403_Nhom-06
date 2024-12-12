<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingModel extends Model
{
    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'tbl_shipping';

    // Khóa chính của bảng
    protected $primaryKey = 'shipping_id';

    // Các trường có thể được điền thông qua phương thức Mass Assignment
    protected $fillable = [
        'shipping_name',
        'shipping_address',
        'shipping_phone',
        'shipping_email',
        'shipping_note',
    ];

    // Loại bỏ các trường tự động `created_at` và `updated_at` nếu không cần
    public $timestamps = true;
}
