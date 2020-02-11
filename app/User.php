<?php

namespace App;

use App\Models\Employees\Employee;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permission', 'user_id', 'permission_id');
    }

    public function hasPermission($permissionSlug)
    {
        foreach ($this->permissions as $permission) {
            if ($permissionSlug == $permission->slug) {
                return true;
            }
        }
        return false;
    }

    public function employee()
        {
            return $this->belongsTo(Employee::class);
        }
}
