<?php

namespace App\Models\Inventory\Consumables;

use App\User;
use App\Models\Objects\CObject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Movement extends Model
{
    use SoftDeletes;

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';

    protected $table = 'consumable_movements';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at', 'confirmed_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function confirmUser()
    {
        return $this->belongsTo(User::class, 'user_confirm_id', 'id');
    }

    public function consumable()
    {
        return $this->belongsTo(Consumable::class, 'consumable_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(CObject::class, 'sender_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(CObject::class, 'recipient_id', 'id');
    }

    public static function statusesList(): array
    {
        return [
            self::STATUS_PENDING => 'В ожидании',
            self::STATUS_CONFIRMED => 'Подтверждено',
        ];
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function getStatus() : string
    {
        return self::statusesList()[$this->status];
    }

    public function confirm(): void
    {
        $this->update([
            'status' => self::STATUS_CONFIRMED,
            'user_confirm_id' => Auth::id(),
            'confirmed_at' => Carbon::now()
        ]);
    }

    public function pending(): void
    {
        $this->update([
            'status' => self::STATUS_PENDING,
            'user_confirm_id' => null,
            'confirmed_at' => null
        ]);
    }

    public function isArrival()
    {
        return $this->is_arrival;
    }

    public function isWriteOff()
    {
        return $this->is_write_off;
    }

    public function scopeWriteOff($query)
    {
        return $query->where('is_write_off', true);
    }
}
