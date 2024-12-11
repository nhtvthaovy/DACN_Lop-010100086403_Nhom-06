<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_review';

    protected $primaryKey = 'review_id';

    protected $fillable = [
        'product_id',
        'customer_id',
        'rating',
        'comment',
        'review_status',
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'customer_id');
    }

    public function replies()
{
    return $this->hasMany(ReplyModel::class, 'review_id');
}


}
