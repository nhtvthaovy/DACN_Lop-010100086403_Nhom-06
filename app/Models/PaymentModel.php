<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_payment';
    protected $primaryKey = 'payment_id';
    public $timestamps = true;

    protected $fillable = [
        'payment_menthod',
        'payment_status',
    ];

    public function orders()
    {
    return $this->hasMany(OrderModel::class, 'payment_id');
    }

}
