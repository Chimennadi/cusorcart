<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TicketReply
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property string $reply
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereUserId($value)
 * @mixin \Eloquent
 */
class TicketReply extends Model
{
    //
}
