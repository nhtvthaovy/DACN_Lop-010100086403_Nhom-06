<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PostModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_post';

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'post_title',
        'post_desc',
        'post_content',
        'post_author',
        'post_thumbnail',
        'post_status',
    ];

    
}
