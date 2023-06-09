<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPackageTranslation extends Model
{
  protected $fillable = ['name', 'lang', 'customer_package_id'];

  public function customer_package(){
   return $this->belongsTo(CustomerPackage::class);
  }
}
