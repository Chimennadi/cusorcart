<?php

namespace App\Http\Controllers;

use App\Rave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cart;
use App\CustomerPackage;
use App\Product;
use Illuminate\Support\Facades\Auth;

class RaveController extends Controller
{
    public $rave;

    public function __construct()
    {
        $this->rave = new Rave();
    }

    public function redirectToGateway1(Request $request)
    {
        $rave = new Rave();
        $email = 'paschalanagha@gmail.com';
        $amount = 10;

        //* Prepare our rave request
        $data = [
            'tx_ref' => 'TRX-000' . time(),
            'amount' => $amount,
            'currency' => 'NGN',
            'payment_options' => 'card',
            'redirect_url' => url('/') . '/rave/callback',
            'customer' => [
                'email' => $email,
                'name' => 'Zubdev'
            ],
            'meta' => [
                'price' => $amount
            ],
            'customizations' => [
                'title' => 'Paying for a sample product',
                'description' => 'sample'
            ]
        ];
        $request->replace($data);
        return $rave->getAuthorizationUrl()->redirectNow();
    }

    public function redirectToGateway(Request $request)
    {
        if (Session::get('payment_type') == 'cart_payment') {

            $tax = 0;
            $subtotal = 0;

            $carts = Cart::where('user_id', Auth::user()->id)
                ->get();

            foreach ($carts as $key => $cartItem) {
                $product = Product::find($cartItem['product_id']);
                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];
            }

            $amounts = $subtotal + $tax + $request->ship_payment;

            $request->session()->put('request', $request->all());

            // $order = Order::findOrFail(Session::get('order_id'));
            $user = Auth::user();
            $data = [
                'tx_ref' => $this->rave->genTranxRef(),
                'amount' => round($amounts),
                'currency' => env('PAYSTACK_CURRENCY_CODE', 'NGN'),
                'payment_options' => 'card',
                'redirect_url' => url('/') . '/rave/callback',
                'customer' => [
                    'email' => $user->email,
                    'name' => $user->name
                ],
                'meta' => [
                    'price' => round($amounts)
                ],
                'customizations' => [
                    'title' => 'Paying for products',
                    'description' => 'Payment for products from cusorcart.'
                ]
            ];
            $request->merge($data);
            return $this->rave->getAuthorizationUrl()->redirectNow();
        } elseif (Session::get('payment_type') == 'wallet_payment') {
            $user = Auth::user();

            $data = [
                'tx_ref' => $this->rave->genTranxRef(),
                'amount' => round(Session::get('payment_data')['amount'] * 100),
                'currency' => env('PAYSTACK_CURRENCY_CODE', 'NGN'),
                'payment_options' => 'card',
                'redirect_url' => url('/') . '/rave/callback',
                'customer' => [
                    'email' => $user->email,
                    'name' => $user->name
                ],
                'meta' => [
                    'price' => round(Session::get('payment_data')['amount'] * 100)
                ],
                'customizations' => [
                    'title' => 'Paying for products',
                    'description' => 'Payment for products from cusorcart.'
                ]
            ];
            $request->merge($data);
            return $this->rave->getAuthorizationUrl()->redirectNow();
        } elseif (Session::get('payment_type') == 'customer_package_payment') {
            $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
            $user = Auth::user();

            $data = [
                'tx_ref' => $this->rave->genTranxRef(),
                'amount' =>  round($customer_package->amount * 100),
                'currency' => env('PAYSTACK_CURRENCY_CODE', 'NGN'),
                'payment_options' => 'card',
                'redirect_url' => url('/') . '/rave/callback',
                'customer' => [
                    'email' => $user->email,
                    'name' => $user->name
                ],
                'meta' => [
                    'price' =>  round($customer_package->amount * 100)
                ],
                'customizations' => [
                    'title' => 'Paying for products',
                    'description' => 'Payment for products from cusorcart.'
                ]
            ];
            $request->merge($data);
            return $this->rave->getAuthorizationUrl()->redirectNow();
        }
        // elseif (Session::get('payment_type') == 'seller_package_payment') {
        //     $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
        //     $user = Auth::user();
        //     $data = [
        //         'tx_ref' => $this->rave->genTranxRef(),
        //         'amount' =>  round($seller_package->amount * 100),
        //         'currency' => env('PAYSTACK_CURRENCY_CODE', 'NGN'),
        //         'payment_options' => 'card',
        //         'redirect_url' => url('/') . '/rave/callback',
        //         'customer' => [
        //             'email' => $user->email,
        //             'name' => $user->name
        //         ],
        //         'meta' => [
        //             'price' =>  round($seller_package->amount * 100)
        //         ],
        //         'customizations' => [
        //             'title' => 'Paying for products',
        //             'description' => 'Payment for products from cusorcart.'
        //         ]
        //     ];
        //     $request->merge($data);
        //     return $this->rave->getAuthorizationUrl()->redirectNow();
        // }
    }
    public function handleGatewayCallback()
    {
        if (Session::has('payment_type')) {
            if (Session::get('payment_type') == 'cart_payment') {
                $payment = $this->rave->getPaymentData();
                $payment_detalis = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'successful') {
                    $checkoutController = new CheckoutController;
                    return $checkoutController->checkout_done(1, $payment_detalis);
                }
                Session::forget('order_id');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('home');
            } elseif (Session::get('payment_type') == 'wallet_payment') {
                $payment = $this->rave->getPaymentData();
                $payment_detalis = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'successful') {
                    $walletController = new WalletController;
                    return $walletController->wallet_payment_done(Session::get('payment_data'), $payment_detalis);
                }
                Session::forget('payment_data');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('home');
            } elseif (Session::get('payment_type') == 'customer_package_payment') {
                $payment = $this->rave->getPaymentData();
                $payment_detalis = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'successful') {
                    $customer_package_controller = new CustomerPackageController;
                    return $customer_package_controller->purchase_payment_done(Session::get('payment_data'), $payment);
                }
                Session::forget('payment_data');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('home');
            }
            // elseif (Session::get('payment_type') == 'seller_package_payment') {
            //     $payment = $this->rave->getPaymentData();
            //     $payment_detalis = json_encode($payment);
            //     if (!empty($payment['data']) && $payment['data']['status'] == 'successful') {
            //         $seller_package_controller = new SellerPackageController();
            //         return $seller_package_controller->purchase_payment_done(Session::get('payment_data'), $payment);
            //     }
            //     Session::forget('payment_data');
            //     flash(translate('Payment cancelled'))->success();
            //     return redirect()->route('home');
            // }
        }

        // for mobile app
        if (!Session::has('payment_type')) {
            $payment = $this->rave->getPaymentData();
            $payment_details = json_encode($payment);
            if (!empty($payment['data']) && $payment['data']['status'] == 'successful') {
                return response()->json(['result' => true, 'message' => "Payment is successful", 'payment_details' => $payment_details]);
            } else {
                return response()->json(['result' => false, 'message' => "Payment unsuccessful", 'payment_details' => $payment_details]);
            }
        }
    }
}
