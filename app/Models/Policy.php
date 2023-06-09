<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Policy
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Policy extends Model
{
    //
}
