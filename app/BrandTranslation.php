<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
  protected $fillable = ['name', 'lang', 'brand_id'];

  public function brand(){
    return $this->belongsTo(Brand::class);
  }
}
