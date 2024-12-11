<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_reply';
    protected $primaryKey = 'reply_id';
    public $timestamps = true; 


    protected $fillable = [
        'review_id', 
        'admin_id', 
        'reply'
    ];

    public function review()
    {
        return $this->belongsTo(ReviewModel::class, 'review_id');
    }

    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'admin_id');
    }

   public static function addReply($review_id, $admin_id, $reply)
    {
        return self::create([
            'review_id' => $review_id,
            'admin_id' => $admin_id,
            'reply' => $reply,
        ]);
    }
}