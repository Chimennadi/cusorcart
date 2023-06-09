<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\HomeCategory;
use App\Product;
use App\Language;
use App\CategoryTranslation;
use App\Utility\CategoryUtility;
use App\Order;
use App\PickupPoint;
use App\User;
use App\Wallet;
use App\Seller;
use App\Payment;
use App\BankDetail;
use App\Feedback;
use App\Complaint;
use App\PartnerRegister;
use CoreComponentRepository;
use App\LogisticSale;
use DB;
use Auth;
use Mail;
use App\Mail\SecondEmailVerifyMailManager;
use Illuminate\Support\Str;
use App\Imports\UsersImport;
use App\Imports\CountryImport;
use App\Imports\CityImport;

use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function dashboard() {
        return view('backend.logistic.dashboard');
    }
    
    
    public function importExportView() {
        return view('backend.import.state');
    }
    
    
    public function importExportView1() {
        return view('backend.import.city');
    }
    
    
    public function importExportView2() {
        return view('backend.import.country');
    }
    
    public function import() {
        Excel::import(new UsersImport,request()->file('photos'));
        return back();
    }
    
    public function import1() {
        Excel::import(new CityImport,request()->file('photos'));
        return back();
    }
    
    public function import2() {
        Excel::import(new CountryImport,request()->file('photos'));
        return back();
    }
    
    public function bankdetail() {
        return view('backend.dashboard.bankdetail');
    }
    
    public function bankdetailpost(Request $request) {
        $bankdetail = new BankDetail();
        $bankdetail->user_id = Auth::user()->id;
        $bankdetail->bankname = request('bankname');
        $bankdetail->acount_no = request('acount_no');
        $bankdetail->acount_title = request('acount_title');
        $bankdetail->branch_code = request('branch_code');
        $bankdetail->branch_address = request('branch_address');
        $bankdetail->save();
        return back();
    }
    
    public function bankdetailupdate(Request $request) {
        $bankdetail = BankDetail::where('user_id',Auth::user()->id)->first();
        $bankdetail->user_id = Auth::user()->id;
        $bankdetail->bankname = request('bankname');
        $bankdetail->acount_no = request('acount_no');
        $bankdetail->acount_title = request('acount_title');
        $bankdetail->branch_code = request('branch_code');
        $bankdetail->branch_address = request('branch_address');
        $bankdetail->save();
        return back();
    }
    
    public function tracking() {
        return view('backend.dashboard.tracking');
    }
    
    public function tracking_post(Request $request) {
        $query = "";
        if ($request->has('query')) {
            $query = request('name');
        }
        $code = $request->name;
        $orders = Order::where('code','like', '%'.$code.'%')->first();
        return view('backend.dashboard.tracking_req',compact('orders'));
        //return $orders;
    }
    
    
    public function language(Request $request) {
        $languages = Language::paginate(10);
        return view('backend.setup_configurations.languages.index', compact('languages'));
    }
    
    public function all_orders(Request $request) {
        //CoreComponentRepository::instantiateShopRepository();
        $date = $request->date;
        $sort_search = null;
        $orders = Order::orderBy('code', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        if ($date != null) {
            $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }
        $orders = $orders->paginate(15);
        return view('backend.sales.all_orders.index', compact('orders', 'sort_search', 'date'));
    }
    
    public function pickup_manager(Request $request) {
        $sort_search =null;
        $pickup_points = PickupPoint::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $pickup_points = $pickup_points->where('name', 'like', '%'.$sort_search.'%');
        }
        $pickup_points = $pickup_points->paginate(10);
        return view('backend.setup_configurations.pickup_point.index', compact('pickup_points','sort_search'));
    }
    
    public function shipping_configuration(Request $request) {
        return view('backend.setup_configurations.shipping_configuration.logistic');
    }

    public function wallet_transaction(Request $request) {
        $user_id = null;
        $date_range = null;
        
        if($request->user_id) {
            $user_id = $request->user_id;
        }
        
        $users_with_wallet = User::whereIn('id', function($query) {
            $query->select('user_id')->from(with(new Wallet)->getTable());
        })->get();

        $wallet_history = Wallet::orderBy('created_at', 'desc');
        
        if ($request->date_range) {
            $date_range = $request->date_range;
            $date_range1 = explode(" / ", $request->date_range);
            $wallet_history = $wallet_history->where('created_at', '>=', $date_range1[0]);
            $wallet_history = $wallet_history->where('created_at', '<=', $date_range1[1]);
        }
        if ($user_id){
            $wallet_history = $wallet_history->where('user_id', '=', $user_id);
        }
        $logics = LogisticSale::all();
        $wallets = $wallet_history->paginate(10);
        return view('backend.dashboard.earnings.wallet', compact('wallets','logics', 'users_with_wallet', 'user_id', 'date_range'));
    }
        
    public function sales(Request $request) {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(15);
        return view('backend.dashboard.earnings.total_earning.over_sale', compact('payments'));
    }

    public function feedback() {
        $feedbacks = Feedback::paginate(10);
        return view('backend.dashboard.report.feedback',compact('feedbacks'));
    }
        
    public function score() {
        $orders = Order::where('payment_status','paid')->where('delivery_status','delivered')->paginate(10);
        return view('backend.dashboard.report.score',compact('orders'));
    }

    public function complaint() {
        $complaints = Complaint::paginate(10);
        return view('backend.dashboard.report.complaint',compact('complaints'));
    }
        
    public function p_register() {
        $regs = PartnerRegister::paginate(10);
        return view('backend.dashboard.setting.register_partner',compact('regs'));
    }
        
    public function p_approve(Request $request) {
        $approve = PartnerRegister::where('id',$request->id)->first();
        $approve->status = $request->status;
        $approve->save();
        $array['view'] = 'emails.verification';
        $array['subject'] = translate('Your Profile has been Approved');
        $array['content'] = translate('Your Profile has been Approved');
        $array['from'] = env('MAIL_FROM_ADDRESS');
        try {
                Mail::to($approve->email)->queue(new SecondEmailVerifyMailManager($array));
        } catch (\Exception $e) {
            //return 'something wrong';
        }
        if($request->status == 'approve') {
        $user = User::where('email',$approve->email)->first();
            if($user == "") {
                $user = new User();
                $user->name = $approve->name;
                $user->email = $approve->email;
                $user->password = $approve->password;
                $user->user_type = "logistic";
                $user->address = $approve->address;
                $user->country = $approve->reg_country;
                $user->phone = $approve->per_phone;
                $user->verification_code =  date('Y-m-d', time());
                $user->save();
            }
        }
        return back();
    }

    public function delivery_status($id,Request $request){
        $order = Order::find($id);
        $order->delivery_status = $request->delivery_status;
        $order->save();
        return back();
    }
}
