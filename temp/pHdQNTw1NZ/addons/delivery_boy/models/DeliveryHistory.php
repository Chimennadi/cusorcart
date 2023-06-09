<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryHistory extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
