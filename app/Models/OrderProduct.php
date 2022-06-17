<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
