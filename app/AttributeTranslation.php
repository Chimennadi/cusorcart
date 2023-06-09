<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
  protected $fillable = ['name', 'lang', 'attribute_id'];

  public function attribute(){
    return $this->belongsTo(Attribute::class);
  }

}
