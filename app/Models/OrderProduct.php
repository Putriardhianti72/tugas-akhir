<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class OrderProduct extends Model
{
    protected $table ='order_products';
    protected $primaryKey ='id';
    protected $fillable=[
        'order_id',
        'product_id',
        'domain',
        'product_name',
        'category_id',
        'desc',
        'price',
        'pict',
        'user_hash',
        'token',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function member()
    {
        return $this->belongsTo(OrderMember::class, 'user_hash', 'user_hash');
    }

    public function getPictUrlAttribute()
    {
        if ($this->pict) {
            return Storage::disk('local')->url('public/pict/'. $this->pict);
        }
    }
}
