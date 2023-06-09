<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    public function product_taxes() {
        return $this->hasMany(ProductTax::class);
    }
}
