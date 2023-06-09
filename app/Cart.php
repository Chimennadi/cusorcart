<?php

namespace App;

use App\User;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $fillable = ['address_id','price','tax','shipping_cost','discount','coupon_code','coupon_applied','quantity','user_id','temp_user_id','owner_id','product_id','variation', 'neck', 'chest', 'sleeves', 'waist', 'shoulder', 'knee', 'laps', 'length', 'gender', 'size', 'size_type', ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
