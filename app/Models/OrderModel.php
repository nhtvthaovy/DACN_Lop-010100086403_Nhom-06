<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = [
        'customer_id',
        'shipping_id',
        'payment_id',
        'order_total',
        'order_status',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetailsModel::class, 'order_id', 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'customer_id');
    }

    public function shipping()
    {
        return $this->belongsTo(ShippingModel::class, 'shipping_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentModel::class, 'payment_id');
    }
}
