<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'category_id'];

    public function category(){
    	return $this->belongsTo(Category::class);
    }
}
