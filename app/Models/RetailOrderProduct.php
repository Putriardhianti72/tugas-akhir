<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RetailOrderProduct extends Model
{
    protected $table ='retail_order_products';
    protected $primaryKey ='id';
    protected $fillable=[
        'retail_order_id',
        'retail_product_id',
        'qty',
        'code',
        'product_name',
        'desc',
        'price',
        'pict',
        'weight',
    ];

    public function order()
    {
        return $this->belongsTo(RetailOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(RetailProduct::class);
    }

    public function getPictUrlAttribute()
    {
        if ($this->pict) {
            return Storage::disk('local')->url('public/retail-pict/'. $this->pict);
        }
    }

    public function getTotalPriceAttribute()
    {
        return $this->qty * $this->price;
    }

    public function getTotalWeightAttribute()
    {
        return $this->qty * $this->weight;
    }
}
