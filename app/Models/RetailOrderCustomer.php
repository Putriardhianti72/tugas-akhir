<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class RetailOrderCustomer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'retail_order_customers';
    protected $primaryKey ='id';
    protected $fillable = [
        'retail_order_id',
        'uid',
        'name',
        'email',
        'password',
        'no_hp',
        'alamat',
        'province_id',
        'province_name',
        'city_id',
        'city_name',
        'subdistrict_id',
        'subdistrict_name',
        'postal_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function order()
    {
        return $this->belongsTo(RetailOrder::class, 'retail_order_id', 'id');
    }
}
