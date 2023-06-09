<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FlashDealProduct
 *
 * @property int $id
 * @property int $flash_deal_id
 * @property int $product_id
 * @property float|null $discount
 * @property string|null $discount_type
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct whereFlashDealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FlashDealProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FlashDealProduct extends Model
{
    //
}
