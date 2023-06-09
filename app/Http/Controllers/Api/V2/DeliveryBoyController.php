<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\OTPVerificationController;
use App\Http\Resources\V2\PurchaseHistoryMiniCollection;
use App\Http\Resources\V2\DeliveryBoyPurchaseHistoryMiniCollection;
use Illuminate\Http\Request;
use App\Http\Resources\V2\DeliveryBoyCollection;
use App\Http\Resources\V2\DeliveryHistoryCollection;
use Auth;
use App\DeliveryBoy;
use App\DeliveryHistory;
use App\Order;
use App\User;

class DeliveryBoyController extends Controller
{

    /**
     * Show the list of assigned delivery by the admin.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function dashboard_summary($id)
    {
        $order_query = Order::query();
        $order_query->where('assign_delivery_boy', $id);


        $delivery_boy = DeliveryBoy::where('user_id', $id)->first();


        //dummy
        /*  return response()->json([
              'completed_delivery' => 123,
              'pending_delivery' => 0,
              'total_collection' => format_price(154126.00),
              'total_earning' => format_price(365.00),
              'cancelled' => 5,
              'on_the_way' => 123,
              'picked' => 24,
              'assigned' => 55,

          ]);*/

        return response()->json([
            'completed_delivery' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'delivered')->count(),
            'pending_delivery' => Order::where('assign_delivery_boy', $id)->where('delivery_status', '!=', 'delivered')->where('delivery_status', '!=', 'cancelled')->where('cancel_request', '0')->count(),
            'total_collection' => format_price($delivery_boy->total_collection),
            'total_earning' => format_price($delivery_boy->total_earning),
            'cancelled' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'cancelled')->count(),
            'on_the_way' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'on_the_way')->where('cancel_request', '0')->count(),
            'picked' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'picked_up')->where('cancel_request', '0')->count(),
            'assigned' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'pending')->where('cancel_request', '0')->count(),

        ]);
    }

    public function assigned_delivery($id)
    {
//        $order_query = Order::query();
//        $order_query->where('delivery_status', 'pending');
//        $order_query->where('cancel_request', '0');

        $order_query = Order::query();
        $order_query->where('assign_delivery_boy', $id);
        $order_query->where(function ($order_query) {
            $order_query->where('delivery_status', 'pending')
                    ->where('cancel_request', '0');
        })->orWhere(function ($order_query) {
            $order_query->where('delivery_status', 'confirmed')
                    ->where('cancel_request', '0');
        });

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->latest('delivery_history_date')->paginate(10));
//        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of pickup delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function picked_up_delivery($id)
    {
        $order_query = Order::query();
        $order_query->where('delivery_status', 'picked_up');
        $order_query->where('cancel_request', '0');

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of pickup delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function on_the_way_delivery($id)
    {
        $order_query = Order::query();
        $order_query->where('delivery_status', 'on_the_way');
        $order_query->where('cancel_request', '0');

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of completed delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function completed_delivery($id)
    {
        $order_query = Order::query();
        $order_query->where('delivery_status', 'delivered');

        //dd(request()->date_range);

        if (request()->has('date_range') && request()->date_range != null &&  request()->date_range != "") {
            $max_date = date('Y-m-d H:i:s');
            $min_date = date('Y-m-d 00:00:00');
            if (request()->date_range == "today") {
                $min_date = date('Y-m-d 00:00:00');
            } else if (request()->date_range == "this_week") {
                //dd("hello");
                $min_date = date('Y-m-d 00:00:00', strtotime("-7 days"));
            } else if (request()->date_range == "this_month") {
                $min_date = date('Y-m-d 00:00:00', strtotime("-30 days"));
            }

            $order_query->where('delivery_history_date','>=',$min_date)->where('delivery_history_date','<=',$max_date);

        }

        if (request()->has('payment_type') && request()->payment_type != null &&  request()->payment_type != "") {

            if (request()->payment_type == "cod") {
                $order_query->where('payment_type','=','cash_on_delivery');
            } else if (request()->payment_type == "non-cod") {
                $order_query->where('payment_type','!=','cash_on_delivery');
            }

        }

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of pending delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pending_delivery($id)
    {
        $order_query = Order::query();
        $order_query->where('delivery_status', '!=', 'delivered');
        $order_query->where('delivery_status', '!=', 'cancelled');
        $order_query->where('cancel_request', '0');

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of cancelled delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function cancelled_delivery($id)
    {
        $order_query = Order::query();
        $order_query->where('delivery_status', 'cancelled');

        if (request()->has('date_range') && request()->date_range != null &&  request()->date_range != "") {
            $max_date = date('Y-m-d H:i:s');
            $min_date = date('Y-m-d 00:00:00');
            if (request()->date_range == "today") {
                $min_date = date('Y-m-d 00:00:00');
            } else if (request()->date_range == "this_week") {
                //dd("hello");
                $min_date = date('Y-m-d 00:00:00', strtotime("-7 days"));
            } else if (request()->date_range == "this_month") {
                $min_date = date('Y-m-d 00:00:00', strtotime("-30 days"));
            }

            $order_query->where('delivery_history_date','>=',$min_date)->where('delivery_history_date','<=',$max_date);

        }

        if (request()->has('payment_type') && request()->payment_type != null &&  request()->payment_type != "") {

            if (request()->payment_type == "cod") {
                $order_query->where('payment_type','=','cash_on_delivery');
            } else if (request()->payment_type == "non-cod") {
                $order_query->where('payment_type','!=','cash_on_delivery');
            }

        }

        return new PurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest()->paginate(10));
    }

    /**
     * Show the list of today's collection by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function collection($id)
    {
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery');

        return new DeliveryHistoryCollection($collection_query->where('delivery_boy_id', $id)->latest()->paginate(10));
    }

    public function earning($id)
    {
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');

        return new DeliveryHistoryCollection($collection_query->where('delivery_boy_id', $id)->latest()->paginate(10));
    }

    public function collection_summary($id)
    {
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery');


        $today_date = date('Y-m-d');
        $yesterday_date = date('Y-m-d', strtotime("-1 day"));
        $today_date_formatted = date('d M, Y');
        $yesterday_date_formatted = date('d M,Y', strtotime("-1 day"));


        $today_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','like',"%$today_date%")
            ->sum('collection');

        $yesterday_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','like',"%$yesterday_date%")
            ->sum('collection');


        return response()->json([
            'today_date' => $today_date_formatted,
            'today_collection' => format_price($today_collection) ,
            'yesterday_date' => $yesterday_date_formatted,
            'yesterday_collection' => format_price($yesterday_collection) ,

        ]);
    }

    public function earning_summary($id)
    {
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery');


        $today_date = date('Y-m-d');
        $yesterday_date = date('Y-m-d', strtotime("-1 day"));
        $today_date_formatted = date('d M, Y');
        $yesterday_date_formatted = date('d M,Y', strtotime("-1 day"));


        $today_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','like',"%$today_date%")
            ->sum('earning');

        $yesterday_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','like',"%$yesterday_date%")
            ->sum('earning');


        return response()->json([
            'today_date' => $today_date_formatted,
            'today_earning' => format_price($today_collection) ,
            'yesterday_date' => $yesterday_date_formatted,
            'yesterday_earning' => format_price($yesterday_collection) ,

        ]);
    }

    /**
     * For only delivery boy while changing delivery status.
     * Call from order controller
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function change_delivery_status(Request $request) {
        $order = Order::find($request->order_id);
        $order->delivery_viewed = '0';
        $order->delivery_status = $request->status;
        $order->save();

        $delivery_history = new DeliveryHistory;

        $delivery_history->order_id         = $order->id;
        $delivery_history->delivery_boy_id  = $request->delivery_boy_id;
        $delivery_history->delivery_status  = $order->delivery_status;
        $delivery_history->payment_type     = $order->payment_type;

        if($order->delivery_status == 'delivered') {
            foreach ($order->orderDetails as $key => $orderDetail) {
                if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                    if ($orderDetail->product_referral_code) {
                        $no_of_delivered = 0;
                        $no_of_canceled = 0;

                        if($request->status == 'delivered') {
                            $no_of_delivered = $orderDetail->quantity;
                        }
                        if($request->status == 'cancelled') {
                            $no_of_canceled = $orderDetail->quantity;
                        }

                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();

                        $affiliateController = new AffiliateController;
                        $affiliateController->processAffiliateStats($referred_by_user->id, 0, 0, $no_of_delivered, $no_of_canceled);
                    }
                }
            }
            $delivery_boy = DeliveryBoy::where('user_id', $request->delivery_boy_id)->first();

            if (get_setting('delivery_boy_payment_type') == 'commission') {
                $delivery_history->earning = get_setting('delivery_boy_commission');
                $delivery_boy->total_earning += get_setting('delivery_boy_commission');
            }
            if ($order->payment_type == 'cash_on_delivery') {
                $delivery_history->collection = $order->grand_total;
                $delivery_boy->total_collection += $order->grand_total;

                $order->payment_status = 'paid';
                if ($order->commission_calculated == 0) {
                    commission_calculation($order);
                    $order->commission_calculated = 1;
                }

            }

            $delivery_boy->save();
        }
        $order->delivery_history_date = date("Y-m-d H:i:s");

        $order->save();
        $delivery_history->save();

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_delivery_status($order);
            } catch (\Exception $e) {
            }
        }

        return response()->json([
            'result' => true,
            'message' => 'Delivery status changed to '.ucwords(str_replace('_',' ',$request->status))
        ]);
    }

    public function cancel_request($id)
    {
        $order =  Order::find($id);

        $order->cancel_request = 1;
        $order->cancel_request_at = date('Y-m-d H:i:s');
        $order->save();

        return response()->json([
            'result' => true,
            'message' => 'Requested for cancellation'
        ]);
    }
}
