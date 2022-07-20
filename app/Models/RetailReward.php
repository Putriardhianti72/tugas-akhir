<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailReward extends Model
{
    protected $table = 'retail_rewards';
    protected $primaryKey ='id';
    protected $fillable=[
        'code',
        'reward',
    ];
}
