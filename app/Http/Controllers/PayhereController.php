<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use App\Utility\PayhereUtility;
use Redirect;
use App\Order;
use App\BusinessSetting;
use App\Seller;
use Session;
use App\CustomerPackage;
use App\Http\Controllers\CommissionController;
use Auth;
use Twilio\TwiML\Voice\Pay;
use Storage;

class PayhereController extends Controller
{
    private $security_key;

    public function __construct()
    {

    }

    public function checkout_testing()
    {
        $order_id = rand(100000, 999999);
        $amount = 88.00;
        $first_name = 'Hasan';
        $last_name = 'Taluker';
        $phone = '2135421321';
        $email = 'hasan@taluker.com';
        $address = '22/b baker street';
        $city = 'Colombo';

        return PayhereUtility::create_checkout_form($order_id, $amount, $first_name, $last_name, $phone, $email, $address, $city);
    }

    public function wallet_testing()
    {
        $order_id = rand(100000, 999999);
        $user_id = Auth::user()->id;
        $amount = 88.00;
        $first_name = 'Hasan';
        $last_name = 'Taluker';
        $phone = '2135421321';
        $email = 'hasan@taluker.com';
        $address = '22/b baker street';
        $city = 'Colombo';

        return PayhereUtility::create_wallet_form($user_id, $order_id, $amount, $first_name, $last_name, $phone, $email, $address, $city);
    }

    public function customer_package_payment_testing()
    {
        $order_id = rand(100000, 999999);
        $user_id = Auth::user()->id;
        $package_id = 4;
        $amount = 88.00;
        $first_name = 'Hasan';
        $last_name = 'Taluker';
        $phone = '2135421321';
        $email = 'hasan@taluker.com';
        $address = '22/b baker street';
        $city = 'Colombo';

        return PayhereUtility::create_customer_package_form($user_id,$package_id, $order_id, $amount, $first_name, $last_name, $phone, $email, $address, $city);
    }


    //sample response
    /*
     {
       "merchant_id":"1215091",
       "order_id":"196696714",
       "payment_id":"320025078020",
       "payhere_amount":"99.00",
       "payhere_currency":"LKR",
       "status_code":"2",
       "md5sig":"F889DBDF7BF987529C77096E465B749B",
       "custom_1":"788392",
       "custom_2":"",
       "status_message":"Successfully completed the payment.",
       "method":"TEST",
       "card_holder_name":"ddd",
       "card_no":"************1292",
       "card_expiry":"1221",
       "recurring":"0"
    }
    */


    //checkout related functions ------------------------------------<starts>
    public static function checkout_notify()
    {
        $merchant_id = $_POST['merchant_id'];
        $order_id = $_POST['order_id'];
        $payhere_amount = $_POST['payhere_amount'];
        $payhere_currency = $_POST['payhere_currency'];
        $status_code = $_POST['status_code'];
        $md5sig = $_POST['md5sig'];

        $merchant_secret = env('PAYHERE_SECRET'); // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)

        $local_md5sig = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret))));

        if (($local_md5sig === $md5sig) and ($status_code == 2)) {
            //custom_1 will have order_id
            return PayhereController::checkout_success($_POST['custom_1'],$_POST);
        }

        return PayhereController::checkout_incomplete();
    }

    public static function checkout_return()
    {
        Session::put('cart', collect([]));
        Session::forget('payment_type');
        Session::forget('delivery_info');
        Session::forget('coupon_id');
        Session::forget('coupon_discount');

        flash(translate('Payment process completed'))->success();
        return redirect()->route('order_confirmed');
    }

    public static function checkout_cancel()
    {
        return PayhereController::checkout_incomplete();
    }

    public static function checkout_success($order_id,$responses)
    {
        $payment_details = json_encode($responses);
        $checkoutController = new CheckoutController;
        return $checkoutController->checkout_done($order_id, $payment_details);
    }

    public static function checkout_incomplete()
    {
        Session::forget('order_id');
        flash(translate("Incomplete"))->error();
        //flash(translate('Payment failed'))->error();
        //dd($response_text);
        return redirect()->route('home')->send();
    }
    //checkout related functions ------------------------------------<ends>

    //wallet related functions ------------------------------------<starts>
    public static function wallet_notify()
    {
        $merchant_id = $_POST['merchant_id'];
        $order_id = $_POST['order_id'];
        $payhere_amount = $_POST['payhere_amount'];
        $payhere_currency = $_POST['payhere_currency'];
        $status_code = $_POST['status_code'];
        $md5sig = $_POST['md5sig'];

        $merchant_secret = env('PAYHERE_SECRET'); // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)

        $local_md5sig = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret))));

        if (($local_md5sig === $md5sig) and ($status_code == 2)) {
            //custom_1 will have user_id
            return PayhereController::wallet_success($_POST['custom_1'],$payhere_amount,$_POST);
        }

        return PayhereController::wallet_incomplete();
    }

    public static function wallet_return()
    {
        Session::forget('payment_data');
        Session::forget('payment_type');

        flash(translate('Payment process completed'))->success();
        return redirect()->route('wallet.index');
    }

    public static function wallet_cancel()
    {
        return PayhereController::wallet_incomplete();
    }

    public static function wallet_success($id,$amount,$payment_details)
    {
        $user = User::find($id);
        $user->balance = $user->balance + $amount;
        $user->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->amount = $amount;
        $wallet->payment_method = 'payhere';
        $wallet->payment_details = json_encode($payment_details);
        $wallet->save();
    }

    public static function wallet_incomplete()
    {
        Session::forget('payment_data');
        flash(translate('Payment Incomplete'))->error();
        return redirect()->route('home')->send();
    }
    //wallet related functions ------------------------------------<ends>

    //customer package related functions ------------------------------------<starts>
    public static function customer_package_notify()
    {
        $merchant_id = $_POST['merchant_id'];
        $order_id = $_POST['order_id'];
        $payhere_amount = $_POST['payhere_amount'];
        $payhere_currency = $_POST['payhere_currency'];
        $status_code = $_POST['status_code'];
        $md5sig = $_POST['md5sig'];

        $merchant_secret = env('PAYHERE_SECRET'); // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)

        $local_md5sig = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret))));

        if (($local_md5sig === $md5sig) and ($status_code == 2)) {
            //custom_1 will have user_id custom_2 will have package_id
            return PayhereController::customer_package_success($_POST['custom_1'],$_POST['custom_2'],$_POST);
        }

        return PayhereController::customer_package_incomplete();
    }

    public static function customer_package_return()
    {
        Session::forget('payment_data');
        flash(translate('Payment process completed'))->success();
        return redirect()->route('dashboard');
    }

    public static function customer_package_cancel()
    {
        return PayhereController::customer_package_incomplete();
    }

    public static function customer_package_success($id,$customer_package_id,$payment_details)
    {
        $user = User::findOrFail($id);
        $user->customer_package_id = $customer_package_id;
        $customer_package = CustomerPackage::findOrFail($customer_package_id);
        $user->remaining_uploads += $customer_package->product_upload;
        $user->save();
    }

    public static function customer_package_incomplete()
    {
        Session::forget('payment_data');
        flash(translate("Payment Incomplete"))->error();
        return redirect()->route('home')->send();
    }
    //customer package related functions ------------------------------------<ends>


    public function migrate_seller_package_payment(Request $request){
		//bugs
    }


}
