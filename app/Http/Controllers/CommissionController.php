<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PublicSslCommerzPaymentController;
use App\Http\Controllers\InstamojoController;
use App\Http\Controllers\PaystackController;
use App\SellerWithdrawRequest;
use App\Seller;
use App\Payment;
use Session;

class CommissionController extends Controller
{
    //redirect to payment controllers according to selected payment gateway for seller payment
    public function pay_to_seller(Request $request)
    {
        $data['seller_id'] = $request->seller_id;
        $data['amount'] = $request->amount;
        $data['payment_method'] = $request->payment_option;
        $data['payment_withdraw'] = $request->payment_withdraw;
        $data['withdraw_request_id'] = $request->withdraw_request_id;

        if ($request->txn_code != null) {
            $data['txn_code'] = $request->txn_code;
        }
        else {
            $data['txn_code'] = null;
        }

        $request->session()->put('payment_type', 'seller_payment');
        $request->session()->put('payment_data', $data);

        if ($request->payment_option == 'cash') {
            return $this->seller_payment_done($request->session()->get('payment_data'), null);
        }
        elseif ($request->payment_option == 'bank_payment') {
            return $this->seller_payment_done($request->session()->get('payment_data'), null);
        }
        else {
            $payment_data = $request->session()->get('payment_data');

            $seller = Seller::findOrFail($payment_data['seller_id']);
            $seller->admin_to_pay = $seller->admin_to_pay + $payment_data['amount'];
            $seller->save();

            $payment = new Payment;
            $payment->seller_id = $seller->id;
            $payment->amount = $payment_data['amount'];
            $payment->payment_method = 'Seller paid to admin';
            $payment->txn_code = $payment_data['txn_code'];
            $payment->payment_details = null;
            $payment->save();

            flash(translate('Payment completed'))->success();
            return redirect()->route('sellers.index');
        }
    }

    //redirects to this method after successfull seller payment
    public function seller_payment_done($payment_data, $payment_details){
        $seller = Seller::findOrFail($payment_data['seller_id']);
        $seller->admin_to_pay = $seller->admin_to_pay - $payment_data['amount'];
        $seller->save();

        $payment = new Payment;
        $payment->seller_id = $seller->id;
        $payment->amount = $payment_data['amount'];
        $payment->payment_method = $payment_data['payment_method'];
        $payment->txn_code = $payment_data['txn_code'];
        $payment->payment_details = $payment_details;
        $payment->save();

        if ($payment_data['payment_withdraw'] == 'withdraw_request') {
            $seller_withdraw_request = SellerWithdrawRequest::findOrFail($payment_data['withdraw_request_id']);
            $seller_withdraw_request->status = '1';
            $seller_withdraw_request->viewed = '1';
            $seller_withdraw_request->save();
        }

        Session::forget('payment_data');
        Session::forget('payment_type');

        if ($payment_data['payment_withdraw'] == 'withdraw_request') {
            flash(translate('Payment completed'))->success();
            return redirect()->route('withdraw_requests_all');
        }
        else {
            flash(translate('Payment completed'))->success();
            return redirect()->route('sellers.index');
        }
    }
}
