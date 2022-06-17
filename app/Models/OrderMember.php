<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMember extends Model
{
    protected $table ='order_members';
    protected $primaryKey ='id';
    protected $fillable=[
        'order_id',
        'uid',
        'nama',
        'email',
        'hp',
        'alamat1',
        'alamat2',
        'kota',
        'propinsi',
        'token',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
