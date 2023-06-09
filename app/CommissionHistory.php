<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionHistory extends Model
{
    public function order() {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
