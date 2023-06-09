<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscriber
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscriber extends Model
{
    //
}
