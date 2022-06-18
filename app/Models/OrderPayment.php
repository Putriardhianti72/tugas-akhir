<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPayment extends Model
{
    protected $table = 'order_payments';
    protected $primaryKey ='id';
    protected $fillable=[
        'order_id',
        'bank_name',
        'acc_owner',
        'acc_number'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
