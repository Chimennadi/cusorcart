<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SellerWithdrawRequest;
use App\LogisticSale;
use App\Order;
use Auth;
use App\Seller;
use Mail;
use App\Mail\SecondEmailVerifyMailManager;
use Illuminate\Support\Str;

class SellerWithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller_withdraw_requests = SellerWithdrawRequest::where('user_id', Auth::user()->seller->id)->paginate(9);
        return view('frontend.user.seller.seller_withdraw_requests.index', compact('seller_withdraw_requests'));
    }

    public function request_index()
    {
        $seller_withdraw_requests = SellerWithdrawRequest::paginate(15);
        return view('backend.sellers.seller_withdraw_requests.index', compact('seller_withdraw_requests'));
    }
    
     public function request_dashboard()
    {
        $logics= LogisticSale::where('request','on')->paginate(15);
        return view('backend.sellers.seller_withdraw_requests.dashboard', compact('logics'));
    }


    public function send_request_dashboard()
    {
        $logics= LogisticSale::where('request','!=','on')->paginate(15);
        return view('backend.sellers.seller_withdraw_requests.dashboard_req', compact('logics'));
    }


public function send_withdraw(Request $request,$id)
{
    $order = LogisticSale::find($id);
    $order->request = 'on';
    $order->save();
    return redirect('/send_request_dashboard');
}



     public function pay_withdraw($id)
    {
        $order= Order::find($id);
        return view('backend.sellers.seller_withdraw_requests.paywithdraw', compact('order'));
    }


public function paid_withdraw(Request $request,$id)
{
    $order = Order::find($id);
    $order->payment_status = $request->payment_status;
    $order->save();
      $email = $request->reqemail;
        $array['view'] = 'emails.verification';
        if($request->payment_status == 'rejected'){
            $array['subject'] = translate('Your Payment Request has been Rejected');
             $array['content'] = translate('Your Payment Request has been Rejected');
        }else{
             $array['subject'] = translate('Your Payment Request has been Approved');
             $array['content'] = translate('Your Payment Request has been Approved');
        }
            $array['from'] = env('MAIL_FROM_ADDRESS');
            

          
               try {
                    Mail::to($email)->queue(new SecondEmailVerifyMailManager($array));
               } catch (\Exception $e) {
                    return 'something wrong';
                }
    
    
    return redirect('/dashboard_withdraw');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller_withdraw_request = new SellerWithdrawRequest;
        $seller_withdraw_request->user_id = Auth::user()->seller->id;
        $seller_withdraw_request->amount = $request->amount;
        $seller_withdraw_request->message = $request->message;
        $seller_withdraw_request->status = '0';
        $seller_withdraw_request->viewed = '0';
        if ($seller_withdraw_request->save()) {
            flash(translate('Request has been sent successfully'))->success();
            return redirect()->route('withdraw_requests.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function payment_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        $seller_withdraw_request = SellerWithdrawRequest::where('id', $request->seller_withdraw_request_id)->first();
        return view('backend.sellers.seller_withdraw_requests.payment_modal', compact('seller', 'seller_withdraw_request'));
    }

    public function message_modal(Request $request)
    {
        $seller_withdraw_request = SellerWithdrawRequest::findOrFail($request->id);
        if (Auth::user()->user_type == 'seller') {
            return view('frontend.partials.withdraw_message_modal', compact('seller_withdraw_request'));
        }
        elseif (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('backend.sellers.seller_withdraw_requests.withdraw_message_modal', compact('seller_withdraw_request'));
        }
    }
}
