<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    
    public function category() {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

}
