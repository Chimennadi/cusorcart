<?php

namespace App;

// namespace Facades\App;

// use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class PaystackSelf
{
    public $url;
    public function genTranxRef()
    {
        return 'TRX-' . time();
    }
    public function getPaymentData()
    {
        $reference = request()->reference;
        $uri = "https://api.paystack.co/transaction/verify/$reference";
        $public_key = env('PAYSTACK_SECRET_KEY');
        $request = Http::withToken($public_key)->acceptJson()->get($uri)->throw()->json();
        return ($request);
    }

    public function makePaymentRequest($data = null)
    {
        if ($data == null) {

            $quantity = intval(request()->quantity ?? 1);

            $data = array_filter([
                "amount" => intval(request()->amount) * $quantity,
                "reference" => request()->reference,
                "email" => request()->email,
                "plan" => request()->plan,
                "first_name" => request()->first_name,
                "last_name" => request()->last_name,
                "callback_url" => request()->callback_url,
                "currency" => (request()->currency != ""  ? request()->currency : "NGN"),

                /*
                    Paystack allows for transactions to be split into a subaccount -
                    The following lines trap the subaccount ID - as well as the ammount to charge the subaccount (if overriden in the form)
                    both values need to be entered within hidden input fields
                */
                "subaccount" => request()->subaccount,
                "transaction_charge" => request()->transaction_charge,

                /**
                 * Paystack allows for transaction to be split into multi accounts(subaccounts)
                 * The following lines trap the split ID handling the split
                 * More details here: https://paystack.com/docs/payments/multi-split-payments/#using-transaction-splits-with-payments
                 */
                "split_code" => request()->split_code,

                /**
                 * Paystack allows transaction to be split into multi account(subaccounts) on the fly without predefined split
                 * form need an input field: <input type="hidden" name="split" value="{{ json_encode($split) }}" >
                 * array must be set up as:
                 *  $split = [
                 *    "type" => "percentage",
                 *     "currency" => "KES",
                 *     "subaccounts" => [
                 *       { "subaccount" => "ACCT_li4p6kte2dolodo", "share" => 10 },
                 *       { "subaccount" => "ACCT_li4p6kte2dolodo", "share" => 30 },
                 *     ],
                 *     "bearer_type" => "all",
                 *     "main_account_share" => 70,
                 * ]
                 * More details here: https://paystack.com/docs/payments/multi-split-payments/#dynamic-splits
                 */
                "split" => request()->split,
                /*
                * to allow use of metadata on Paystack dashboard and a means to return additional data back to redirect url
                * form need an input field: <input type="hidden" name="metadata" value="{{ json_encode($array) }}" >
                * array must be set up as:
                * $array = [ 'custom_fields' => [
                *                   ['display_name' => "Cart Id", "variable_name" => "cart_id", "value" => "2"],
                *                   ['display_name' => "Sex", "variable_name" => "sex", "value" => "female"],
                *                   .
                *                   .
                *                   .
                *                  ]
                *          ]
                */
                'metadata' => request()->metadata
            ]);
        }
        $uri = "https://api.paystack.co/transaction/initialize";
        $public_key = env('PAYSTACK_SECRET_KEY');
        $request = Http::withToken($public_key)->acceptJson()
            ->post($uri, $data)->throw()->json();

        $url = $request['data']['authorization_url'];

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
