<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Rave
{
    public $url;
    public function genTranxRef()
    {
        return 'TRX-0000' . time();
    }
    public function getPaymentData()
    {
        $txid = request()->transaction_id;
        // dd($txid);
        $uri = "https://api.flutterwave.com/v3/transactions/{$txid}/verify";
        $public_key = env('FLW_SECRET_KEY');
        $request = Http::withToken($public_key)->acceptJson()->get($uri)->throw()->json();
        return ($request);
    }

    public function makePaymentRequest($data = null)
    {
        if ($data == null) {

            $quantity = intval(request()->quantity ?? 1);

            $data = array_filter([
                "amount" => intval(request()->amount) * $quantity,
                "tx_ref" => request()->tx_ref,
                "email" => request()->email,
                "plan" => request()->plan,
                "customer" => request()->customer,
                "redirect_url" => request()->redirect_url,
                "currency" => (request()->currency != ""  ? request()->currency : "NGN"),
                "payment_options" => (request()->payment_options != ""  ? request()->payment_options : "card"),
                "customizations" => request()->customizations,
                'meta' => request()->meta
            ]);
        }
        $uri = 'https://api.flutterwave.com/v3/payments';
        $key = env('FLW_SECRET_KEY');
        $request = Http::withToken($key)->acceptJson()
            ->post($uri, $data)->throw()->json();
        $url = $request['data']['link'];

        return $url;
    }
    public function getAuthorizationUrl()
    {

        $this->url = $this->makePaymentRequest();


        return $this;
    }
    public function redirectNow()
    {

        return redirect($this->url);
    }
}
