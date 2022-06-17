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
        'status'
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
}
