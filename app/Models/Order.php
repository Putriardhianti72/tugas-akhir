<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table ='orders';
    protected $primaryKey ='id';
    protected $fillable=[
        'user_hash', 'status', 'invoice_no', 'expired_at',
    ];
    protected $dates = [
        'expired_at',
    ];

    public const STATUS_PENDING = 0;
    public const STATUS_COMPLETED = 1;
    public const STATUS_PAID = 2;
    public const STATUS_CANCEL = 3;

    public function member()
    {
        return $this->hasOne(OrderMember::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function payment()
    {
        return $this->hasOne(OrderPayment::class);
    }

    public function getStatusTextAttribute()
    {
        if ($this->status == self::STATUS_PENDING) {
            return 'Pending';
        }

        if ($this->status == self::STATUS_COMPLETED) {
            return 'Completed';
        }

        if ($this->status == self::STATUS_PAID) {
            return 'Paid';
        }

        if ($this->status == self::STATUS_CANCEL) {
            return 'Cancelled';
        }
    }

    public static function generateInvoiceNo()
    {
        $count = static::count('id');

        return 'INV' . str_pad($count + 1, 9, '0', STR_PAD_LEFT);
    }
}
