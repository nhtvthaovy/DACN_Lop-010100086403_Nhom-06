<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRoleModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_admin_roles'; 

    protected $fillable = [
        'admin_id',
        'role_id',
    ];

    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'admin_id');
    }

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }
}
