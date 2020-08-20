<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Employees\Post;
use App\User;

class Employee extends Model
{
    protected $table = 'employees';

    use SoftDeletes;

    const DEFAULT_FILENAME = 'employee_default.png';

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function leader()
    {
        return $this->belongsTo(self::class, 'leader_id');
    }

    public function getPostName()
    {
        return $this->post ? $this->post->name : 'Не указана';
    }

    public function getLeaderName()
    {
        return $this->leader ? $this->leader->fullname : 'Не указан';
    }

    public function getWorkPhone()
    {
        return (is_null($this->work_phone) || empty($this->work_phone)) ? 'Не указан' : '#' . $this->work_phone;
    }

    public function getBirthDay()
    {
        return (is_null($this->birthday) || empty($this->birthday)) ? 'Не указана' : \Carbon::parse($this->birthday)->format('d.m.Y');
    }

    public function hasEmail($domain)
    {
        return substr_count($this->email, $domain) > 0 || substr_count($this->email2, $domain) > 0;
    }

    public function getEmail($domain)
    {
        if (substr_count($this->email, $domain) > 0) {
            return $this->email;
        }
        return substr_count($this->email2, $domain) > 0 ? $this->email2 : '';
    }

    public function getAnyEmail()
    {
        if (!empty($this->email) && !is_null($this->email)) {
            return $this->email;
        }

        return (!empty($this->email2) && !is_null($this->email2)) ? $this->email2 : '';
    }

    public function getFilename()
    {
        return is_null($this->avatar_url) ? self::DEFAULT_FILENAME : $this->avatar_url;
    }

    public static function getDestinationPath() {
        return 'employees/avatar/';
    }

    public function getAvatarUrl()
    {
        return \Storage::url($this->getAvatarPath());
    }

    public function getAvatarPath()
    {
        return self::getDestinationPath() . $this->getFilename();
    }

    public function getThumbUrl()
    {
        return \Storage::url($this->getThumbPath());
    }

    public function getThumbPath()
    {
        return self::getDestinationPath() . 'thumbs/' . $this->getFilename();
    }

    public function isOnline()
    {
        return $this->user ? $this->user->isOnline() : false;
    }
}
