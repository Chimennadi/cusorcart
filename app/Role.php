<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Role extends Model
{
    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $role_translation = $this->hasMany(RoleTranslation::class)->where('lang', $lang)->first();
        return $role_translation != null ? $role_translation->$field : $this->$field;
    }

    public function role_translations(){
      return $this->hasMany(RoleTranslation::class);
    }
}
