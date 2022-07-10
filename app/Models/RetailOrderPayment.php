<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class RetailOrderPayment extends Model
{
    protected $table = 'retail_order_payments';
    protected $primaryKey ='id';
    protected $fillable=[
        'retail_order_id',
        'destination_bank_id',
        'acc_owner',
        'acc_number',
        'total_price',
        'bank',
        'va_number',
        'payment_type',
        'card_type',
        'currency',
        'transaction_id',
        'transaction_time',
        'fraud_status',
        'transaction_status',
        'signature_key',
    ];

    protected $dates = ['transaction_time'];

    public function order()
    {
        return $this->belongsTo(RetailOrder::class, 'retail_order_id');
    }

    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof) {
            return Storage::url('public/retail-payment-proof/' . $this->payment_proof);
        }
    }
}
