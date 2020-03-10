<?php

namespace App;

use App\Models\Employees\Employee;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Adldap\Laravel\Traits\HasLdapUser;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasLdapUser;

    const ACTIVITY_MINUTES = 5;

    protected $fillable = [
        'name', 'email', 'password', 'username', 'last_activity', 'last_ip', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

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

    public function isOnline()
    {
        if (!is_null($this->last_activity)) {
            $last_date = Carbon::parse($this->last_activity);
            if (Carbon::now()->diffInMinutes($last_date) < self::ACTIVITY_MINUTES) {
                return true;
            }
        }

        return false;
    }

    public static function getOnlineEmployeeIds()
    {
        $matchDateTime = Carbon::now()->subMinutes(self::ACTIVITY_MINUTES);
        return self::where('last_activity', '>=', $matchDateTime)->pluck('employee_id')->toArray();
    }

    public function isActive()
    {
        return $this->is_active;
    }
}

    
