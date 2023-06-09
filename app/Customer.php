<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
      'user_id',
    ];
    public function user(){
    	return $this->belongsTo(user::class);
    }
}
