<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utility\ProxypayUtility;
use App\Order;
use App\ProxyPayment;
use App\CustomerPackage;
use App\BusinessSetting;
use Session;
use Artisan;
use Auth;

class ProxypayController extends Controller
{
    public function create_reference($request)
    {
        $reference_number = '';
        $amount = 0.00;
        $user_id = ''.Auth::user()->id.'';
        $order_id = '';
        $package_id = '';
        
        
        if(Session::get('payment_type') == 'cart_payment'){
            $order = Order::findOrFail($request->session()->get('order_id'));
            $order_id = ''.$order->id.'';
            $amount = $order->grand_total;
        }
        
        elseif (Session::get('payment_type') == 'wallet_payment') {
            $amount= Session::get('payment_data')['amount'];
        }
        
        elseif (Session::get('payment_type') == 'customer_package_payment') {
            $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
            $package_id = ''.$customer_package->id.'';
            $amount = $customer_package->amount;
        }
        
        elseif (Session::get('payment_type') == 'seller_package_payment') {
            $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
            $amount = $seller_package->amount;
        }
        
        $reference_number = ProxypayUtility::generate_reference_number();
        
        $payment_detalis = ProxypayUtility::create_reference($reference_number, $amount, $user_id, $order_id, $package_id);
        
        if(!$payment_detalis) {
            flash(translate('Payment Failed'))->error();
            return redirect()->route('home');
        }
        // dd($reference_number);
        
        if(Session::has('payment_type')){
            $proxy_payments = new ProxyPayment;
                
            $proxy_payments->payment_type = Session::get('payment_type');
            $proxy_payments->reference_id = $reference_number;
            $proxy_payments->order_id = $order_id;
            $proxy_payments->user_id = $user_id;
            $proxy_payments->package_id = $package_id;
            $proxy_payments->amount = 0.0;
            
            $proxy_payments->save();
            if(Session::get('payment_type') == 'cart_payment'){
                flash('Your order has been placed. Kindly pay to proxypay.');
                return redirect()->route('order_confirmed');
//                $checkoutController = new CheckoutController;
//                return $checkoutController->checkout_done(Session::get('order_id'), $payment_detalis);
            }
            elseif (Session::get('payment_type') == 'wallet_payment') {
                flash(translate('Your request for wallet recharge has been accepted. Kindly pay on proxypay to confirm.'))->success();
                return back();
            }
            elseif (Session::get('payment_type') == 'customer_package_payment') {
                flash(translate('Your request for customer package has been accepted. Kindly pay on proxypay to confirm.'))->success();
                return back();
            }
            elseif (Session::get('payment_type') == 'seller_package_payment') {
//                $seller_package_controller = new SellerPackageController;
//                return $seller_package_controller->purchase_payment_done(Session::get('payment_data'), $payment);
            }
        }
               
    }

    public function webhook_response(Request $request)
    {
        $api_key = env('PROXYPAY_TOKEN');

        $input = @file_get_contents("php://input");
        $header_signature = $_SERVER['HTTP_X_SIGNATURE'];

        $signature = hash_hmac('sha256', $input, $api_key);

        if ( $signature == $header_signature )
        {
            
            $payment = json_decode($input);
            
            $reference_number = $payment->reference_id;
            $amount = $payment->amount;
            $user_id = $payment->custom_fields->user_id;
            
            $proxy_payments = new ProxyPayment;
            
            $proxy_payments->payment_type = $payment->custom_fields->payment_type;
            $proxy_payments->reference_id = $reference_number;
            $proxy_payments->user_id = $user_id;
            
            if(property_exists($payment->custom_fields, 'order_id')) {
                $order_id = $payment->custom_fields->order_id;
                $proxy_payments->order_id = $order_id;
            }
            if(property_exists($payment->custom_fields, 'package_id')) {
                $package_id = $payment->custom_fields->package_id;
                $proxy_payments->package_id = $package_id;
            }
            
            $proxy_payments->amount = $amount;
            
            $proxy_payments->save();
            
            if($payment->custom_fields->payment_type == 'cart_payment'){
                $order = Order::findOrFail($order_id);
                $amounts_paid = ProxyPayment::where('order_id', $order_id)->get()->sum('amount');
                
                if($amounts_paid >= $order->grand_total) {
                    $order->payment_status = 'paid';
                    commission_calculation($order);
                    
                    $order->commission_calculated = 1;
                    $order->save();
                        
                }
                
            } elseif ($payment->custom_fields->payment_type == 'wallet_payment') {
               wallet_payment_done($user_id, $amount, 'proxy_pay', json_encode($payment));
            } elseif ($payment->custom_fields->payment_type == 'customer_package_payment') {
                $amounts_paid = ProxyPayment::where('reference_id', 'LIKE' , $reference_number)->get()->sum('amount');
                $customer_package = CustomerPackage::findOrFail($package_id);
                
                if($amounts_paid >= $customer_package->amount) {
                    $status = purchase_payment_done($user_id, $package_id);
                }
                
            } elseif ($payment->custom_fields->payment_type == 'seller_package_payment') {
               
            }
            
            
            // handle payment event

            http_response_code(204);
        } else {
            http_response_code(400);
        }
        
    }
    
    public function mock_payment(Request $request)
    {
        $payment = [
            "reference_id"  => $request->reference_id,
            "amount"        => $request->amount
        ];
        
        // dd($request->all());

        $data = json_encode($payment);
        
        Artisan::call('cache:clear');
        
        // dd(env('PROXYPAY_TOKEN'), get_setting('proxypay_sandbox'));
        
        $url = 'https://api.proxypay.co.ao/payments';
        if (get_setting('proxypay_sandbox') == 1) {
            $url = "https://api.sandbox.proxypay.co.ao/payments";
        }

        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . env('PROXYPAY_TOKEN'),
            "Accept: application/vnd.proxypay.v2+json",
            "Content-Type: application/json",
            "Content-Length: " . strlen($data)
        ];

        $opts = [
            CURLOPT_URL             => $url,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTPHEADER      => $httpHeader,
            CURLOPT_POSTFIELDS      => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if($httpcode == 200) {
            dd($httpcode, $response, $err);
        }
        
        dd($httpcode, $response, $err);

        curl_close($curl);
    }

}
