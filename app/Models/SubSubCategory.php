<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\SubSubCategory
 *
 * @property int $id
 * @property int $sub_category_id
 * @property string $name
 * @property string $brands
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory whereBrands($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubSubCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubSubCategory extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('alphabetical', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
