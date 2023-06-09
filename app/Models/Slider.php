<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string|null $photo
 * @property int $published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class Slider extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('published', 1);
        });
    }
}
