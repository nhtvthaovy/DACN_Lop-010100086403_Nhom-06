<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_category_product';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name',
        'category_desc',
        'category_status',
    ];
    public $timestamps = true;


    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category_id');
    }

}
