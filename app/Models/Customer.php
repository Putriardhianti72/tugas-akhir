<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'customers';
    protected $primaryKey ='id';
    protected $fillable = [
        'uid',
        'name',
        'email',
        'password',
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
}
