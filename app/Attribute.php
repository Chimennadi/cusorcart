<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Attribute extends Model
{
    public function getTranslation($field = '', $lang = false){
      $lang = $lang == false ? App::getLocale() : $lang;
      $attribute_translation = $this->hasMany(AttributeTranslation::class)->where('lang', $lang)->first();
      return $attribute_translation != null ? $attribute_translation->$field : $this->$field;
    }

    public function attribute_translations(){
      return $this->hasMany(AttributeTranslation::class);
    }

    public function attribute_values() {
        return $this->hasMany(AttributeValue::class);
    }

}
