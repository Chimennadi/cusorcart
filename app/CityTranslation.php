<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
  protected $fillable = ['name', 'lang', 'city_id'];

  public function city(){
    return $this->belongsTo(City::class);
  }
}
