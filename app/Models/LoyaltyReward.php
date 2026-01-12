<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyReward extends Model
{
    //
    protected $fillable = [
        'name',
        'points_required',
        'discount_amount',
        'coupon_code'
    ];
}
