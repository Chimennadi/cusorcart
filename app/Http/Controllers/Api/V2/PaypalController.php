<?php

namespace App\Http\Controllers\Api\V2;

use App\CustomerPackage;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\Order;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PaypalController extends Controller
{

    public function getUrl(Request $request)
    {
        // Creating an environment

        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');

        if (get_setting('paypal_sandbox') == 1) {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        } else {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        if ($request->payment_type == 'cart_payment') {
            $order = Order::find($request->order_id);
            $amount = $order->grand_total;
        } elseif ($request->payment_type == 'wallet_payment') {
            $amount = $request->amount;
        }

        $order_create_request = new OrdersCreateRequest();
        $order_create_request->prefer('return=representation');
        $order_create_request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => rand(000000, 999999),
                "amount" => [
                    "value" => number_format($amount, 2, '.', ''),
                    "currency_code" => \App\Currency::find(get_setting('system_default_currency'))->code
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('api.paypal.cancel'),
                "return_url" => route('api.paypal.done', ["payment_type" => $request->payment_type, "order_id" => $request->order_id, "amount" => $request->amount, "user_id" => $request->user_id]),
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($order_create_request);
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            //return Redirect::to($response->result->links[1]->href);
            return response()->json(['result' => true, 'url' => $response->result->links[1]->href, 'message' => "Found redirect url"]);
        } catch (HttpException $ex) {
            return response()->json(['result' => false, 'url' => '', 'message' => "Could not find redirect url"]);
        }
    }


    public function getCancel(Request $request)
    {
        return response()->json(['result' => true, 'message' => "Payment failed or got cancelled"]);
    }

    public function getDone(Request $request)
    {
        //dd($request->all());
        // Creating an environment
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');

        if (get_setting('paypal_sandbox') == 1) {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        } else {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        // $response->result->id gives the orderId of the order created above

        $ordersCaptureRequest = new OrdersCaptureRequest($request->token);
        $ordersCaptureRequest->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($ordersCaptureRequest);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response

            if ($request->payment_type == 'cart_payment') {

                checkout_done($request->order_id, json_encode($response));
            }

            if ($request->payment_type == 'wallet_payment') {

                wallet_payment_done($request->user_id, $request->amount, 'Paypal', json_encode($response));
            }

            return response()->json(['result' => true, 'message' => "Payment is successful"]);
        } catch (HttpException $ex) {
            return response()->json(['result' => false, 'message' => "Payment failed"]);
        }
    }

}
