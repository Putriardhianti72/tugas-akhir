<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetailOrder extends Model
{
    use SoftDeletes;

    protected $table ='retail_orders';
    protected $primaryKey ='id';
    protected $fillable=[
        'status', 'invoice_no', 'qty', 'domain',
        'commission', 'total_price',
    ];

    public const STATUS_PENDING = 0;
    public const STATUS_COMPLETED = 1;
    public const STATUS_PAID = 2;
    public const STATUS_CANCELLED = 3;
    public const STATUS_DELIVERY = 4;

    public function owner()
    {
        return $this->hasOne(OrderProduct::class, 'domain', 'domain');
    }

    public function customer()
    {
        return $this->hasOne(RetailOrderCustomer::class, 'retail_order_id', 'id');
    }

    public function shipping()
    {
        return $this->hasOne(RetailOrderShipping::class, 'retail_order_id', 'id');
    }

    public function product()
    {
        return $this->hasOne(RetailOrderProduct::class, 'retail_order_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(RetailOrderPayment::class, 'retail_order_id', 'id');
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

        if ($this->status == self::STATUS_CANCELLED) {
            return 'Cancelled';
        }

        if ($this->status == self::STATUS_DELIVERY) {
            return 'Out for Delivery';
        }
    }

    public static function generateInvoiceNo()
    {
        $count = static::count('id');

        return 'RINV' . str_pad($count + 1, 7, '0', STR_PAD_LEFT);
    }

    // public function getTotalPriceAttribute()
    // {
    //     $shipping = $this->shipping->price ?? 0;
    //     $product = $this->product->total_price ?? 0;

    //     return $shipping + $product;
    // }
}
