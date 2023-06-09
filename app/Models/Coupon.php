<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property string $type
 * @property string $code
 * @property string $details
 * @property float $discount
 * @property string $discount_type
 * @property int $start_date
 * @property int $end_date
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Coupon extends Model
{
    //
}
