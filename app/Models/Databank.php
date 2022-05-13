<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databank extends Model
{
    use HasFactory;
    protected $table ='databanks';
    protected $primaryKey ='id';
    protected $fillable=[
        'bank_name',
        'acc_owner',
        'acc_number'
    ];
}
