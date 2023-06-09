<?php


namespace App\Http\Controllers\Api\V2;


use App\BusinessSetting;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Redirect;

class IyzicoController extends Controller
{

    public function init(Request $request)
    {
        $payment_type = $request->payment_type;
        $order_id = $request->order_id;
        $amount = $request->amount;
        $user_id = $request->user_id;

        $options = new \Iyzipay\Options();
        $options->setApiKey(env('IYZICO_API_KEY'));
        $options->setSecretKey(env('IYZICO_SECRET_KEY'));

        if (get_setting('iyzico_sandbox') == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com");
        }

        $iyzicoRequest = new \Iyzipay\Request\CreatePayWithIyzicoInitializeRequest();
        $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $iyzicoRequest->setConversationId('123456789');

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId("BY789");
        $buyer->setName("John");
        $buyer->setSurname("Doe");
        $buyer->setEmail("email@email.com");
        $buyer->setIdentityNumber("74300864791");
        $buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
        $buyer->setCity("Istanbul");
        $buyer->setCountry("Turkey");
        $iyzicoRequest->setBuyer($buyer);
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName("Jane Doe");
        $shippingAddress->setCity("Istanbul");
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
        $iyzicoRequest->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName("Jane Doe");
        $billingAddress->setCity("Istanbul");
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
        $iyzicoRequest->setBillingAddress($billingAddress);


        if ($payment_type == 'cart_payment') {
            $order = Order::find($order_id);
            $iyzicoRequest->setPrice(round($order->grand_total));
            $iyzicoRequest->setPaidPrice(round($order->grand_total));
            $iyzicoRequest->setCurrency(\Iyzipay\Model\Currency::TL);
            $iyzicoRequest->setBasketId(rand(000000, 999999));
            $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
            $iyzicoRequest->setCallbackUrl(route('api.iyzico.callback'));

            $basketItems = array();
            $firstBasketItem = new \Iyzipay\Model\BasketItem();
            $firstBasketItem->setId(rand(1000, 9999));
            $firstBasketItem->setName("Cart Payment");
            $firstBasketItem->setCategory1("Accessories");
            $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
            $firstBasketItem->setPrice(round($order->grand_total));
            $basketItems[0] = $firstBasketItem;

            $iyzicoRequest->setBasketItems($basketItems);
        } elseif ($payment_type == 'wallet_payment') {
            $iyzicoRequest->setPrice(round($amount));
            $iyzicoRequest->setPaidPrice(round($amount));
            $iyzicoRequest->setCurrency(\Iyzipay\Model\Currency::TL);
            $iyzicoRequest->setBasketId(rand(000000, 999999));
            $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
            $iyzicoRequest->setCallbackUrl(route('api.iyzico.callback'));

            $basketItems = array();
            $firstBasketItem = new \Iyzipay\Model\BasketItem();
            $firstBasketItem->setId(rand(1000, 9999));
            $firstBasketItem->setName("Wallet Payment");
            $firstBasketItem->setCategory1("Wallet");
            $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
            $firstBasketItem->setPrice(round($amount));
            $basketItems[0] = $firstBasketItem;

            $iyzicoRequest->setBasketItems($basketItems);
        }

        $payWithIyzicoInitialize = \Iyzipay\Model\PayWithIyzicoInitialize::create($iyzicoRequest, $options);

        # print result
        return Redirect::to($payWithIyzicoInitialize->getPayWithIyzicoPageUrl());
    }

    public function callback(Request $request)
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey(env('IYZICO_API_KEY'));
        $options->setSecretKey(env('IYZICO_SECRET_KEY'));

        if (BusinessSetting::where('type', 'iyzico_sandbox')->first()->value == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com");
        }

        $iyzicoRequest = new \Iyzipay\Request\RetrievePayWithIyzicoRequest();
        $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $iyzicoRequest->setConversationId('123456789');
        $iyzicoRequest->setToken($request->token);
        # make request
        $payWithIyzico = \Iyzipay\Model\PayWithIyzico::retrieve($iyzicoRequest, $options);

        $payment = $payWithIyzico->getRawResult();

        if ($payWithIyzico->getStatus() == 'success') {
            return response()->json(['result' => true, 'message' => "Payment is successful", 'payment_details' => $payment]);
        } else {
            return response()->json(['result' => false, 'message' => "Payment unsuccessful", 'payment_details' => $payment]);
        }
    }


    // the callback function is in the main controller of web | paystackcontroller

    public function success(Request $request)
    {
        try {

            $payment_type = $request->payment_type;

            if ($payment_type == 'cart_payment') {

                checkout_done($request->order_id, $request->payment_details);
            }

            if ($payment_type == 'wallet_payment') {

                wallet_payment_done($request->user_id, $request->amount, 'Paystack', $request->payment_details);
            }

            return response()->json(['result' => true, 'message' => "Payment is successful"]);


        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }

}
