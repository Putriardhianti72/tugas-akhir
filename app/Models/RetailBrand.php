<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetailBrand extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='retail_brands';
    protected $primaryKey = 'id';
    protected $fillable =[
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(RetailProduct::class, 'retail_brand_id', 'id');
    }
}
