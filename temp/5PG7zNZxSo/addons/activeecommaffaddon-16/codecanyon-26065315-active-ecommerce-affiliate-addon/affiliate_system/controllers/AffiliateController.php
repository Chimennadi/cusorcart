<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AffiliateOption;
use App\Addon;
use App\Order;
use App\BusinessSetting;
use App\AffiliateConfig;
use App\AffiliateUser;
use App\AffiliatePayment;
use App\AffiliateEarningDetail;
use App\AffiliateWithdrawRequest;
use App\AffiliateLog;
use App\AffiliateStats;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\Category;
use Session;
use Cookie;
use Auth;
use DB;
use Hash;
use Illuminate\Auth\Events\Registered;

class AffiliateController extends Controller
{
    //
    public function index(){
        return view('affiliate.index');
    }

    public function affiliate_option_store(Request $request){
        //dd($request->all());
        $affiliate_option = AffiliateOption::where('type', $request->type)->first();
        if($affiliate_option == null){
            $affiliate_option = new AffiliateOption;
        }
        $affiliate_option->type = $request->type;

        $commision_details = array();
        if ($request->type == 'user_registration_first_purchase') {
            $affiliate_option->percentage = $request->percentage;
        }
        elseif ($request->type == 'product_sharing') {
            $commision_details['commission'] = $request->amount;
            $commision_details['commission_type'] = $request->amount_type;
        }
        elseif ($request->type == 'category_wise_affiliate') {
            foreach(Category::all() as $category) {
                $data['category_id'] = $request['categories_id_'.$category->id];
                $data['commission'] = $request['commison_amounts_'.$category->id];
                $data['commission_type'] = $request['commison_types_'.$category->id];
                array_push($commision_details, $data);
            }
        }
        elseif ($request->type == 'max_affiliate_limit') {
            $affiliate_option->percentage = $request->percentage;
        }
        $affiliate_option->details = json_encode($commision_details);

        if ($request->has('status')) {
            $affiliate_option->status = 1;
            if($request->type == 'product_sharing'){
                $affiliate_option_status_update = AffiliateOption::where('type', 'category_wise_affiliate')->first();
                $affiliate_option_status_update->status = 0;
                $affiliate_option_status_update->save();
            }
            if($request->type == 'category_wise_affiliate'){
                $affiliate_option_status_update = AffiliateOption::where('type', 'product_sharing')->first();
                $affiliate_option_status_update->status = 0;
                $affiliate_option_status_update->save();
            }
        }
        else {
            $affiliate_option->status = 0;
        }
        $affiliate_option->save();

        flash("This has been updated successfully")->success();
        return back();
    }

    public function configs(){
        return view('affiliate.configs');
    }

    public function config_store(Request $request){
        if($request->type == 'validation_time') {
            //affiliate validation time
            $affiliate_config = AffiliateConfig::where('type', $request->type)->first();
            if($affiliate_config == null){
                $affiliate_config = new AffiliateConfig;
            }
            $affiliate_config->type = $request->type;
            $affiliate_config->value = $request[$request->type];
            $affiliate_config->save();
            
            flash("Validation time updated successfully")->success();
        } else {
            
            $form = array();
            $select_types = ['select', 'multi_select', 'radio'];
            $j = 0;
            for ($i=0; $i < count($request->type); $i++) {
                $item['type'] = $request->type[$i];
                $item['label'] = $request->label[$i];
                if(in_array($request->type[$i], $select_types)){
                    $item['options'] = json_encode($request['options_'.$request->option[$j]]);
                    $j++;
                }
                array_push($form, $item);
            }
            $affiliate_config = AffiliateConfig::where('type', 'verification_form')->first();
            $affiliate_config->value = json_encode($form);
            
            flash("Verification form updated successfully")->success();
        }
        if($affiliate_config->save()){
            return back();
        }
    }

    public function apply_for_affiliate(Request $request){
        return view('affiliate.frontend.apply_for_affiliate');
    }

    public function affiliate_logs_admin()
    {
        $affiliate_logs = AffiliateLog::latest()->paginate(10);
        return view('affiliate.affiliate_logs',compact('affiliate_logs'));
    }

    public function store_affiliate_user(Request $request){
        if(!Auth::check()){
            if(User::where('email', $request->email)->first() != null){
                flash(translate('Email already exists!'))->error();
                return back();
            }
            if($request->password == $request->password_confirmation){
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->user_type = "customer";
                $user->password = Hash::make($request->password);
                $user->save();

                $customer = new Customer;
                $customer->user_id = $user->id;
                $customer->save();

                auth()->login($user, false);

                if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
                    $user->email_verified_at = date('Y-m-d H:m:s');
                    $user->save();
                }
                else {
                    event(new Registered($user));
                }
            }
            else{
                flash(translate('Sorry! Password did not match.'))->error();
                return back();
            }
        }

