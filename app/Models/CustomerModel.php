<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_customers';
    protected $primaryKey = 'customer_id';
    public $timestamps = true;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_password',
        'customer_phone',
    ];
}
