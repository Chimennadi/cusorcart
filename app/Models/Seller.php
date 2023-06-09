<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * App\Models\Seller
 *
 * @property int $id
 * @property int $user_id
 * @property int $verification_status
 * @property string|null $verification_info
 * @property int $cash_on_delivery_status
 * @property int $sslcommerz_status
 * @property int|null $stripe_status
 * @property int $paypal_status
 * @property string|null $paypal_client_id
 * @property string|null $paypal_client_secret
 * @property string|null $ssl_store_id
 * @property string|null $ssl_password
 * @property string|null $stripe_key
 * @property string|null $stripe_secret
 * @property int $instamojo_status
 * @property string|null $instamojo_api_key
 * @property string|null $instamojo_token
 * @property int $razorpay_status
 * @property string|null $razorpay_api_key
 * @property string|null $razorpay_secret
 * @property float $admin_to_pay
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereAdminToPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereCashOnDeliveryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereInstamojoApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereInstamojoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereInstamojoToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller wherePaypalClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller wherePaypalClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller wherePaypalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereRazorpayApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereRazorpaySecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereRazorpayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereSslPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereSslStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereSslcommerzStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereStripeKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereStripeSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereStripeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereVerificationInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seller whereVerificationStatus($value)
 * @mixin \Eloquent
 */
class Seller extends Model
{
    protected $fillable = ['admin_to_pay'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
