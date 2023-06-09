<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property int $user_id
 * @property string $subject
 * @property string $details
 * @property int $viewed
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereViewed($value)
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    //
}
