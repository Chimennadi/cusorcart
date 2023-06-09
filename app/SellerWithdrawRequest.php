<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerWithdrawRequest extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
