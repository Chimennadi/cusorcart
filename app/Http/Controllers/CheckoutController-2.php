<?php

namespace App\Http\Controllers;

use App\Utility\PayfastUtility;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Cart;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\InstamojoController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PublicSslCommerzPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\PaytmController;
use App\Order;
use App\CommissionHistory;
use App\BusinessSetting;
use App\Coupon;
use App\CouponUsage;
use App\User;
use App\Address;
use App\OrderDetail;
use Illuminate\Support\Facades\Mail;
use App\LogisticSale;
use App\Mail\InvoiceEmailManager;
use App\GeneralSetting;
use App\ShippingDetail;
use App\Product;
use Session;
use App\Utility\PayhereUtility;

class CheckoutController extends Controller
{

    public function __construct()
    {
        //
    }

    //check the selected payment gateway and redirect to that controller accordingly
    public function checkout(Request $request)
    {
        if ($request->payment_option != null) {
            if (
                \App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
                \App\Addon::where('unique_identifier', 'otp_system')->first()->activated &&
                !Auth::user()->email
            ) {
                flash(translate('Your email should be verified before order'))->warning();
                return redirect()->route('cart')->send();
            }

            if (get_setting('email_verification') == 1 && !Auth::user()->hasVerifiedEmail()) {
                flash(translate('Your email should be verified before order'))->warning();
                return redirect()->route('cart')->send();
            }


            if ($request->payment_option != 'paystack') {
                $orderController = new OrderController;
                $orderController->store($request);
            }


            $request->session()->put('payment_type', 'cart_payment');

            if ($request->session()->get('order_id') == null) {
                if ($request->payment_option == 'paypal') {
                    $paypal = new PaypalController;
                    return $paypal->getCheckout();
                } elseif ($request->payment_option == 'stripe') {
                    $stripe = new StripePaymentController;
                    return $stripe->stripe();
                } elseif ($request->payment_option == 'sslcommerz') {
                    $sslcommerz = new PublicSslCommerzPaymentController;
                    return $sslcommerz->index($request);
                } elseif ($request->payment_option == 'instamojo') {
                    $instamojo = new InstamojoController;
                    return $instamojo->pay($request);
                } elseif ($request->payment_option == 'razorpay') {
                    $razorpay = new RazorpayController;
                    return $razorpay->payWithRazorpay($request);
                } elseif ($request->payment_option == 'proxypay') {
                    $proxy = new ProxypayController;
                    return $proxy->create_reference($request);
                } elseif ($request->payment_option == 'paystack') {
                    $paystack = new PaystackController;
                    return $paystack->redirectToGateway($request);
                } elseif ($request->payment_option == 'voguepay') {
                    $voguePay = new VoguePayController;
                    return $voguePay->customer_showForm();
                } elseif ($request->payment_option == 'payhere') {
                    $order = Order::findOrFail($request->session()->get('order_id'));

                    $order_id = $order->id;
                    $amount = $order->grand_total;
                    $first_name = json_decode($order->shipping_address)->name;
                    $last_name = 'X';
                    $phone = json_decode($order->shipping_address)->phone;
                    $email = json_decode($order->shipping_address)->email;
                    $address = json_decode($order->shipping_address)->address;
                    $city = json_decode($order->shipping_address)->city;

                    return PayhereUtility::create_checkout_form($order_id, $amount, $first_name, $last_name, $phone, $email, $address, $city);
                } elseif ($request->payment_option == 'payfast') {
                    $order = Order::findOrFail($request->session()->get('order_id'));

                    $order_id = $order->id;
                    $amount = $order->grand_total;

                    return PayfastUtility::create_checkout_form($order_id, $amount);
                } else if ($request->payment_option == 'ngenius') {
                    $ngenius = new NgeniusController();
                    return $ngenius->pay();
                } else if ($request->payment_option == 'iyzico') {
                    $iyzico = new IyzicoController();
                    return $iyzico->pay();
                } else if ($request->payment_option == 'nagad') {
                    $nagad = new NagadController;
                    return $nagad->getSession();
                } else if ($request->payment_option == 'bkash') {
                    $bkash = new BkashController;
                    return $bkash->pay();
                } else if ($request->payment_option == 'flutterwave') {
                    $flutterwave = new FlutterwaveController();
                    return $flutterwave->pay();
                } else if ($request->payment_option == 'mpesa') {
                    $mpesa = new MpesaController();
                    return $mpesa->pay();
                } elseif ($request->payment_option == 'paytm') {
                    $paytm = new PaytmController;
                    return $paytm->index();
                } elseif ($request->payment_option == 'cash_on_delivery') {

                    $request->session()->forget('club_point');

                    flash(translate("Your order has been placed successfully"))->success();
                    return redirect()->route('order_confirmed');
                } elseif ($request->payment_option == 'wallet') {
                    $user = Auth::user();
                    $order = Order::findOrFail($request->session()->get('order_id'));
                    if ($user->balance >= $order->grand_total) {
                        $user->balance -= $order->grand_total;
                        $user->save();
                        return $this->checkout_done($request->session()->get('order_id'), null);
                    }
                } else {
                    $order = Order::findOrFail($request->session()->get('order_id'));
                    $order->manual_payment = 1;
                    $order->save();

                    $request->session()->forget('club_point');

                    flash(translate('Your order has been placed successfully. Please submit payment information from purchase history'))->success();
                    return redirect()->route('order_confirmed');
                }
            }
        } else {
            flash(translate('Select Payment Option.'))->warning();
            return back();
        }
    }

