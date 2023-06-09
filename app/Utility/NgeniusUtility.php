<?php

namespace App\Utility;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use Session;
use Schema;
use DB;

class NgeniusUtility
{
    public static function getUrl($key)
    {
        $mode = self::getMode();
        $url['sandbox']['identity'] = "https://api-gateway.sandbox.ngenius-payments.com/identity/auth/access-token";
        $url['sandbox']['gateway'] = "https://api-gateway.sandbox.ngenius-payments.com";
        // sandbox urls do not work as the identity is not retrived by sandbox identity

        $url['real']['identity'] = "https://identity-uat.ngenius-payments.com/auth/realms/ni/protocol/openid-connect/token";
        $url['real']['gateway'] = "https://api-gateway-uat.ngenius-payments.com";

        return $url[$mode][$key];
    }

    //sandbox or real
    public static function getMode()
    {
        $sandbox = false; //check from db or env
        // sandbox urls do not work as the identity is not retrived by sandbox identity

        return $sandbox ? "sandbox" : "real";
    }

    public static function getAccessToken()
    {
        $apikey = env("NGENIUS_API_KEY"); // set your service account API key (example only)
        $idServiceURL = self::getUrl('identity');                   // set the identity service URL (example only)

        $tokenHeaders = array("Authorization: Basic $apikey", "Content-Type: application/x-www-form-urlencoded");
        $tokenResponse = self::invokeCurlRequest("POST", $idServiceURL, $tokenHeaders, http_build_query(array('grant_type' => 'client_credentials')));

//        $tokenHeaders = array("Authorization: Basic $apikey", "Content-Type: application/vnd.ni-payment.v2+json", "Accept: application/vnd.ni-payment.v2+json");
//        $tokenResponse = self::invokeCurlRequest("POST", $idServiceURL, $tokenHeaders, null);


        $tokenResponse = json_decode($tokenResponse);
        //dd($tokenResponse);
        $access_token = $tokenResponse->access_token;


        return $access_token;
    }


    public static function make_payment($callback_url, $payment_type, $amount)
    {
        $order = new \StdClass();

        $order->action = "SALE";                                        // Transaction mode ("AUTH" = authorize only, no automatic settle/capture, "SALE" = authorize + automatic settle/capture)
        $order->amount = new \stdClass();
        $order->amount->currencyCode = env('NGENIUS_CURRENCY', "AED");                           // Payment currency ('AED' only for now)
        $order->amount->value = $amount;                                   // Minor units (1000 = 10.00 AED)
        $order->language = "en";                                        // Payment page language ('en' or 'ar' only)
        $order->merchantOrderReference = time();                                        // Payment page language ('en' or 'ar' only)
        //$order->merchantAttributes->redirectUrl = "http://premizer.com/test/pp.php";     // A redirect URL to a page on your site to return the customer to
        //$order->merchantAttributes->redirectUrl = "http://192.168.0.111:8080/n-genius/pp.php";     // A redirect URL to a page on your site to return the customer to
        $order->merchantAttributes = new \stdClass();
        $order->merchantAttributes->redirectUrl = $callback_url;
        // A redirect URL to a page on your site to return the customer to
        //$order->merchantAttributes->redirectUrl = "http:// 192.168.0.111:8080/n-genius/pp.php";     // A redirect URL to a page on your site to return the customer to
        $order = json_encode($order);


        $outletRef = env("NGENIUS_OUTLET_ID"); // set your outlet reference/ID value here (example only)
        $txnServiceURL = self::getUrl('gateway') . "/transactions/outlets/$outletRef/orders";             // set the transaction service URL (example only)
        $access_token = self::getAccessToken();

        $orderCreateHeaders = array("Authorization: Bearer " . $access_token, "Content-Type: application/vnd.ni-payment.v2+json", "Accept: application/vnd.ni-payment.v2+json");
        $orderCreateResponse = self::invokeCurlRequest("POST", $txnServiceURL, $orderCreateHeaders, $order);

        $orderCreateResponse = json_decode($orderCreateResponse);

        //dd($callback_url,$orderCreateResponse);

        $paymentLink = $orderCreateResponse->_links->payment->href;     // the link to the payment page for redirection (either full-page redirect or iframe)
        $orderReference = $orderCreateResponse->reference;              // the reference to the order, which you should store in your records for future interaction with this order

        session()->save();

        /*echo "<!DOCTYPE html>
        <html>
        <script type=\"text/javascript\">
        window.location = \"$paymentLink\";

        </script>
        </html>";*/

        header("Location: " . $paymentLink);                     // execute redirect
        exit;


    }

    public static function check_callback($orderRef, $payment_type)
    {
        $outletRef = env("NGENIUS_OUTLET_ID"); // set your outlet reference/ID value here (example only)
        $orderCheckURL = self::getUrl('gateway') . "/transactions/outlets/$outletRef/orders/$orderRef";             // set the transaction service URL (example only)
        $access_token = self::getAccessToken();

        $headers = array("Authorization: Bearer " . $access_token);
        $orderStatusResponse = self::invokeCurlRequest("GET", $orderCheckURL, $headers, null);

        $orderStatusResponse = json_decode($orderStatusResponse);

        if ($orderStatusResponse->_embedded->payment[0]->state == "FAILED") {
            // fail or cancel or incomplete
            Session::forget('payment_data');
            flash(translate('Payment incomplete'))->error();
            return redirect()->route('home');

        } else if ($orderStatusResponse->_embedded->payment[0]->state == "CAPTURED") {
            // success

            $payment = json_encode($orderStatusResponse);

            //dd($payment_type, Session::get('order_id'),Session::get('payment_data'), $payment);

            if ($payment_type == 'cart_payment') {
                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done(session()->get('order_id'), $payment);
            }

            if ($payment_type == 'wallet_payment') {
                $walletController = new WalletController;
                return $walletController->wallet_payment_done(Session::get('payment_data'), $payment);
            }

            if ($payment_type == 'customer_package_payment') {
                $customer_package_controller = new CustomerPackageController;
                return $customer_package_controller->purchase_payment_done(session()->get('payment_data'), $payment);
            }

            if ($payment_type == 'seller_package_payment') {
                $seller_package_controller = new \App\Http\Controllers\SellerPackageController;
                return $seller_package_controller->purchase_payment_done(session()->get('payment_data'), $payment);
            }

        }
    }

    public static function invokeCurlRequest($type, $url, $headers, $post)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($type == "POST") {

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        }

        $server_output = curl_exec($ch);
        // print_r($server_output);
        // exit();
        curl_close($ch);

        return $server_output;

    }

    public static function callCurlRequest(){
		//bugs
    }
}
