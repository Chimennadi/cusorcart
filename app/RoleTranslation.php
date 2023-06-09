<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'role_id'];

    public function role(){
      return $this->belongsTo(Role::class);
    }
}
