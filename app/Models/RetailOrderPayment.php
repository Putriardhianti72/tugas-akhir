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
        'bank_name',
        'acc_owner',
        'acc_number',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(RetailOrder::class, 'retail_order_id');
    }

    public function destinationBank()
    {
        return $this->belongsTo(Bank::class, 'destination_bank_id');
    }

    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof) {
            return Storage::url('public/retail-payment-proof/' . $this->payment_proof);
        }
    }
}
