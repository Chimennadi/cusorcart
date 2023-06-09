<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $intent = PaymentIntent::create([
                'amount' => ($request->grand_total - $request->coupon_discount) * 100,
                'currency' => $request->currency
            ]);
            $client_secret = $intent->client_secret;
            return response()->json([
                'success' => true,
                'client_secret' => $client_secret,
                'message' => null
            ]);
        } catch (CardException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'client_secret' => null
            ]);
        }
    }
}
