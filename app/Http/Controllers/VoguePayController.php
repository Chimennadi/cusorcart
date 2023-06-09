<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;
use App\BusinessSetting;
use App\Seller;

class VoguePayController extends Controller
{
    public function customer_showForm()
    {
        if (Session::get('payment_type') == 'cart_payment') {
            return view('frontend.voguepay.cart_payment_vogue');
        }
        elseif (Session::get('payment_type') == 'wallet_payment') {
            return view('frontend.voguepay.wallet_payment_vogue');
        }
        elseif (Session::get('payment_type') == 'customer_package_payment') {
            return view('frontend.voguepay.customer_package_payment_vogue');
        }
    }

    public function paymentSuccess($id)
    {
        if (BusinessSetting::where('type', 'voguepay_sandbox')->first()->value == 1) {
            $url = '//voguepay.com/?v_transaction_id='.$id.'&type=json&demo=true';
        }
        else {
            $url = '//voguepay.com/?v_transaction_id='.$id.'&type=json';
        }
        $client = new Client();
        $response = $client->request('GET',$url);
        $obj = json_decode($response->getBody());

        if($obj->response_message == 'Approved'){
            $payment_detalis = json_encode($obj);
            // dd($payment_detalis);
            if(Session::has('payment_type')){
                if(Session::get('payment_type') == 'cart_payment'){
                    $checkoutController = new CheckoutController;
                    return $checkoutController->checkout_done(Session::get('order_id'), $payment_detalis);
                }
                elseif (Session::get('payment_type') == 'wallet_payment') {
                    $walletController = new WalletController;
                    return $walletController->wallet_payment_done(Session::get('payment_data'), $payment_detalis);
                }
                elseif (Session::get('payment_type') == 'customer_package_payment') {
                    $customer_package_controller = new CustomerPackageController;
                    return $customer_package_controller->purchase_payment_done(Session::get('payment_data'), $payment);
                }
            }
        }
        else {
            flash(translate('Payment Failed'))->error();
            return redirect()->route('home');
        }
    }

    public function paymentFailure($id)
    {
        flash(translate('Payment Failed'))->error();
        return redirect()->route('home');
    }
}
