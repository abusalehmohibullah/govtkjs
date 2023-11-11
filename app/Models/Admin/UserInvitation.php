<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserInvitation extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'email',
        'designation',
        'token',
        'invited_by',
        'status',
        'expires_at',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'invited_user_roles', 'invitation_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'invited_user_permissions', 'invitation_id', 'permission_id');
    }
    
}
