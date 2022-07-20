<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderPayment extends Model
{
    protected $table = 'order_payments';
    protected $primaryKey ='id';
    protected $fillable=[
        'order_id',
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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getPaymentTypeTextAttribute()
    {
        $type = $this->payment_type;

        if ($type === 'bank_transfer') {
            return 'Bank Transfer';
        }

        return Str::headline($type);
    }
}
