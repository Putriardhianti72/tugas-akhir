<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailOrderShipping extends Model
{
    protected $table = 'retail_order_shippings';
    protected $primaryKey ='id';
    protected $fillable=[
        'retail_order_id',
        'customer_id',
        'name',
        'email',
        'no_hp',
        'alamat',
        'province_id',
        'city_id',
        'subdistrict_id',
        'postal_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'retail_order_id');
    }
}
