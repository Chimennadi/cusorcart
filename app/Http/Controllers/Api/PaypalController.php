<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Braintree_Gateway;

class PaypalController extends Controller
{
    public function processPayment(Request $request)
    {
        $order = new OrderController;

        $gateway = new Braintree_Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $response = $gateway->transaction()->sale([
            'amount' => $request->grand_total,
            'paymentMethodNonce' => $request->nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($response->success) {
            return $order->processOrder($request);
        } elseif ($response->transaction) {
            return response()->json([
                'success' => false,
                'message' => 'The order was not completed because there was an error processing the transaction'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'The order was not completed because the payment is invalid'
            ]);
        }

    }
}
