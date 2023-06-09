<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Utility\NagadUtility;
use App\Order;
use App\BusinessSetting;
use App\Seller;
use App\CustomerPackage;
use App\SellerPackage;
use Session;

class NagadController{

    private $amount = null;
    private $tnx = null;

    private $nagadHost;
    private $tnx_status = false;

    private $merchantAdditionalInfo = [];

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        if (config('nagad.sandbox_mode') === 'sandbox') {
            $this->nagadHost = "http://sandbox.mynagad.com:10080/";
        }else{
            $this->nagadHost = "https://api.mynagad.com/";
        }

    }

    public function tnx($id,$status=false)
    {
        $this->tnx = $id;
        $this->tnx_status = $status;
        return $this;
    }

    public function amount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getSession()
    {
        if(Session::has('payment_type')){
            if(Session::get('payment_type') == 'cart_payment'){
                $order = Order::findOrFail(Session::get('order_id'));
                $this->amount($order->grand_total);
                $this->tnx($order->id);
            }
            if(Session::get('payment_type') == 'wallet_payment'){
                $this->amount(round(Session::get('payment_data')['amount']));
                $this->tnx(rand(000000,999999));
            }
            if(Session::get('payment_type') == 'customer_package_payment'){
                $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
                $this->amount(round($customer_package->amount));
                $this->tnx(rand(000000,999999));
            }
            if(Session::get('payment_type') == 'seller_package_payment'){
                $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
                $this->amount(round($seller_package->amount));
                $this->tnx(rand(000000,999999));
            }
        }

        $DateTime = Date('YmdHis');
        $MerchantID = config('nagad.merchant_id');
        //$invoice_no = 'Inv'.Date('YmdH').rand(1000, 10000);
        $invoice_no = $this->tnx_status ? $this->tnx :'Inv'.Date('YmdH').rand(1000, 10000);
        $merchantCallbackURL = config('nagad.callback_url');

        $SensitiveData = [
            'merchantId' => $MerchantID,
            'datetime' => $DateTime,
            'orderId' => $invoice_no,
            'challenge' => NagadUtility::generateRandomString()
        ];

        $PostData = array(
            'accountNumber' => config('nagad.merchant_number'), //optional
            'dateTime' => $DateTime,
            'sensitiveData' => NagadUtility::EncryptDataWithPublicKey(json_encode($SensitiveData)),
            'signature' => NagadUtility::SignatureGenerate(json_encode($SensitiveData))
        );

        $ur = $this->nagadHost."api/dfs/check-out/initialize/" . $MerchantID . "/" . $invoice_no;
        $Result_Data = NagadUtility::HttpPostMethod($ur,$PostData);

        if (isset($Result_Data['sensitiveData']) && isset($Result_Data['signature'])) {
            if ($Result_Data['sensitiveData'] != "" && $Result_Data['signature'] != "") {

                $PlainResponse = json_decode(NagadUtility::DecryptDataWithPrivateKey($Result_Data['sensitiveData']), true);

                if (isset($PlainResponse['paymentReferenceId']) && isset($PlainResponse['challenge'])) {

                    $paymentReferenceId = $PlainResponse['paymentReferenceId'];
                    $randomserver = $PlainResponse['challenge'];

                    $SensitiveDataOrder = array(
                        'merchantId' => $MerchantID,
                        'orderId' => $invoice_no,
                        'currencyCode' => '050',
                        'amount' => $this->amount,
                        'challenge' => $randomserver
                    );


                    // $merchantAdditionalInfo = '{"no_of_seat": "1", "Service_Charge":"20"}';
                    if($this->tnx !== ''){
                        $this->merchantAdditionalInfo['tnx_id'] =  $this->tnx;
                    }
                    // echo $merchantAdditionalInfo;
                    // exit();

                    $PostDataOrder = array(
                        'sensitiveData' => NagadUtility::EncryptDataWithPublicKey(json_encode($SensitiveDataOrder)),
                        'signature' => NagadUtility::SignatureGenerate(json_encode($SensitiveDataOrder)),
                        'merchantCallbackURL' => $merchantCallbackURL,
                        'additionalMerchantInfo' => (object)$this->merchantAdditionalInfo
                    );

                    // echo json_encode($PostDataOrder);
                    // exit();

                    $OrderSubmitUrl = $this->nagadHost."api/dfs/check-out/complete/" . $paymentReferenceId;
                    $Result_Data_Order = NagadUtility::HttpPostMethod($OrderSubmitUrl, $PostDataOrder);
                    try {
                        if ($Result_Data_Order['status'] == "Success") {
                            $url = ($Result_Data_Order['callBackUrl']);
                            return redirect($url);
                            //echo "<script>window.open('$url', '_self')</script>";
                        }
                        else {
                            echo json_encode($Result_Data_Order);
                        }
                    } catch (\Exception $e) {
                        dd($Result_Data_Order);
                    }

                } else {
                    echo json_encode($PlainResponse);
                }
            }
        }

    }

    public function verify(Request $request){
        $Query_String = explode("&", explode("?", $_SERVER['REQUEST_URI'])[1]);
        $payment_ref_id = substr($Query_String[2], 15);
        $url = $this->nagadHost."api/dfs/verify/payment/" . $payment_ref_id;
        $json = NagadUtility::HttpGet($url);
        if(json_decode($json)->status == 'Success'){
            $payment_type = Session::get('payment_type');
            if ($payment_type == 'cart_payment') {
                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done(Session::get('order_id'), $json);
            }
            if ($payment_type == 'wallet_payment') {
                $walletController = new WalletController;
                return $walletController->wallet_payment_done(Session::get('payment_data'), $json);
            }
            if ($payment_type == 'customer_package_payment') {
                $customer_package_controller = new CustomerPackageController;
                return $customer_package_controller->purchase_payment_done(Session::get('payment_data'), $json);
            }
            if($payment_type == 'seller_package_payment') {
                $seller_package_controller = new SellerPackageController;
                return $seller_package_controller->purchase_payment_done(Session::get('payment_data'), $json);
            }
        }
        flash('Payment Failed')->error();
        return redirect()->route('home');
    }
}
