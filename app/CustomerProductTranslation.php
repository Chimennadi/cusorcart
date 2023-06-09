<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerProductTranslation extends Model
{
    protected $fillable = ['customer_product_id', 'name', 'lang'];

    public function customer_product(){
      return $this->belongsTo(CustomerProduct::class);
    }
}
