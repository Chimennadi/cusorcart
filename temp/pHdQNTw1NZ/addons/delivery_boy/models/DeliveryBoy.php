<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryBoy extends Model
{
    public function user(){
    	return $this->belongsTo(user::class);
    }
}
