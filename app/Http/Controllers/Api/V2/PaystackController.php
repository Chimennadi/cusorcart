<?php


namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Paystack;
class PaystackController extends Controller
{

    public function init(Request $request)
    {
        $payment_type = $request->payment_type;
        $order_id = $request->order_id;
        $amount = $request->amount;
        $user_id = $request->user_id;


        if ($payment_type == 'cart_payment') {
            $order = Order::find($order_id);
            $user = User::find($user_id);
            $request->email = $user->email;
            $request->amount = round($order->grand_total * 100);
            $request->currency = env('PAYSTACK_CURRENCY_CODE', 'NGN');
            $request->reference = Paystack::genTranxRef();
            return Paystack::getAuthorizationUrl()->redirectNow();
        } elseif ($payment_type == 'wallet_payment') {
            $user = User::find($user_id);
            $request->email = $user->email;
            $request->amount = round($amount * 100);
            $request->currency = env('PAYSTACK_CURRENCY_CODE', 'NGN');
            $request->reference = Paystack::genTranxRef();
            return Paystack::getAuthorizationUrl()->redirectNow();
        }
    }


    // the callback function is in the main controller of web | paystackcontroller

    public function success(Request $request)
    {
        try {

            $payment_type = $request->payment_type;

            if ($payment_type == 'cart_payment') {

                checkout_done($request->order_id, $request->payment_details);
            }

            if ($payment_type == 'wallet_payment') {

                wallet_payment_done($request->user_id, $request->amount, 'Paystack', $request->payment_details);
            }

            return response()->json(['result' => true, 'message' => "Payment is successful"]);


        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }

}
