<?php

namespace App\Models\Keys;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $table = 'key_collection_usage';

    protected $fillable = ['user_id', 'key_id', 'user_name', 'PC_name', 'IP', 'created_at'];

    public function key()
    {
        return $this->belongsTo(Key::class, 'key_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPCInfo()
    {
        return $this->PC_name . (is_null($this->IP) ? '' : ' (' . $this->IP . ')');
    }
}
