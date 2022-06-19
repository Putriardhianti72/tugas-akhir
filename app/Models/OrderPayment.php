<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class OrderPayment extends Model
{
    protected $table = 'order_payments';
    protected $primaryKey ='id';
    protected $fillable=[
        'order_id',
        'destination_bank_id',
        'bank_name',
        'acc_owner',
        'acc_number',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function destinationBank()
    {
        return $this->belongsTo(Bank::class, 'destination_bank_id');
    }

    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof) {
            return Storage::url('public/payment-proof/' . $this->payment_proof);
        }
    }
}
