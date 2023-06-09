<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * App\Models\Logistic
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereAdminToPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereCashOnDeliveryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereInstamojoApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereInstamojoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereInstamojoToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic wherePaypalClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic wherePaypalClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic wherePaypalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereRazorpayApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereRazorpaySecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereRazorpayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereSslPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereSslStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereSslcommerzStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereStripeKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereStripeSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereStripeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereVerificationInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logistic whereVerificationStatus($value)
 * @mixin \Eloquent
 */
class Logistic extends Model
{
    protected $fillable = ['admin_to_pay'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
