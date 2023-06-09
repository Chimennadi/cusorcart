<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
