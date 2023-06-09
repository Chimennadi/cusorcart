<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class CustomerPackage extends Model
{
    public function getTranslation($field = '', $lang = false){
      $lang = $lang == false ? App::getLocale() : $lang;
      $brand_translation = $this->hasMany(CustomerPackageTranslation::class)->where('lang', $lang)->first();
      return $brand_translation != null ? $brand_translation->$field : $this->$field;
    }

    public function customer_package_translations(){
      return $this->hasMany(CustomerPackageTranslation::class);
    }

    public function customer_package_payments()
    {
        return $this->hasMany(CustomerPackagePayment::class);
    }

}
