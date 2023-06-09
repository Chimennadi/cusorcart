<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Color
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Color extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('alphabetical', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }
}
