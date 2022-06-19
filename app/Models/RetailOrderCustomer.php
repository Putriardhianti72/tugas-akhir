<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailOrderCustomer extends Model
{
    protected $table ='retail_order_customers';
    protected $primaryKey ='id';
    protected $fillable=[
        'retail_order_id',
        'uid',
        'name',
        'email',
        'no_hp',
        'alamat',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'retail_order_id');
    }
}
