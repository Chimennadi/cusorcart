<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingDetail;
use App\User;
use App\Country;
use Auth;
use Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ShippingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $page = $request->input('page');
        $sort_search = '';
        
        if ($request->has('search')) {
            $sort_search = $request->search;
            $ships = ShippingDetail::where('user_id', Auth::user()->id)->where('service', 'like', '%'.$sort_search.'%')->paginate(100);
            return view('backend.shippingdetail.index1', compact('ships', 'page', 'sort_search'));
        }
        
        if(!($request->input("country_id"))) {
            if (Auth::user()->user_type == "admin") {
                $ships = ShippingDetail::paginate(100);
                return view('backend.shippingdetail.index', compact('ships', 'page', 'sort_search'));
            } else {
                $ships = ShippingDetail::where('user_id',Auth::user()->id)->paginate(100);
                return view('backend.shippingdetail.index1', compact('ships', 'page', 'sort_search'));
            }
            
            return view('backend.shippingdetail.index1', compact('ships', 'page', 'sort_search'));
        }
        
        $ships = ShippingDetail::where('country', request()->input("country_id"));
        
        if (request()->input("state_id")) {
            $ships = $ships->where('state', request()->input("state_id"));
        }
        
        if (request()->input("city_id")) {
            $ships = $ships->where('city', request()->input("city_id"));
        }
        
        if (request()->input("country_id_arrival")) {
            $ships = $ships->where('ship_country', request()->input("country_id_arrival"));
        }     
        
        if (request()->input("state_id_arrival")) {
            $ships = $ships->where('ship_state', request()->input("state_id_arrival"));
        }
        
        if (request()->input("city_id__arrival")) {
            $ships = $ships->where('ship_city', request()->input("city_id__arrival"));
        }
        
        if (!(Auth::user()->user_type == "admin")) {
            $ships = $ships->where('user_id', Auth::user()->id);
        }
        
        $ships = $ships->paginate(100);
        
        if(Auth::user()->user_type == "admin") {
            return view('backend.shippingdetail.index',compact('ships', 'page', 'sort_search'));
        } else {
            return view('backend.shippingdetail.index1', compact('ships', 'page', 'sort_search'));
        }
    }
    
    public function filter() {
        $countries = Country::where('status', 1)->get();
        
        if(Auth::user()->user_type == "admin")
        {
            Log::info("admin detected");
            return view('backend.shippingdetail.form', compact('countries'));
        }
        
        return view('backend.shippingdetail.form1', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countries = Country::where('status', 1)->get();

        if(Auth::user()->user_type == "admin") {
            return view('backend.shippingdetail.create',compact('countries'));  
        }
        
        else { 
            return view('backend.shippingdetail.create1',compact('countries'));
        
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
        $ip = $request->ip();
            if ($position = \Location::get($ip)) {
                // Successfully retrieved position.
                // echo $position->countryName;
            } else {
                // Failed retrieving position.
            }
        // dd($position);
        $shipping = new ShippingDetail();
        $shipping->service = $request->service;
        $shipping->user_id = Auth::User()->id;
        $shipping->service_charges = $request->service_charges;
        $shipping->gst_rate = $request->gst_rate;
        $shipping->kg = $request->kg;
        $shipping->price_currecny = $request->price_currecny;
        
        
        $shipping->country = $request->country_id;
        $shipping->state = $request->state_id;
        $shipping->city = $request->city_id;
        $shipping->ship_country = $request->country_id_arrival;
        $shipping->ship_state = $request->state_id_arrival;
        $shipping->ship_city = $request->city_id__arrival;
        
        
        $shipping->amount = $request->amount;
        $shipping->transit_day = $request->transit_day;
        $shipping->shipping_tax = $request->shipping_tax;
        $shipping->pickup_date = $request->pickup_date;
        $shipping->pickup_time = $request->pickup_time;
        $shipping->arrival_date = $request->arrival_date;
        $shipping->arrival_time = $request->arrival_time;
        $shipping->delivery_time_frame = $request->time_frame;

        if(Auth::user()->user_type == "admin") {
            $shipping->status = $request->status;
            $data['title'] = "This is Test Mail Tuts Make";
            Mail::send('emails.services_review', $data, function($message) {
                $message->to(Auth::user()->email, Auth::user()->name)
                        ->subject('Your logistics service is under review.');
            });
        } else {
            $shipping->status = "Pending";
            $data['title'] = "This is Test Mail Tuts Make";
            Mail::send('emails.services_review', $data, function($message) {
                $message->to(Auth::user()->email, Auth::user()->name)
                        ->subject('Your logistics service is under review.');
            });
        }
        
        $shipping->save();
        return redirect(route('shipping.detail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id) {
        $page = $request->input('page');
        $ship = ShippingDetail::find($id);
        //dd($ship);
        $countries = Country::where('status', 1)->get();
        if(Auth::user()->user_type == "admin") {
            return view('backend.shippingdetail.edit',compact('ship','countries', 'page'));
        } else {
            return view('backend.shippingdetail.edit1',compact('ship','countries', 'page'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $page = $request->input('page');
        $ip = $request->ip();
        if ($position = \Location::get($ip)) {
            // Successfully retrieved position.
            echo $position->countryName;
        } else {
            // Failed retrieving position.
        }
        $shipping = ShippingDetail::find($id);
        $shipping->service = $request->service;
        $shipping->service_charges = $request->service_charges;
        $shipping->gst_rate = $request->gst_rate;
        $shipping->kg = $request->kg;
        $shipping->price_currecny = $request->price_currecny;
        // $shipping->city = $position->cityName;
        $shipping->amount = $request->amount;
        $shipping->transit_day = $request->transit_day;
        $shipping->shipping_tax = $request->shipping_tax;
        $shipping->pickup_date = $request->pickup_date;
        $shipping->pickup_time = $request->pickup_time;
        $shipping->arrival_date = $request->arrival_date;
        $shipping->arrival_time = $request->arrival_time;
        
        
        $shipping->country = $request->country_id;
        $shipping->state = $request->state_id;
        $shipping->city = $request->city_id;
        $shipping->ship_country = $request->country_id_arrival;
        $shipping->ship_state = $request->state_id_arrival;
        $shipping->ship_city = $request->city_id__arrival;
        
        $shipping->delivery_time_frame = $request->time_frame;
        
        if(Auth::user()->user_type == "admin") {
            if($request->status == "Reject") {
                $shipping->status = $request->status;
                $data['title'] = "This is Test Mail Tuts Make";
                $users =  User::where('id',$shipping->user_id)->first();
                Mail::send('emails.services_review2', $data, function($message) use ($users) {
                    $message->to($users->email, $users->name)
                            ->subject('logistics Services is Reject.');
                });
            }

            if($request->status == "Approved") {
                $shipping->status = $request->status;
                $data['title'] = "This is Test Mail Tuts Make";
                $users =  User::where('id',$shipping->user_id)->first();
                Mail::send('emails.services_review1', $data, function($message) use ($users) {
                    $message->to($users->email, $users->name)
                            ->subject('logistics Services is Approved.');
                });
            }

            if($request->status == "Pending") {
                $data['title'] = "This is Test Mail Tuts Make";
                $users =  User::where('id',$shipping->user_id)->first();
                Mail::send('emails.services_review', $data, function($message) use ($users) {
                    $message->to($users->email, $users->name)
                            ->subject('logistics Services is Pending.');
                });
            }
        } else {
            $shipping->status = "Pending";
            $data['title'] = "This is Test Mail Tuts Make";
            Mail::send('emails.services_review', $data, function($message) {
                $message->to(Auth::user()->email, Auth::user()->name)
                        ->subject('Your logistics service is under review');
            });
        }
        
        $shipping->save();
        
        Log::info(["page" => $page]);
        
        return redirect(route('shipping.detail', [
            "page" => $page,
            "country_id" => $shipping->country,
            "state_id" => $shipping->state,
            "country_id_arrival" => $shipping->ship_country,
            "state_id_arrival" => $shipping->ship_state
        ]));
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $ship = ShippingDetail::find($id);
        //dd($ship);
        $ship->delete();
        flash(translate('Your Shipping Details has been deleted successfully'))->success();
        return back();
    }
}
