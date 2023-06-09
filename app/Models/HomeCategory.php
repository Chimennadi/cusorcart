<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HomeCategory
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $subsubcategories
 * @property int $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory whereSubsubcategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HomeCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class HomeCategory extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('activated', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
