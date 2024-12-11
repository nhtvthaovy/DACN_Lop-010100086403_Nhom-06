<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    public $timestamps = true;

    protected $fillable = [
        'product_name',
        'category_id',
        'product_desc',
        'product_content',
        'product_price',
        'product_image',
        'product_status',
        'product_quantity',
        'product_sold',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }


    
}