    //redirects to this method after a successfull checkout
    public function checkout_done($order_id, $payment)
    {

        // $carts = Cart::where('user_id', Auth::user()->id)->get();
        // dd($carts);

        $request = Session::get('request');


        $amount_price = 0;
        $amount_tax = 0;
        $dad = array_unique($request['owner_id']);

        foreach ($dad  as $key => $ownerid) {

            if ($request['ship_payment'] != 0 && !empty($request['ship_id'][$key])) {
                $assign_id = ShippingDetail::where('id', $request['ship_id'][$key])->first();
            } else {
                $assign_id = "";
            }




            $order = new Order;


            // 

            // 

            if (Auth::check()) {
                $order->user_id = Auth::user()->id;
            } else {
                $order->guest_id = mt_rand(100000, 999999);
            }

            $carts = Cart::where('user_id', Auth::user()->id)
                ->where('owner_id', $ownerid)
                ->get();

            // dd($carts);        

            $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
            $shipping_info->name = Auth::user()->name;
            $shipping_info->email = Auth::user()->email;
            $order->seller_id = $ownerid;
            $order->shipping_address = json_encode($shipping_info);

            $order->payment_type = $request['payment_option'];
            $order->delivery_viewed = '0';
            $order->payment_status_viewed = '0';
            if ($assign_id  == null) {
                $order->assign_delivery_boy = 0;
            } else {
                $order->assign_delivery_boy = $assign_id->user_id;
            }
            $order->cancel_request = 0;
            $order->code = date('Ymd-His') . rand(10, 99);
            $order->date = strtotime('now');
            $order->cost_shippment = $request['ship_payment'];


            if ($order->save()) {
                $subtotal = 0;
                $tax = 0;
                $shipping = 0;

                //calculate shipping is to get shipping costs of different types
                $admin_products = array();
                $seller_products = array();

                //Order Details Storing
                foreach ($carts as $key => $cartItem) {
                    $product = Product::find($cartItem['product_id']);

                    if ($product->added_by == 'admin') {
                        array_push($admin_products, $cartItem['product_id']);
                    } else {
                        $product_ids = array();
                        if (array_key_exists($product->user_id, $seller_products)) {
                            $product_ids = $seller_products[$product->user_id];
                        }
                        array_push($product_ids, $cartItem['product_id']);
                        $seller_products[$product->user_id] = $product_ids;
                    }

                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                    $tax += $cartItem['tax'] * $cartItem['quantity'];

                    $product_variation = $cartItem['variation'];

                    $order->neck = $cartItem['neck'];
                    $order->chest = $cartItem['chest'];
                    $order->waist = $cartItem['waist'];
                    $order->sleeves = $cartItem['sleeves'];

                    $product_stock = $product->stocks->where('variant', $product_variation)->first();

                    if ($product_stock != "") {
                        if ($product->digital != 1 &&  $cartItem['quantity'] > $product_stock->qty) {
                            flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();
                            $order->delete();
                            return redirect()->route('cart')->send();
                        } elseif ($product->digital != 1) {
                            $product_stock->qty -= $cartItem['quantity'];
                            $product_stock->save();
                        }
                    }


                    $order_detail = new OrderDetail;
                    $order_detail->order_id  = $order->id;
                    $order_detail->seller_id = $product->user_id;
                    $order_detail->product_id = $product->id;
                    $order_detail->variation = $product_variation;
                    $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                    $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                    $order_detail->shipping_type = $cartItem['shipping_type'];
                    $order_detail->product_referral_code = $cartItem['product_referral_code'];
                    //kmas
                    if ($product->digital != 1) {
                        $order_detail->shipping_cost = $request['ship_payment'];
                    } else {
                        $order_detail->shipping_cost = 0;
                    }

                    $shipping += $order_detail->shipping_cost;

                    if ($cartItem['shipping_type'] == 'pickup_point') {
                        $order_detail->pickup_point_id = $cartItem['pickup_point'];
                    }
                    //End of storing shipping cost

                    $order_detail->quantity = $cartItem['quantity'];
                    $order_detail->save();

                    $product->num_of_sale++;
                    $product->save();

                    if (
                        \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                        \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated
                    ) {
                        if ($order_detail->product_referral_code) {
                            $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();

                            $affiliateController = new AffiliateController;
                            $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);
                        }
                    }
                }

                $globaltax = GeneralSetting::where('id', '1')->first()->tax;
                //kmas
                if ($product->digital != 1) {
                    $service = $request['ship_payment'];
                } else {
                    $service = 0;
                }

                $service_id = $request['ship_id'];
                // $order->service_charge = $service;
                $order->grand_total = $subtotal + $tax  + $service + $globaltax;
                $amount_price += $subtotal;
                $amount_tax += $tax;
                // dd($subtotal + $tax + $service + $globaltax);

                $order->global_tax = $globaltax;

                if ($carts->first()->coupon_code != '') {
                    $order->grand_total -= $carts->sum('discount');
                    if (Session::has('club_point')) {
                        $order->club_point = Session::get('club_point');
                    }
                    $order->coupon_discount = $carts->sum('discount');

                    //                $clubpointController = new ClubPointController;
                    //                $clubpointController->deductClubPoints($order->user_id, Session::get('club_point'));

                    $coupon_usage = new CouponUsage;
                    $coupon_usage->user_id = Auth::user()->id;
                    $coupon_usage->coupon_id = Coupon::where('code', $carts->first()->coupon_code)->first()->id;
                    $coupon_usage->save();
                }

                $order->save();

                //   $logistic = new LogisticSale();
                //     $logistic->service_id = $service_id;
                //     $logistic->service_charge = $service;
                //     $logistic->order_id = $order->id;
                //     $logistic->save();


                $array['view'] = 'emails.invoice';
                $array['subject'] = translate('Your order has been placed') . ' - ' . $order->code;
                $array['from'] = env('MAIL_FROM_ADDRESS');
                $array['order'] = $order;

                foreach ($seller_products as $key => $seller_product) {
                    try {
                        Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
                    } catch (\Exception $e) {
                    }
                }

                if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value) {
                    try {
                        $otpController = new OTPVerificationController;
                        $otpController->send_order_code($order);
                    } catch (\Exception $e) {
                    }
                }

                //sends email to customer with the invoice pdf attached
                if (env('MAIL_USERNAME') != null) {
                    try {
                        Mail::to(Auth::user()->email)->queue(new InvoiceEmailManager($array));
                        Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                    } catch (\Exception $e) {
                    }
                }

                // $request->session()->put('order_id', $order->id);

            }

