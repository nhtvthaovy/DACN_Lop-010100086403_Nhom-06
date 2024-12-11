<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_roles';
    protected $primaryKey = 'role_id';

    protected $fillable = ['name']; 

    public function admins()
    {
        return $this->belongsToMany(AdminModel::class, 'tbl_admin_roles', 'role_id', 'admin_id');
    }
}
