<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $guest_id
 * @property string|null $shipping_address
 * @property string|null $payment_type
 * @property string|null $payment_status
 * @property string|null $payment_details
 * @property float|null $grand_total
 * @property float $coupon_discount
 * @property string|null $code
 * @property int $date
 * @property int $viewed
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCouponDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereGrandTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereGuestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereViewed($value)
 * @mixin \Eloquent
 */

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
