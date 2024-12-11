<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailsModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_details';
    protected $primaryKey = 'order_details_id';
    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'product_sales_qty',
    ];

    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
