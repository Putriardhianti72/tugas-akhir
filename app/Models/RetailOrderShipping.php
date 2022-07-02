<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailOrderShipping extends Model
{
    protected $table = 'retail_order_shippings';
    protected $primaryKey ='id';
    protected $fillable=[
        'retail_order_id',
        'name',
        'code',
        'price',
        'weight',
        'etd',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'retail_order_id');
    }
}
