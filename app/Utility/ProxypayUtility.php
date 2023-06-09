<?php

namespace App\Utility;

use Carbon\Carbon;
use Session;

class ProxypayUtility
{
    public static function generate_reference_number()
    {        
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . env('PROXYPAY_TOKEN'),
            "Accept: application/vnd.proxypay.v2+json",
        ];

        $url = 'https://api.proxypay.co.ao';
        if (get_setting('proxypay_sandbox') == 1) {
            $url = "https://api.sandbox.proxypay.co.ao/reference_ids";
        }
        
        $opts = [
            CURLOPT_URL             => $url,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTPHEADER      => $httpHeader
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        
        if($httpcode == 200) {
            // dd($response);
        } else {
            dd("Something went wrong!");
        }
        
        curl_close($curl);

        return $response;
    }

    public static function create_reference($reference_number, $amount, $user_id, $order_id = null, $package_id = null) 
    {
        $endTime = Carbon::now()->addDays(env('PROXYPAY_END_TIME'))->toDateString();
        
        $reference = [
            "amount"        => $amount,
            "end_datetime"  => $endTime,
            "custom_fields" => [
              "order_id" => $order_id,
              "user_id" => $user_id,
              "package_id" => $package_id,
              "entity" => env('PROXYPAY_ENTITY'),
              "payment_type" => Session::get('payment_type'),
              "reference" => $reference_number
            ]
        ];
        
        $data = json_encode($reference);
        
        $url = "https://api.sandbox.proxypay.co.ao/references".$reference_number;
        if (get_setting('proxypay_sandbox') == 1) {
            $url = "https://api.sandbox.proxypay.co.ao/references/".$reference_number;
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
            CURLOPT_CUSTOMREQUEST   => "PUT",
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
        if($httpcode == 204) {
            return $data;        
        }
        
        dd($response, $reference);
        return false;

    }


}
