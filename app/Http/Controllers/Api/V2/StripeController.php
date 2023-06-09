<?php

namespace App\Http\Controllers\Api\V2;

use App\CustomerPackage;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\Order;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        $payment_type = $request->payment_type;
        $order_id = $request->order_id;
        $amount = $request->amount;
        $user_id = $request->user_id;
        return view('frontend.payment.stripe_app', compact('payment_type', 'order_id', 'amount', 'user_id'));
    }

    public function create_checkout_session(Request $request)
    {
        $amount = 0;

        if ($request->payment_type == 'cart_payment') {
            $order = Order::findOrFail($request->order_id);
            $amount = round($order->grand_total * 100);
        } elseif ($request->payment_type == 'wallet_payment') {
            $amount = round($request->amount * 100);
        }


        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code,
                        'product_data' => [
                            'name' => "Payment"
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('api.stripe.success', ["payment_type" => $request->payment_type, "order_id" => $request->order_id, "amount" => $request->amount, "user_id" => $request->user_id]),
            'cancel_url' => route('api.stripe.cancel'),
        ]);

        return response()->json(['id' => $session->id, 'status' => 200]);
    }

    public function success(Request $request)
    {
        try {
            $payment = ["status" => "Success"];

            $payment_type = $request->payment_type;

            if ($payment_type == 'cart_payment') {

                checkout_done($request->order_id, json_encode($payment));
            }

            if ($payment_type == 'wallet_payment') {

                wallet_payment_done($request->user_id, $request->amount, 'Stripe', json_encode($payment));
            }

            return response()->json(['result' => true, 'message' => "Payment is successful"]);


        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => "Payment is unsuccessful"]);
        }
    }

    public function cancel(Request $request)
    {
        return response()->json(['result' => false, 'message' => "Payment is cancelled"]);
    }
}
