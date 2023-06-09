<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create_payment()
    {
        $reference = [
            "amount"        => "9701.84",
            "end_datetime"  => "2021-12-31",
            "custom_fields" => [
              "invoice" => "2018/0333"
            ]
        ];

        $data = json_encode($reference);

        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . "im5lqr34fwt37vougnpe4nuizu6exzlf",
            "Accept: application/vnd.proxypay.v2+json",
            "Content-Type: application/json",
            "Content-Length: " . strlen($data)
        ];

        $opts = [
            CURLOPT_URL             => "https://api.sandbox.proxypay.co.ao/references/904800000",
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

        curl_close($curl);
    }

    public function payments()
    {
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . "im5lqr34fwt37vougnpe4nuizu6exzlf",
            "Accept: application/vnd.proxypay.v2+json",
        ];

        $opts = [
            CURLOPT_URL             => "https://api.sandbox.proxypay.co.ao/payments",
            CURLOPT_CUSTOMREQUEST   => "GET",
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTPHEADER      => $httpHeader
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        dd(json_decode($response), $err);
        curl_close($curl);
    }

    public function mock_payment()
    {
        $payment = [
            "reference_id"  => 574850000,
            "amount"        => "380.44"
        ];

        $data = json_encode($payment);

        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . "im5lqr34fwt37vougnpe4nuizu6exzlf",
            "Accept: application/vnd.proxypay.v2+json",
            "Content-Type: application/json",
            "Content-Length: " . strlen($data)
        ];

        $opts = [
            CURLOPT_URL             => "https://api.sandbox.proxypay.co.ao/payments",
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

        dd($response, $err);

        curl_close($curl);
    }

    public function reference_ids()
    {
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . "im5lqr34fwt37vougnpe4nuizu6exzlf",
            "Accept: application/vnd.proxypay.v2+json",
        ];

        $opts = [
            CURLOPT_URL             => "https://api.sandbox.proxypay.co.ao/reference_ids",
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTPHEADER      => $httpHeader
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        dd($response);
        $err = curl_error($curl);

        curl_close($curl);
    }

}
