<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'address', 'country', 'state', 'city', 'postal_code', 'phone', 'set_default'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
