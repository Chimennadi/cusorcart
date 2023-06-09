<?php

namespace App\Utility;

class MimoUtility
{
    public static function getToken() 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '52.30.114.86:8080/mimosms/v1/user/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "username": "'.env('MIMO_USERNAME').'",
                "password": "'.env('MIMO_PASSWORD').'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response)->token;

    }

    public static function sendMessage($text, $to, $token)
    {
        $curl = curl_init();

        $fields = array(
            "sender" => env("MIMO_SENDER_ID"),
            "text" => $text,
            "recipients" => $to
        );
        // dd($to);
        curl_setopt_array($curl, array(
            CURLOPT_URL => '52.30.114.86:8080/mimosms/v1/message/send?token='.$token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        // dd($response);

        curl_close($curl);

        return 1;
    }

    public static function logout($token)
    {
        // dd('Hello world');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '52.30.114.86:8080/mimosms/v1/user/logout?token='.$token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response, $token);

    }
}
