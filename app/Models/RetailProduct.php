<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class RetailProduct extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='retail_products';
    protected $primaryKey = 'id';
    protected $fillable =[
        'retail_brand_id',
        'product_name',
        'desc',
        'price',
        'pict',
        'stock'
    ];
    protected $appends = ['pict_url'];

    public function brand()
    {
        return $this->belongsTo(RetailBrand::class, 'retail_brand_id', 'id');
    }

    public function getPictUrlAttribute()
    {
        if ($this->pict) {
            return Storage::disk('local')->url('public/retail-pict/'. $this->pict);
        }
    }
}
