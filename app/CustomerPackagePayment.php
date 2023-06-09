<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPackagePayment extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function customer_package(){
    	return $this->belongsTo(CustomerPackage::class);
    }
}
