<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Search
 *
 * @property int $id
 * @property string $query
 * @property int $count
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Search newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Search newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Search query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Search whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Search whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Search whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Search whereQuery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Search whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Search extends Model
{
    //
}
