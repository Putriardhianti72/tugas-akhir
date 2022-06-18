<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='products';
    protected $primaryKey = 'id';
    protected $fillable =[
        'product_name',
        'category_id',
        'desc',
        'price',
        'pict'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPictUrlAttribute()
    {
        if ($this->pict) {
            return Storage::disk('local')->url('public/pict/'. $this->pict);
        }
    }
}
