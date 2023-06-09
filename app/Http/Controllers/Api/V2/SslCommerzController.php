<?php


namespace App\Http\Controllers\Api\V2;


use App\BusinessSetting;
use App\Http\Controllers\SSLCommerz;
use App\Order;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class SslCommerzController extends Controller
{
    public $sslc_submit_url;
    public $sslc_validation_url;
    public $sslc_mode;
    public $sslc_data;
    public $store_id;
    public $store_pass;
    public $error = '';

    public function __construct()
    {
        # IF SANDBOX TRUE, THEN IT WILL CONNECT WITH SSLCOMMERZ SANDBOX (TEST) SYSTEM
        if (BusinessSetting::where('type', 'sslcommerz_sandbox')->first()->value == 1) {
            define("SSLCZ_IS_SANDBOX", true);
        } else {
            define("SSLCZ_IS_SANDBOX", false);
        }

        $this->setSSLCommerzMode((SSLCZ_IS_SANDBOX) ? 1 : 0);
        $this->store_id = env('SSLCZ_STORE_ID');
        $this->store_pass = env('SSLCZ_STORE_PASSWD');

        $this->sslc_submit_url = "https://" . $this->sslc_mode . ".sslcommerz.com/gwprocess/v3/api.php";
        $this->sslc_validation_url = "https://" . $this->sslc_mode . ".sslcommerz.com/validator/api/validationserverAPI.php";
    }

    public function begin(Request $request)
    {

        $payment_type = $request->payment_type;
        $order_id = $request->order_id;
        $amount = $request->amount;
        $user_id = $request->user_id;

        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";

        if ($request->payment_type == "cart_payment") {
            $post_data['tran_id'] = 'ADMO-' . $request->order_id . '-' . date('Ymd'); // tran_id must be unique

        } else if ($request->payment_type == "wallet_payment") {
            $post_data['tran_id'] = 'ADMW-' . $request->user_id . '-' . date('Ymd');
        }

        $post_data['value_a'] = $post_data['tran_id'];

        if ($request->payment_type == "cart_payment") {
            $post_data['value_b'] = $request->order_id;
            $post_data['value_c'] = $request->payment_type;
            $post_data['value_d'] = $request->amount;
        } else if ($request->payment_type == "wallet_payment") {
            $post_data['value_a'] = $request->user_id;
            $post_data['value_b'] = 'sslcommerz';
            $post_data['value_c'] = $request->payment_type;
            $post_data['value_d'] = $request->amount;

        }


        # CUSTOMER INFORMATION
        $post_data['cus_name'] = "Customer Name";
        $post_data['cus_add1'] = "Customer Address";
        $post_data['cus_city'] = "Customer City";
        $post_data['cus_postcode'] = "1234";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = "123456123";
        $post_data['cus_email'] = "some@mail.com";


        $post_data['success_url'] = url("api/v2/sslcommerz/success");
        $post_data['fail_url'] = url("api/v2/sslcommerz/fail");
        $post_data['cancel_url'] = url("api/v2/sslcommerz/cancel");

        return $this->initiate($post_data);

    }

    public function payment_success(Request $request)
    {
        $sslc = new SSLCommerz();
        #Start to received these value from session. which was saved in index function.
        $tran_id = $request->value_a;
        #End to received these value from session. which was saved in index function.
        $payment = json_encode($request->all());

        if (isset($request->value_c)) {

            try {
                if ($request->value_c == 'cart_payment') {

                    checkout_done($request->value_b, $payment);


                } elseif ($request->value_c == 'wallet_payment') {

                    wallet_payment_done($request->value_a, $request->value_d, 'SslCommerz', $payment);

                }

                return response()->json(['result' => true, 'message' => "Payment is successful"]);
            } catch (\Exception $e) {
                return response()->json(['result' => false, 'message' => $e->getMessage()]);
            }


        }

        return response()->json([
            'result' => false,
            'message' => 'Payment Failed'
        ]);

        /*return response()->json([
            'result' => false,
            'payment_type'=> $payment_type,
            'message' => 'Payment Successful'
        ]);*/
    }

    public function payment_process(Request $request)
    {

    }

    public function payment_fail(Request $request)
    {
        return response()->json([
            'result' => false,
            'message' => 'Payment Failed'
        ]);
    }

    public function payment_cancel(Request $request)
    {
        return response()->json([
            'result' => false,
            'message' => 'Payment Cancelled'
        ]);
    }


    public function initiate($post_data)
    {
        /*return response()->json([
            'post_data' => json_encode($post_data),
            'result' => false,
            'url' => '',
            'message' => "gg",
        ]);*/

        if ($post_data != '' && is_array($post_data)) {

            $post_data['store_id'] = $this->store_id;
            $post_data['store_passwd'] = $this->store_pass;

            $load_sslc = $this->sendRequest($post_data);

            if ($load_sslc) {
                if (isset($this->sslc_data['status']) && $this->sslc_data['status'] == 'SUCCESS') {
                    if (isset($this->sslc_data['GatewayPageURL']) && $this->sslc_data['GatewayPageURL'] != '') {

                        return response()->json([
                            'result' => true,
                            'url' => $this->sslc_data['GatewayPageURL'],
                            'message' => 'Redirect Url is found'
                        ]);
                    } else {
                        return response()->json([
                            'result' => false,
                            'url' => '',
                            'message' => 'No redirect URL found!'
                        ]);
                    }

                } else {

                    return response()->json([
                        'result' => false,
                        'url' => '',
                        'message' => "Invalid Credential!",
                    ]);
                }

            } else {

                return response()->json([
                    'result' => false,
                    'url' => '',
                    'message' => "Connectivity Issue. Please contact your sslcommerz manager",
                ]);
            }
        } else {

            return response()->json([
                'result' => false,
                'url' => '',
                'message' => "Please provide a valid information list about transaction with transaction id, amount, success url, fail url, cancel url, store id and pass at least",
            ]);
        }

    }


    # SEND CURL REQUEST
    public function sendRequest($data)
    {


        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $this->sslc_submit_url);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        if (SSLCZ_IS_LOCAL_HOST) {
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        } else {
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2); // Its default value is now 2
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
        }


        $content = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !(curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzResponse = $content;

            # PARSE THE JSON RESPONSE
            $this->sslc_data = json_decode($sslcommerzResponse, true);

            return $this;
        } else {
            curl_close($handle);
            $msg = "FAILED TO CONNECT WITH SSLCOMMERZ API";
            $this->error = $msg;
            return false;
        }
    }

    # SET SSLCOMMERZ PAYMENT MODE - LIVE OR TEST
    public function setSSLCommerzMode($test)
    {
        if ($test) {
            $this->sslc_mode = "sandbox";
        } else {
            $this->sslc_mode = "securepay";
        }
    }

    # VALIDATE SSLCOMMERZ TRANSACTION
    public function sslcommerz_validate($merchant_trans_id, $merchant_trans_amount, $merchant_trans_currency, $post_data)
    {
        # MERCHANT SYSTEM INFO
        if ($merchant_trans_id != "" && $merchant_trans_amount != 0) {

            # CALL THE FUNCTION TO CHECK THE RESUKT
            $post_data['store_id'] = $this->store_id;
            $post_data['store_pass'] = $this->store_pass;

            if ($this->SSLCOMMERZ_hash_varify($this->store_pass, $post_data)) {

                $val_id = urlencode($post_data['val_id']);
                $store_id = urlencode($this->store_id);
                $store_passwd = urlencode($this->store_pass);
                $requested_url = ($this->sslc_validation_url . "?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

                $handle = curl_init();
                curl_setopt($handle, CURLOPT_URL, $requested_url);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

                if (SSLCZ_IS_LOCAL_HOST) {
                    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
                } else {
                    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2);// Its default value is now 2
                    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
                }


                $result = curl_exec($handle);

                $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

                if ($code == 200 && !(curl_errno($handle))) {

                    # TO CONVERT AS ARRAY
                    # $result = json_decode($result, true);
                    # $status = $result['status'];

                    # TO CONVERT AS OBJECT
                    $result = json_decode($result);
                    $this->sslc_data = $result;

                    # TRANSACTION INFO
                    $status = $result->status;
                    $tran_date = $result->tran_date;
                    $tran_id = $result->tran_id;
                    $val_id = $result->val_id;
                    $amount = $result->amount;
                    $store_amount = $result->store_amount;
                    $bank_tran_id = $result->bank_tran_id;
                    $card_type = $result->card_type;
                    $currency_type = $result->currency_type;
                    $currency_amount = $result->currency_amount;

                    # ISSUER INFO
                    $card_no = $result->card_no;
                    $card_issuer = $result->card_issuer;
                    $card_brand = $result->card_brand;
                    $card_issuer_country = $result->card_issuer_country;
                    $card_issuer_country_code = $result->card_issuer_country_code;

                    # API AUTHENTICATION
                    $APIConnect = $result->APIConnect;
                    $validated_on = $result->validated_on;
                    $gw_version = $result->gw_version;

                    # GIVE SERVICE
                    if ($status == "VALID" || $status == "VALIDATED") {
                        if ($merchant_trans_currency == "BDT") {
                            if (trim($merchant_trans_id) == trim($tran_id) && (abs($merchant_trans_amount - $amount) < 1) && trim($merchant_trans_currency) == trim('BDT')) {
                                return true;
                            } else {
                                # DATA TEMPERED
                                $this->error = "Data has been tempered";
                                return false;
                            }
                        } else {
                            //echo "trim($merchant_trans_id) == trim($tran_id) && ( abs($merchant_trans_amount-$currency_amount) < 1 ) && trim($merchant_trans_currency)==trim($currency_type)";
                            if (trim($merchant_trans_id) == trim($tran_id) && (abs($merchant_trans_amount - $currency_amount) < 1) && trim($merchant_trans_currency) == trim($currency_type)) {
                                return true;
                            } else {
                                # DATA TEMPERED
                                $this->error = "Data has been tempered";
                                return false;
                            }
                        }
                    } else {
                        # FAILED TRANSACTION
                        $this->error = "Failed Transaction";
                        return false;
                    }
                } else {
                    # Failed to connect with SSLCOMMERZ
                    $this->error = "Faile to connect with SSLCOMMERZ";
                    return false;
                }
            } else {
                # Hash validation failed
                $this->error = "Hash validation failed";
                return false;
            }
        } else {
            # INVALID DATA
            $this->error = "Invalid data";
            return false;
        }
    }

    # FUNCTION TO CHECK HASH VALUE
    public function SSLCOMMERZ_hash_varify($store_passwd = "", $post_data)
    {

        if (isset($post_data) && isset($post_data['verify_sign']) && isset($post_data['verify_key'])) {
            # NEW ARRAY DECLARED TO TAKE VALUE OF ALL POST
            $pre_define_key = explode(',', $post_data['verify_key']);

            $new_data = array();
            if (!empty($pre_define_key)) {
                foreach ($pre_define_key as $value) {
                    if (isset($post_data[$value])) {
                        $new_data[$value] = ($post_data[$value]);
                    }
                }
            }
            # ADD MD5 OF STORE PASSWORD
            $new_data['store_passwd'] = md5($store_passwd);

            # SORT THE KEY AS BEFORE
            ksort($new_data);

            $hash_string = "";
            foreach ($new_data as $key => $value) {
                $hash_string .= $key . '=' . ($value) . '&';
            }
            $hash_string = rtrim($hash_string, '&');

            if (md5($hash_string) == $post_data['verify_sign']) {

                return true;

            } else {
                $this->error = "Verification signature not matched";
                return false;
            }
        } else {
            $this->error = 'Required data mission. ex: verify_key, verify_sign';
            return false;
        }
    }

    # FUNCTION TO GET IMAGES FROM WEB
    public function _get_image($gw = "", $source = array())
    {
        $logo = "";
        if (!empty($source) && isset($source['desc'])) {

            foreach ($source['desc'] as $key => $volume) {

                if (isset($volume['gw']) && $volume['gw'] == $gw) {

                    if (isset($volume['logo'])) {
                        $logo = str_replace("/gw/", "/gw1/", $volume['logo']);
                        break;
                    }
                }
            }
            return $logo;
        } else {
            return "";
        }
    }

    public function getResultData()
    {
        return $this->sslc_data;
    }
}
