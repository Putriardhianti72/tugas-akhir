<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='categories';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    protected $fillable =[
        'category_name'
    ];

//    public static function product()
//    {
//        return DB::table('products')
//            ->join('categories', 'products.category_id', '=', 'categories.id')
//            ->select('*')
//            ->get();
//    }
    public function product(){
        return $this->hasMany(Product::class);
    }

}
