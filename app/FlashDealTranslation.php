<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlashDealTranslation extends Model
{
  protected $fillable = ['title', 'lang', 'flash_deal_id'];

  public function flash_deal(){
    return $this->belongsTo(FlashDeal::class);
  }

}
