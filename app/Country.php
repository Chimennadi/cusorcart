<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['code','name','sortname','status']; //<---- Add this line
}
