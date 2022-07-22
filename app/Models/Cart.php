<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id', 'user_hash', 'domain'
    ];
    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