        $affiliate_user = Auth::user()->affiliate_user;
        if ($affiliate_user == null) {
            $affiliate_user = new AffiliateUser;
            $affiliate_user->user_id = Auth::user()->id;
        }
        $data = array();
        $i = 0;
        foreach (json_decode(AffiliateConfig::where('type', 'verification_form')->first()->value) as $key => $element) {
            $item = array();
            if ($element->type == 'text') {
                $item['type'] = 'text';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i];
            }
            elseif ($element->type == 'select' || $element->type == 'radio') {
                $item['type'] = 'select';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i];
            }
            elseif ($element->type == 'multi_select') {
                $item['type'] = 'multi_select';
                $item['label'] = $element->label;
                $item['value'] = json_encode($request['element_'.$i]);
            }
            elseif ($element->type == 'file') {
                $item['type'] = 'file';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i]->store('uploads/affiliate_verification_form');
            }
            array_push($data, $item);
            $i++;
        }
        $affiliate_user->informations = json_encode($data);
        if($affiliate_user->save()){
            flash(translate('Your verification request has been submitted successfully!'))->success();
            return redirect()->route('home');
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function users(){
        $affiliate_users = AffiliateUser::paginate(12);
        return view('affiliate.users', compact('affiliate_users'));
    }

    public function show_verification_request($id){
        $affiliate_user = AffiliateUser::findOrFail($id);
        return view('affiliate.show_verification_request', compact('affiliate_user'));
    }

    public function approve_user($id)
    {
        $affiliate_user = AffiliateUser::findOrFail($id);
        $affiliate_user->status = 1;
        if($affiliate_user->save()){
            flash(translate('Affiliate user has been approved successfully'))->success();
            return redirect()->route('affiliate.users');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function reject_user($id)
    {
        $affiliate_user = AffiliateUser::findOrFail($id);
        $affiliate_user->status = 0;
        $affiliate_user->informations = null;
        if($affiliate_user->save()){
            flash(translate('Affiliate user request has been rejected successfully'))->success();
            return redirect()->route('affiliate.users');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function updateApproved(Request $request)
    {
        $affiliate_user = AffiliateUser::findOrFail($request->id);
        $affiliate_user->status = $request->status;
        if($affiliate_user->save()){
            return 1;
        }
        return 0;
    }

    public function payment_modal(Request $request)
    {
        $affiliate_user = AffiliateUser::findOrFail($request->id);
        return view('affiliate.payment_modal', compact('affiliate_user'));
    }

    public function payment_store(Request $request){
        $affiliate_payment = new AffiliatePayment;
        $affiliate_payment->affiliate_user_id = $request->affiliate_user_id;
        $affiliate_payment->amount = $request->amount;
        $affiliate_payment->payment_method = $request->payment_method;
        $affiliate_payment->save();

        $affiliate_user = AffiliateUser::findOrFail($request->affiliate_user_id);
        $affiliate_user->balance -= $request->amount;
        $affiliate_user->save();

        flash(translate('Payment completed'))->success();
        return back();
    }

    public function payment_history($id){
        $affiliate_user = AffiliateUser::findOrFail(decrypt($id));
        $affiliate_payments = $affiliate_user->affiliate_payments();
        return view('affiliate.payment_history', compact('affiliate_payments', 'affiliate_user'));
    }

    public function user_index(Request $request){
        $affiliate_logs = AffiliateLog::where('referred_by_user', Auth::user()->id)->latest()->paginate(10);
        
        $query = AffiliateStats::query();
        $query = $query->select(
                        DB::raw('SUM(no_of_click) AS count_click, SUM(no_of_order_item) AS count_item, SUM(no_of_delivered) AS count_delivered,  SUM(no_of_cancel) AS count_cancel')
                );
        if($request->type == 'Today') {
            $query->whereDate('created_at', Carbon::today());
        } else if($request->type == '7' || $request->type ==  '30') {
            $query->whereRaw('created_at  <= NOW() AND created_at >= DATE_SUB(created_at, INTERVAL '. $request->type .' DAY)');
        }
        $query->where('affiliate_user_id', Auth::user()->id);
        $affliate_stats = $query->first();
        $type = $request->type;
                
//        dd($type);
        return view('affiliate.frontend.index', compact('affiliate_logs', 'affliate_stats', 'type'));
    }

    // payment history for user
    public function user_payment_history(){
        $affiliate_user = Auth::user()->affiliate_user;
        $affiliate_payments = $affiliate_user->affiliate_payments();

        return view('affiliate.frontend.payment_history', compact('affiliate_payments'));
    }

    // withdraw request history for user
    public function user_withdraw_request_history(){
        $affiliate_user = Auth::user()->affiliate_user;
        $affiliate_withdraw_requests = AffiliateWithdrawRequest::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

        return view('affiliate.frontend.withdraw_request_history', compact('affiliate_withdraw_requests'));
    }

    public function payment_settings(){
        $affiliate_user = Auth::user()->affiliate_user;
        return view('affiliate.frontend.payment_settings', compact('affiliate_user'));
    }

    public function payment_settings_store(Request $request){
        $affiliate_user = Auth::user()->affiliate_user;
        $affiliate_user->paypal_email = $request->paypal_email;
        $affiliate_user->bank_information = $request->bank_information;
        $affiliate_user->save();
        flash(translate('Affiliate payment settings has been updated successfully'))->success();
        return redirect()->route('affiliate.user.index');
    }

    public function processAffiliatePoints(Order $order){
        if(Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated){
            if(AffiliateOption::where('type', 'user_registration_first_purchase')->first()->status){
                if ($order->user != null && $order->user->orders->count() == 1) {
                    if($order->user->referred_by != null){
                        $user = User::find($order->user->referred_by);
                        if ($user != null) {
                            $amount = (AffiliateOption::where('type', 'user_registration_first_purchase')->first()->percentage * $order->grand_total)/100;
                            $affiliate_user = $user->affiliate_user;
                            if($affiliate_user != null){
                                $affiliate_user->balance += $amount;
                                $affiliate_user->save();

                                // Affiliate log
                                $affiliate_log                      = new AffiliateLog;
                                $affiliate_log->user_id             = $order->user_id;
                                $affiliate_log->referred_by_user    = $order->user->referred_by;
                                $affiliate_log->amount              = $amount;
                                $affiliate_log->order_id            = $order->id;
                                $affiliate_log->affiliate_type      = 'user_registration_first_purchase';
                                $affiliate_log->save();
                            }
                        }
                    }
                }
            }
            if(AffiliateOption::where('type', 'product_sharing')->first()->status){
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $amount = 0;
                    if($orderDetail->product_referral_code != null){
                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();
                        if($referred_by_user != null) {
                            if(AffiliateOption::where('type', 'product_sharing')->first()->details != null && json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission_type == 'amount'){
                                $amount = json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission;
                            }
                            elseif(AffiliateOption::where('type', 'product_sharing')->first()->details != null && json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission_type == 'percent') {
                                $amount = (json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission * $orderDetail->price)/100;
                            }
                            $affiliate_user = $referred_by_user->affiliate_user;
                            if($affiliate_user != null){
                                $affiliate_user->balance += $amount;
                                $affiliate_user->save();

                                // Affiliate log
                                $affiliate_log                      = new AffiliateLog;
                                if($order->user_id != null){
                                    $affiliate_log->user_id         = $order->user_id;
                                }
                                else{
                                    $affiliate_log->guest_id        = $order->guest_id;
                                }
                                $affiliate_log->referred_by_user    = $referred_by_user->id;
                                $affiliate_log->amount              = $amount;
                                $affiliate_log->order_id            = $order->id;
                                $affiliate_log->order_detail_id     = $orderDetail->id;
                                $affiliate_log->affiliate_type      = 'product_sharing';
                                $affiliate_log->save();
                            }
                        }
                    }
                }
            }
            elseif (AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $amount = 0;
                    if($orderDetail->product_referral_code != null) {
                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();
                        if($referred_by_user != null) {
                            if(AffiliateOption::where('type', 'category_wise_affiliate')->first()->details != null){
                                foreach (json_decode(AffiliateOption::where('type', 'category_wise_affiliate')->first()->details) as $key => $value) {
                                    if($value->category_id == $orderDetail->product->category->id){
                                        if($value->commission_type == 'amount'){
                                            $amount = $value->commission;
                                        }
                                        else {
                                            $amount = ($value->commission * $orderDetail->price)/100;
                                        }
                                    }
                                }
                            }
                            $affiliate_user = $referred_by_user->affiliate_user;
                            if($affiliate_user != null){
                                $affiliate_user->balance += $amount;
                                $affiliate_user->save();

                                // Affiliate log
                                $affiliate_log                      = new AffiliateLog;
                                if($order->user_id != null){
                                    $affiliate_log->user_id         = $order->user_id;
                                }
                                else{
                                    $affiliate_log->guest_id        = $order->guest_id;
                                }
                                $affiliate_log->referred_by_user    = $referred_by_user->id;
                                $affiliate_log->amount              = $amount;
                                $affiliate_log->order_id            = $order->id;
                                $affiliate_log->order_detail_id     = $orderDetail->id;
                                $affiliate_log->affiliate_type      = 'category_wise_affiliate';
                                $affiliate_log->save();
                            }
                        }
                    }
                }
            }
        }
    }
    
    public function processAffiliateStats($affiliate_user_id, $no_click = 0, $no_item = 0, $no_delivered = 0, $no_cancel = 0) {
        $affiliate_stats = AffiliateStats::whereDate('created_at', Carbon::today())
                ->where("affiliate_user_id", $affiliate_user_id)
                ->first();
        
        if(!$affiliate_stats) {
            $affiliate_stats = new AffiliateStats;
            $affiliate_stats->no_of_order_item = 0;
            $affiliate_stats->no_of_delivered = 0;
            $affiliate_stats->no_of_cancel = 0;
            $affiliate_stats->no_of_click = 0;
        }
        
        $affiliate_stats->no_of_order_item += $no_item;
        $affiliate_stats->no_of_delivered += $no_delivered;
        $affiliate_stats->no_of_cancel += $no_cancel;
        $affiliate_stats->no_of_click += $no_click;
        $affiliate_stats->affiliate_user_id = $affiliate_user_id;
        
//        dd($affiliate_stats);
        $affiliate_stats->save();
        
//        foreach($order->orderDetails as $key => $orderDetail) {
//            $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();
//            
//            if($referred_by_user != null) {
//                if($orderDetail->delivery_status == 'delivered') {
//                    $affiliate_stats->no_of_delivered++;
//                } if($orderDetail->delivery_status == 'cancelled') {
//                    $affiliate_stats->no_of_cancel++;
//                }
//                
//                $affiliate_stats->affiliate_user_id = $referred_by_user->id;
//                dd($affiliate_stats);
//                $affiliate_stats->save();
//            }
//        }
    }

    public function refferal_users()
    {
        $refferal_users = User::where('referred_by', '!=' , null)->paginate(10);
        return view('affiliate.refferal_users', compact('refferal_users'));
    }

    // Affiliate Withdraw Request
    public function withdraw_request_store(Request $request)
    {
        $withdraw_request           = new AffiliateWithdrawRequest;
        $withdraw_request->user_id  = Auth::user()->id;
        $withdraw_request->amount   = $request->amount;
        $withdraw_request->status   = 0 ;

        if($withdraw_request->save()){

            $affiliate_user = AffiliateUser::where('user_id',Auth::user()->id)->first();
            $affiliate_user->balance = $affiliate_user->balance - $request->amount;
            $affiliate_user->save();

            flash(translate('New withdraw request created successfully'))->success();
            return redirect()->route('affiliate.user.withdraw_request_history');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function affiliate_withdraw_requests()
    {
        $affiliate_withdraw_requests = AffiliateWithdrawRequest::orderBy('id', 'desc')->paginate(10);
        return view('affiliate.affiliate_withdraw_requests', compact('affiliate_withdraw_requests'));
    }

    public function affiliate_withdraw_modal(Request $request)
    {
        $affiliate_withdraw_request = AffiliateWithdrawRequest::findOrFail($request->id);
        $affiliate_user = AffiliateUser::where('user_id',$affiliate_withdraw_request->user_id)->first();
        return view('affiliate.affiliate_withdraw_modal', compact('affiliate_withdraw_request','affiliate_user'));
    }

    public function withdraw_request_payment_store(Request $request){
        $affiliate_payment = new AffiliatePayment;
        $affiliate_payment->affiliate_user_id = $request->affiliate_user_id;
        $affiliate_payment->amount = $request->amount;
        $affiliate_payment->payment_method = $request->payment_method;
        $affiliate_payment->save();

        if ($request->has('affiliate_withdraw_request_id')) {
            $affiliate_withdraw_request = AffiliateWithdrawRequest::findOrFail($request->affiliate_withdraw_request_id);
            $affiliate_withdraw_request->status = 1;
            $affiliate_withdraw_request->save();
        }

        flash(translate('Payment completed'))->success();
        return back();
    }

    public function reject_withdraw_request($id)
    {
        $affiliate_withdraw_request = AffiliateWithdrawRequest::findOrFail($id);
        $affiliate_withdraw_request->status = 2;
        if($affiliate_withdraw_request->save()){

            $affiliate_user = AffiliateUser::where('user_id', $affiliate_withdraw_request->user_id)->first();
            $affiliate_user->balance = $affiliate_user->balance + $affiliate_withdraw_request->amount;
            $affiliate_user->save();

            flash(translate('Affiliate withdraw request has been rejected successfully'))->success();
            return redirect()->route('affiliate.withdraw_requests');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

}
