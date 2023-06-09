<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupPointTranslation extends Model
{
    protected $fillable = ['name', 'address', 'lang', 'pickup_point_id'];

    public function poickup_point(){
      return $this->belongsTo(PickupPoint::class);
    }
}
