<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Rave;

// use Paystack;

class RaveController extends Controller
{

    public $rave;

    public function __construct()
    {
        $this->rave = new Rave();
    }


    // the callback function is in the main controller of web | paystackcontroller

    public function handleGatewayCallback(Request $request)
    {
        try {
            $request = request();
            $payment_type = $request->payment_type;
            if ($payment_type == 'cart_payment') {
                $payment = $this->rave->getPaymentData();
                $payment_detalis = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'successful') {
                    $checkoutController = new CheckoutController;
                    return $checkoutController->checkout_done_from_api($request->user_id, $payment_detalis);
                }

                return response()->json(['result' => true, 'message' => "Payment is successful"]);
            } elseif ($payment_type == 'wallet_payment') {
                $payment = $this->rave->getPaymentData();
                $payment_details = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'successful') {
                    wallet_payment_done($request->user_id, $request->amount, $request->payment_option, $payment_details);
                    return response()->json(['result' => true, 'message' => "Payment is successful"]);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }
}