            $order = Order::findOrFail($order->id);
            $order->payment_status = 'paid';
            $order->payment_details = $payment;
            $order->save();

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
                if (Auth::check()) {
                    $clubpointController = new ClubPointController;
                    $clubpointController->processClubPoints($order);
                }
            }

            $vendor_commission_activation = true;
            if (
                \App\Addon::where('unique_identifier', 'seller_subscription')->first() != null
                && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated
                && !get_setting('vendor_commission_activation')
            ) {
                $vendor_commission_activation = false;
            }

            if ($vendor_commission_activation) {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    $commission_percentage = 0;

                    if (get_setting('category_wise_commission') != 1) {
                        $commission_percentage = get_setting('vendor_commission');
                    } else if ($orderDetail->product->user->user_type == 'seller') {
                        $commission_percentage = $orderDetail->product->category->commision_rate;
                    }

                    if ($orderDetail->product->user->user_type == 'seller') {
                        $seller = $orderDetail->product->user->seller;
                        $admin_commission = ($orderDetail->price * $commission_percentage) / 100;

                        if (get_setting('product_manage_by_admin') == 1) {
                            $seller_earning = ($orderDetail->tax + $orderDetail->price) - $admin_commission;
                            $seller->admin_to_pay += $seller_earning;
                        } else {
                            $seller_earning = ($orderDetail->tax + $orderDetail->shipping_cost + $orderDetail->price) - $admin_commission;
                            $seller->admin_to_pay += $seller_earning;
                        }
                        $seller->save();

                        $commission_history = new CommissionHistory;
                        $commission_history->order_id = $order->id;
                        $commission_history->order_detail_id = $orderDetail->id;
                        $commission_history->seller_id = $orderDetail->seller_id;
                        $commission_history->admin_commission = $admin_commission;
                        $commission_history->seller_earning = $seller_earning;

                        $commission_history->save();
                    }
                }
            } else {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if ($orderDetail->product->user->user_type == 'seller') {
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            }

            $order->commission_calculated = 1;
            $order->save();



            Session::forget('club_point');
        }

        Cart::where('user_id', Auth::user()->id)
            ->delete();

        // $amount_price = $amount_price + $service + $amount_tax;
        // $request->session()->put('amount', $amount_price);
        // // dd($amount_price);




        flash(translate('Payment completed'))->success();

        $order = Order::orderby('id', 'DESC')->first();
        return view('frontend.order_confirmed', compact('order'));
    }

    public function checkout_done_from_api($user_id, $payment)
    {

        // $carts = Cart::where('user_id', Auth::user()->id)->get();
        // dd($carts);

        $request = request();


        $amount_price = 0;
        $amount_tax = 0;
        $dad = array_unique($request['owner_id']);

        foreach ($dad  as $key => $ownerid) {

            if ($request['ship_payment'] != 0 && !empty($request['ship_id'][$key])) {
                $assign_id = ShippingDetail::where('id', $request['ship_id'][$key])->first();
            } else {
                $assign_id = "";
            }




            $order = new Order;


            // 

            // 

            $order->user_id = $user_id;

            $carts = Cart::where('user_id', $user_id)
                ->where('owner_id', $ownerid)
                ->get();
            $user = User::where('id', $user_id)->first();

            // dd($carts);        

            $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
            $shipping_info->name = $user->name;
            $shipping_info->email = $user->email;
            $order->seller_id = $ownerid;
            $order->shipping_address = json_encode($shipping_info);

            $order->payment_type = $request['payment_option'];
            $order->delivery_viewed = '0';
            $order->payment_status_viewed = '0';
            if ($assign_id  == null) {
                $order->assign_delivery_boy = 0;
            } else {
                $order->assign_delivery_boy = $assign_id->user_id;
            }
            $order->cancel_request = 0;
            $order->code = date('Ymd-His') . rand(10, 99);
            $order->date = strtotime('now');
            $order->cost_shippment = $request['ship_payment'];


            if ($order->save()) {
                $subtotal = 0;
                $tax = 0;
                $shipping = 0;

                //calculate shipping is to get shipping costs of different types
                $admin_products = array();
                $seller_products = array();

                //Order Details Storing
                foreach ($carts as $key => $cartItem) {
                    $product = Product::find($cartItem['product_id']);

                    if ($product->added_by == 'admin') {
                        array_push($admin_products, $cartItem['product_id']);
                    } else {
                        $product_ids = array();
                        if (array_key_exists($product->user_id, $seller_products)) {
                            $product_ids = $seller_products[$product->user_id];
                        }
                        array_push($product_ids, $cartItem['product_id']);
                        $seller_products[$product->user_id] = $product_ids;
                    }

                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                    $tax += $cartItem['tax'] * $cartItem['quantity'];

                    $product_variation = $cartItem['variation'];

                    $order->neck = $cartItem['neck'];
                    $order->chest = $cartItem['chest'];
                    $order->waist = $cartItem['waist'];
                    $order->sleeves = $cartItem['sleeves'];

                    $product_stock = $product->stocks->where('variant', $product_variation)->first();

                    if ($product_stock != "") {
                        if ($product->digital != 1 &&  $cartItem['quantity'] > $product_stock->qty) {
                            flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();
                            $order->delete();
                            return redirect()->route('cart')->send();
                        } elseif ($product->digital != 1) {
                            $product_stock->qty -= $cartItem['quantity'];
                            $product_stock->save();
                        }
                    }


                    $order_detail = new OrderDetail;
                    $order_detail->order_id  = $order->id;
                    $order_detail->seller_id = $product->user_id;
                    $order_detail->product_id = $product->id;
                    $order_detail->variation = $product_variation;
                    $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                    $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                    $order_detail->shipping_type = $cartItem['shipping_type'];
                    $order_detail->product_referral_code = $cartItem['product_referral_code'];
                    //kmas
                    if ($product->digital != 1) {
                        $order_detail->shipping_cost = $request['ship_payment'];
                    } else {
                        $order_detail->shipping_cost = 0;
                    }

                    $shipping += $order_detail->shipping_cost;

                    if ($cartItem['shipping_type'] == 'pickup_point') {
                        $order_detail->pickup_point_id = $cartItem['pickup_point'];
                    }
                    //End of storing shipping cost

                    $order_detail->quantity = $cartItem['quantity'];
                    $order_detail->save();

                    $product->num_of_sale++;
                    $product->save();

                    if (
                        \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                        \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated
                    ) {
                        if ($order_detail->product_referral_code) {
                            $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();

                            $affiliateController = new AffiliateController;
                            $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);
                        }
                    }
                }

                $globaltax = GeneralSetting::where('id', '1')->first()->tax;
                //kmas
                if ($product->digital != 1) {
                    $service = $request['ship_payment'];
                } else {
                    $service = 0;
                }

                $service_id = $request['ship_id'];
                // $order->service_charge = $service;
                $order->grand_total = $subtotal + $tax  + $service + $globaltax;
                $amount_price += $subtotal;
                $amount_tax += $tax;
                // dd($subtotal + $tax + $service + $globaltax);

                $order->global_tax = $globaltax;

                if ($carts->first()->coupon_code != '') {
                    $order->grand_total -= $carts->sum('discount');
                    if (isset($request->club_point)) {
                        $order->club_point = $request->club_point;
                    }
                    $order->coupon_discount = $carts->sum('discount');

                    //                $clubpointController = new ClubPointController;
                    //                $clubpointController->deductClubPoints($order->user_id, Session::get('club_point'));

                    $coupon_usage = new CouponUsage;
                    $coupon_usage->user_id = $user->id;
                    $coupon_usage->coupon_id = Coupon::where('code', $carts->first()->coupon_code)->first()->id;
                    $coupon_usage->save();
                }

                $order->save();

                //   $logistic = new LogisticSale();
                //     $logistic->service_id = $service_id;
                //     $logistic->service_charge = $service;
                //     $logistic->order_id = $order->id;
                //     $logistic->save();


                $array['view'] = 'emails.invoice';
                $array['subject'] = translate('Your order has been placed') . ' - ' . $order->code;
                $array['from'] = env('MAIL_FROM_ADDRESS');
                $array['order'] = $order;

                foreach ($seller_products as $key => $seller_product) {
                    try {
                        Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
                    } catch (\Exception $e) {
                    }
                }

                if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value) {
                    try {
                        $otpController = new OTPVerificationController;
                        $otpController->send_order_code($order);
                    } catch (\Exception $e) {
                    }
                }

                //sends email to customer with the invoice pdf attached
                if (env('MAIL_USERNAME') != null) {
                    try {
                        Mail::to($user->email)->queue(new InvoiceEmailManager($array));
                        Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                    } catch (\Exception $e) {
                    }
                }

                // $request->session()->put('order_id', $order->id);

            }

            $order = Order::findOrFail($order->id);
            $order->payment_status = 'paid';
            $order->payment_details = $payment;
            $order->save();

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            // if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            //     if (Auth::check()) {
            //         $clubpointController = new ClubPointController;
            //         $clubpointController->processClubPoints($order);
            //     }
            // }

            $vendor_commission_activation = true;
            if (
                \App\Addon::where('unique_identifier', 'seller_subscription')->first() != null
                && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated
                && !get_setting('vendor_commission_activation')
            ) {
                $vendor_commission_activation = false;
            }

            if ($vendor_commission_activation) {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    $commission_percentage = 0;

                    if (get_setting('category_wise_commission') != 1) {
                        $commission_percentage = get_setting('vendor_commission');
                    } else if ($orderDetail->product->user->user_type == 'seller') {
                        $commission_percentage = $orderDetail->product->category->commision_rate;
                    }

                    if ($orderDetail->product->user->user_type == 'seller') {
                        $seller = $orderDetail->product->user->seller;
                        $admin_commission = ($orderDetail->price * $commission_percentage) / 100;

                        if (get_setting('product_manage_by_admin') == 1) {
                            $seller_earning = ($orderDetail->tax + $orderDetail->price) - $admin_commission;
                            $seller->admin_to_pay += $seller_earning;
                        } else {
                            $seller_earning = ($orderDetail->tax + $orderDetail->shipping_cost + $orderDetail->price) - $admin_commission;
                            $seller->admin_to_pay += $seller_earning;
                        }
                        $seller->save();

                        $commission_history = new CommissionHistory;
                        $commission_history->order_id = $order->id;
                        $commission_history->order_detail_id = $orderDetail->id;
                        $commission_history->seller_id = $orderDetail->seller_id;
                        $commission_history->admin_commission = $admin_commission;
                        $commission_history->seller_earning = $seller_earning;

                        $commission_history->save();
                    }
                }
            } else {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if ($orderDetail->product->user->user_type == 'seller') {
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            }

            $order->commission_calculated = 1;
            $order->save();
        }

        Cart::where('user_id', $user->id)
            ->delete();

        // $amount_price = $amount_price + $service + $amount_tax;
        // $request->session()->put('amount', $amount_price);
        // // dd($amount_price);




        flash(translate('Payment completed'))->success();

        $order = Order::orderby('id', 'DESC')->first();
        return $order;
    }

    public function get_shipping_info(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        //        if (Session::has('cart') && count(Session::get('cart')) > 0) {
        if ($carts && count($carts) > 0) {
            $categories = Category::all();
            return view('frontend.shipping_info', compact('categories', 'carts'));
        }
        flash(translate('Your cart is empty'))->success();
        return back();
    }

    public function store_shipping_info(Request $request)
    {

        $datas = Address::where('id', $request->address_id)->first();
        if ($request->address_id == null) {
            flash(translate("Please add shipping address"))->warning();
            return back();
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        foreach ($carts as $key => $cartItem) {
            $cartItem->address_id = $request->address_id;
            $cartItem->save();
        }

        return view('frontend.delivery_info', compact('carts', 'datas'));
        // return view('frontend.payment_select', compact('total'));
    }

    public function store_delivery_info(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)
            // ->where('owner_id', $request->owner_id)
            ->get();
        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
        $total = 0;
        $tax = 0;
        $shipping = 0;
        $db = 0;
        $subtotal = 0;
        $service = 0;
        $ship_ids = $request->ship_id;
        if ($ship_ids != "") {
            $ship_id  =  implode(" ", $ship_ids);
        } else {
            $ship_id = 0;
        }

        if ($request->ship_id != "") {
            #working tester
            $countowners = count($request->owner_id);
            $countlogicservices = count($request->ship_id);
            #working Tester

            // dd($countowners);

        } else {
            $countowners = count($carts);
            $countlogicservices = 0;
        }


        if ($countlogicservices != $countowners) {
            flash(translate("Sorry, this item can't be shipped to your area. Please kindly remove it from cart before proceeding"))->warning();
            return redirect()->route('home');
        }



        foreach ($request->owner_id as $name) {
            $details_data_ship = "ship_detail_id" . $name;
            $service += $request->$details_data_ship;
        }


        // foreach($request->shipping_tax as $taxofship)
        // {

        //   $db += $taxofship;

        // }


        // $service = $service + $db;



        if ($carts && count($carts) > 0) {
            foreach ($carts as $key => $cartItem) {
                $product = \App\Product::find($cartItem['product_id']);
                $tax += $cartItem['tax'] * $cartItem['quantity'];
                $subtotal += $cartItem['price'] * $cartItem['quantity'];

                if ($request['shipping_type_' . $name] == 'pickup_point') {
                    $cartItem['shipping_type'] = 'pickup_point';
                    $cartItem['pickup_point'] = $request['pickup_point_id_' . $name];
                } else {
                    $cartItem['shipping_type'] = 'home_delivery';
                }
                $cartItem['shipping_cost'] = 0;
                if ($cartItem['shipping_type'] == 'home_delivery') {
                    $cartItem['shipping_cost'] = getShippingCost($carts, $key);
                }

                if (isset($cartItem['shipping_cost']) && is_array(json_decode($cartItem['shipping_cost'], true))) {

                    foreach (json_decode($cartItem['shipping_cost'], true) as $shipping_region => $val) {
                        if ($shipping_info['city'] == $shipping_region) {
                            $cartItem['shipping_cost'] = (float)($val);
                            break;
                        } else {
                            $cartItem['shipping_cost'] = 0;
                        }
                    }
                } else {
                    if (
                        !$cartItem['shipping_cost'] ||
                        $cartItem['shipping_cost'] == null ||
                        $cartItem['shipping_cost'] == 'null'
                    ) {

                        $cartItem['shipping_cost'] = 0;
                    }
                }

                if ($product->is_quantity_multiplied == 1 && get_setting('shipping_type') == 'product_wise_shipping') {
                    $cartItem['shipping_cost'] =  $cartItem['shipping_cost'] * $cartItem['quantity'];
                }

                $shipping += $cartItem['shipping_cost'];
                $cartItem->save();
            }

            $total = $subtotal + $tax + $shipping + $service;
            return view('frontend.payment_select', compact('carts', 'shipping_info', 'total', 'service', 'ship_id'));
        } else {
            flash(translate('Your Cart was empty'))->warning();
            return redirect()->route('home');
        }

        // dd($service);




    }

    //    public function get_payment_info(Request $request)
    //    {
    //        $carts = Cart::where('user_id', Auth::user()->id)
    //                ->where('owner_id', $request->owner_id)
    //                ->get();
    //        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
    //        $total = 0;
    //        $tax = 0;
    //        $shipping = 0;
    //        $subtotal = 0;
    //
    //        if ($carts && count($carts) > 0) {
    //            foreach ($carts as $key => $cartItem) {
    //                $tax += $cartItem['tax'] * $cartItem['quantity'];
    //                $subtotal += $cartItem['price'] * $cartItem['quantity'];
    //
    //                if ($request['shipping_type_' . $request->owner_id] == 'pickup_point') {
    //                    $cartItem['shipping_type'] = 'pickup_point';
    //                    $cartItem['pickup_point'] = $request['pickup_point_id_' . $request->owner_id];
    //                } else {
    //                    $cartItem['shipping_type'] = 'home_delivery';
    //                }
    //                $cartItem['shipping_cost'] = 0;
    //                if ($cartItem['shipping_type'] == 'home_delivery') {
    //                    $cartItem['shipping_cost'] = getShippingCost($carts, $key);
    //                }
    //
    //                if (isset($cartItem['shipping_cost']) && is_array(json_decode($cartItem['shipping_cost'], true))) {
    //                    foreach (json_decode($cartItem['shipping_cost'], true) as $shipping_region => $val) {
    //                        if ($shipping_info['city'] == $shipping_region) {
    //                            $cartItem['shipping_cost'] = (double) ($val);
    //                            break;
    //                        }
    //                    }
    //                } else {
    //                    if (!$cartItem['shipping_cost'] ||
    //                            $cartItem['shipping_cost'] == null ||
    //                            $cartItem['shipping_cost'] == 'null') {
    //
    //                        $cartItem['shipping_cost'] = 0;
    //                    }
    //                }
    //                $shipping += $cartItem['shipping_cost'];
    //                $cartItem->save();
    //            }
    //            $total = $subtotal + $tax + $shipping;
    //            return view('frontend.payment_select', compact('carts', 'shipping_info', 'total'));
    //        }
    //    }

    public function apply_coupon_code(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();
        $carts = Cart::where('user_id', Auth::user()->id)
            ->where('owner_id', $request->owner_id)
            ->get();
        $response_message = array();

        if ($coupon != null) {
            if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {
                if (CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first() == null) {
                    $coupon_details = json_decode($coupon->details);

                    if ($coupon->type == 'cart_base') {
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        foreach ($carts as $key => $cartItem) {
                            $subtotal += $cartItem['price'] * $cartItem['quantity'];
                            $tax += $cartItem['tax'] * $cartItem['quantity'];
                            $shipping += $cartItem['shipping_cost'];
                        }
                        $sum = $subtotal + $tax + $shipping;

                        if ($sum >= $coupon_details->min_buy) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount = ($sum * $coupon->discount) / 100;
                                if ($coupon_discount > $coupon_details->max_discount) {
                                    $coupon_discount = $coupon_details->max_discount;
                                }
                            } elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }
                        }
                    } elseif ($coupon->type == 'product_base') {
                        $coupon_discount = 0;
                        foreach ($carts as $key => $cartItem) {
                            foreach ($coupon_details as $key => $coupon_detail) {
                                if ($coupon_detail->product_id == $cartItem['product_id']) {
                                    if ($coupon->discount_type == 'percent') {
                                        $coupon_discount += $cartItem['price'] * $coupon->discount / 100;
                                    } elseif ($coupon->discount_type == 'amount') {
                                        $coupon_discount += $coupon->discount;
                                    }
                                }
                            }
                        }
                    }

                    Cart::where('user_id', Auth::user()->id)
                        ->where('owner_id', $request->owner_id)
                        ->update(
                            [
                                'discount' => $coupon_discount / count($carts),
                                'coupon_code' => $request->code,
                                'coupon_applied' => 1
                            ]
                        );

                    $response_message['response'] = 'success';
                    $response_message['message'] = translate('Coupon has been applied');
                    //                    flash(translate('Coupon has been applied'))->success();
                } else {
                    $response_message['response'] = 'warning';
                    $response_message['message'] = translate('You already used this coupon!');
                    //                    flash(translate('You already used this coupon!'))->warning();
                }
            } else {
                $response_message['response'] = 'warning';
                $response_message['message'] = translate('Coupon expired!');
                //                flash(translate('Coupon expired!'))->warning();
            }
        } else {
            $response_message['response'] = 'danger';
            $response_message['message'] = translate('Invalid coupon!');
            //            flash(translate('Invalid coupon!'))->warning();
        }

        $carts = Cart::where('user_id', Auth::user()->id)
            // ->where('owner_id', $request->owner_id)
            ->get();
        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
        // todo kmas 
        $service = 0;
        // return view('frontend.payment_select', compact('carts', 'shipping_info', 'total','ship_id'));


        $returnHTML = view('frontend.partials.cart_summary', compact('coupon', 'carts', 'service', 'shipping_info'))->render();
        return response()->json(array('response_message' => $response_message, 'html' => $returnHTML));
        //        return view('frontend.partials.cart_summary', compact('coupon', 'carts', 'shipping_info', 'response_message'));
    }

    public function remove_coupon_code(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)
            ->where('owner_id', $request->owner_id)
            ->update(
                [
                    'discount' => 0.00,
                    'coupon_code' => '',
                    'coupon_applied' => 0
                ]
            );

        $coupon = Coupon::where('code', $request->code)->first();
        $carts = Cart::where('user_id', Auth::user()->id)
            ->where('owner_id', $request->owner_id)
            ->get();
        //        dd($carts);
        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();

        return view('frontend.partials.cart_summary', compact('coupon', 'carts', 'shipping_info'));
        //        return back();
    }

    public function apply_club_point(Request $request)
    {
        if (
            \App\Addon::where('unique_identifier', 'club_point')->first() != null &&
            \App\Addon::where('unique_identifier', 'club_point')->first()->activated
        ) {

            $point = $request->point;

            //            if(Auth::user()->club_point->points >= $point) {
            if (Auth::user()->point_balance >= $point) {
                $request->session()->put('club_point', $point);
                flash(translate('Point has been redeemed'))->success();
            } else {
                flash(translate('Invalid point!'))->warning();
            }
        }
        return back();
    }

    public function remove_club_point(Request $request)
    {
        $request->session()->forget('club_point');
        return back();
    }

    public function order_confirmed()
    {
        $order = Order::findOrFail(Session::get('order_id'));

        Cart::where('user_id', $order->user_id)
            ->delete();

        return view('frontend.order_confirmed', compact('order'));
    }
}
