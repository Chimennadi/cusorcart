<?php


namespace App\Http\Controllers\Api\V2;


use App\BusinessSetting;
use App\Utility\NagadUtility;
use App\Order;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class NagadController
{

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
        } else {
            $this->nagadHost = "https://api.mynagad.com/";
        }

    }

    public function begin(Request $request)
    {
        $this->amount = $request->amount;
        $this->tnx_status = false;

        $payment_type = $request->payment_type;
        $order_id = $request->order_id;
        $amount = $request->amount;
        $user_id = $request->user_id;

        if ($request->payment_type == 'cart_payment') {
            $this->tnx = $request->order_id;
        } else if ($request->payment_type == 'wallet_payment') {
            $this->tnx = rand(10000, 99999);
        }

        return $this->getSession($request->payment_type);
    }


    public function getSession($payment_type)
    {

        $DateTime = Date('YmdHis');
        $MerchantID = config('nagad.merchant_id');
        //$invoice_no = 'Inv'.Date('YmdH').rand(1000, 10000);
        $invoice_no = $this->tnx_status ? $this->tnx : 'Inv' . Date('YmdH') . rand(1000, 10000);
        $merchantCallbackURL = route('app.nagad.callback_url', ['payment_type' => $payment_type]);

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

        $ur = $this->nagadHost . "api/dfs/check-out/initialize/" . $MerchantID . "/" . $invoice_no;
        $Result_Data = NagadUtility::HttpPostMethod($ur, $PostData);

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
                    if ($this->tnx !== '') {
                        $this->merchantAdditionalInfo['tnx_id'] = $this->tnx;
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

                    $OrderSubmitUrl = $this->nagadHost . "api/dfs/check-out/complete/" . $paymentReferenceId;
                    $Result_Data_Order = NagadUtility::HttpPostMethod($OrderSubmitUrl, $PostDataOrder);
                    //dd($Result_Data_Order);
                    if ($Result_Data_Order['status'] == "Success") {
                        return response()->json([
                            'data' => $Result_Data_Order,
                            'result' => true,
                            'url' => $Result_Data_Order['callBackUrl'],
                            'message' => 'Redirect Url is found'
                        ]);
                    } else {
                        return response()->json([
                            'data' => $Result_Data_Order,
                            'result' => false,
                            'url' => '',
                            'message' => 'Could not generate payment link'
                        ]);
                    }
                } else {
                    return response()->json([
                        'data' => $PlainResponse,
                        'result' => false,
                        'url' => '',
                        'message' => 'Payment reference id or challenge is missing'
                    ]);
                }
            } else {
                return response()->json([
                    'data' => null,
                    'result' => false,
                    'url' => '',
                    'message' => 'Sensitive data or Signature is empty'
                ]);
            }
        } else {
            return response()->json([
                'data' => null,
                'result' => false,
                'url' => '',
                'message' => 'Sensitive data or Signature is missing'
            ]);
        }

    }

    public function verify(Request $request, $payment_type)
    {
        $Query_String = explode("&", explode("?", $_SERVER['REQUEST_URI'])[1]);
        $payment_ref_id = substr($Query_String[2], 15);
        $url = $this->nagadHost . "api/dfs/verify/payment/" . $payment_ref_id;
        $json = NagadUtility::HttpGet($url);
        if (json_decode($json)->status == 'Success') {
            return response()->json([
                'result' => true,
                'message' => 'Payment Processing',
                'payment_details' => $json
            ]);
        }
        return response()->json([
            'result' => false,
            'message' => 'Payment failed !',
            'payment_details' => ''
        ]);


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
}
