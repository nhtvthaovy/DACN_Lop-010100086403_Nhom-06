<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class AdminModel extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'tbl_admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = true;

    protected $fillable = [
        'admin_email',
        'admin_password',
        'admin_name',
        'admin_phone',
    ];

    protected $hidden = [
        'admin_password',
    ];

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'tbl_admin_roles', 'admin_id', 'role_id');
    }

    public function getAuthPassword()
    {
        return $this->admin_password;
    }
}
