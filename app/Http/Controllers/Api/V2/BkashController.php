<?php


namespace App\Http\Controllers\Api\V2;

use App\Order;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class BkashController extends Controller
{

    public function begin(Request $request)
    {

        $payment_type = $request->payment_type;
        $order_id = $request->order_id;
        $amount = $request->amount;
        $user_id = $request->user_id;

        try {
            $request_data = array('app_key' => env('BKASH_CHECKOUT_APP_KEY'), 'app_secret' => env('BKASH_CHECKOUT_APP_SECRET'));

            $url = curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/grant');
            $request_data_json = json_encode($request_data);

            $header = array(
                'Content-Type:application/json',
                'username:' . env('BKASH_CHECKOUT_USER_NAME'),
                'password:' . env('BKASH_CHECKOUT_PASSWORD')
            );
            curl_setopt($url, CURLOPT_HTTPHEADER, $header);
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url, CURLOPT_POSTFIELDS, $request_data_json);
            curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

            $resultdata = curl_exec($url);
            curl_close($url);
            $token = json_decode($resultdata)->id_token;



            return response()->json([
                'token' => $token,
                'result' => true,
                'url' => route('api.bkash.webpage', ["token" => $token, "amount" => $request->amount]),
                'message' => 'Payment page is found'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'token' => '',
                'result' => false,
                'url' => '',
                'message' => $exception->getMessage()
            ]);
        }


    }

    public function webpage($token, $amount)
    {
        return view('frontend.payment.bkash_app', compact('token', 'amount'));
    }

    public function checkout($token,$amount)
    {
        $auth = $token;

        $callbackURL = route('home');

        $requestbody = array(
            'amount' => $amount,
            'currency' => 'BDT',
            'intent' => 'sale'
        );
        $url = curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/create');
        $requestbodyJson = json_encode($requestbody);

        $header = array(
            'Content-Type:application/json',
            'Authorization:' . $auth,
            'X-APP-Key:' . env('BKASH_CHECKOUT_APP_KEY')
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $requestbodyJson);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);

        return $resultdata;
    }

    public function execute($token, Request $request)
    {
        $paymentID = $request->paymentID;
        $auth = $token;

        $url = curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute/' . $paymentID);
        $header = array(
            'Content-Type:application/json',
            'Authorization:' . $auth,
            'X-APP-Key:' . env('BKASH_CHECKOUT_APP_KEY')
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);

        return $resultdata;
    }

    public function process(Request $request)
    {
        try {

            $payment_type = $request->payment_type;

            if ($payment_type == 'cart_payment') {

                checkout_done($request->order_id, $request->payment_details);
            }

            if ($payment_type == 'wallet_payment') {

                wallet_payment_done($request->user_id, $request->amount, 'Bkash', $request->payment_details);
            }

            return response()->json(['result' => true, 'message' => "Payment is successful"]);


        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }

    public function success(Request $request)
    {
        return response()->json([
            'result' => true,
            'message' => 'Payment Success',
            'payment_details' => $request->payment_details
        ]);

    }

    public function fail(Request $request)
    {
        return response()->json([
            'result' => false,
            'message' => 'Payment Failed',
            'payment_details' => $request->payment_details
        ]);
    }

}

