<?php

namespace App;

use App\Address;
use App\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class CheckOut
{
    public function delivery_info($user_id)
    {
        $carts = Cart::where('user_id', $user_id)->get();
        $cartArray = $carts->toArray();
        if (count($cartArray) == 0) {
            return response()->json([], 200);
        }
        $datas = Address::where('id', $cartArray[0]['address_id'])->first();
        $admin_products = array();
        $seller_products = array();
        $ship_id = [];
        $shipping_tax = [];
        $owner_id = [];
        $cart_group = [];
        $service = 0;

        foreach ($carts  as $key => $cartItem) {
            if (\App\Product::find($cartItem['product_id'])->added_by == 'admin') {
                array_push($admin_products, $cartItem['product_id']);
            } else {
                $product_ids = array();
                if (array_key_exists(\App\Product::find($cartItem['product_id'])->user_id, $seller_products)) {
                    $product_ids = $seller_products[\App\Product::find($cartItem['product_id'])->user_id];
                }
                array_push($product_ids, $cartItem['product_id']);
                $seller_products[\App\Product::find($cartItem['product_id'])->user_id] = $product_ids;
            }
        }

        if (!empty($admin_products)) {
            $kgs = 0;
            $ship_title = '';
            $arrivalDay = '';
            $ship_user_name = '';
            $prodDetails = [];
            foreach ($admin_products as $key => $cartItem1) {
                $product1 = Product::find($cartItem1);
                $kgs +=  $product1->kg;
            }
            foreach ($admin_products as $key => $cartItem) {
                $product = Product::find($cartItem);
            }
            if (BusinessSetting::where('type', 'pickup_point')->first()->value == 1 && $product->digital != 1) {
                $shippingTypeOptions = array(
                    "home_delivery", "pickup_point"
                );
                $pickup_points = PickupPoint::where('staff_id', User::where('user_type', 'admin')->first()->id)->get();
                $shippingDetails = array(
                    'shipping_type_options' => $shippingTypeOptions,
                    'pickup_points' => $pickup_points
                );
            }
            if ($product->digital == 1) {
                $ship_id[] += 0;
                $shipping_tax[] += 0;
            } else {
                foreach (ShippingDetail::where('ship_city', $datas->city)->where('ship_state', $datas->state)->where('ship_country', $datas->country)->where('city', 'Baltimore')->where('state', 'Maryland')->where('country', 'United States')->where('status', 'Approved')->where('transit_day', '<=', 1)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship) {
                    $title = 'Same day shipping';
                    $shipdata = logistic_price($ship);
                    $shipkg = $shipdata * $kgs;
                    $ship_detail_id = $shipkg;
                    $service += $ship_detail_id;
                    $ship_id[] += $ship->id;
                    $shipping_tax[] += $ship->shipping_tax;
                    $ship_user_name = $ship->user->name;
                    $arrivalDay = Carbon::now()->addDays($ship->transit_day)->format('l, M d, Y');
                }
                foreach (ShippingDetail::where('ship_city', $datas->city)->where('ship_state', $datas->state)->where('ship_country', $datas->country)->where('city', 'Baltimore')->where('state', 'Maryland')->where('country', 'United States')->where('status', 'Approved')->where('transit_day', '>', 1)->where('transit_day', '<=', 7)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship1) {
                    $title = 'Express shipping';
                    $shipdata1 = logistic_price($ship1);
                    $shipkg1 = $shipdata1 * $kgs;
                    $ship_detail_id = $shipkg1;
                    $service += $ship_detail_id;
                    $ship_id[] += $ship1->id;
                    $shipping_tax[] += $ship1->shipping_tax;
                    $ship_user_name = $ship1->user->name;
                    $arrivalDay = Carbon::now()->addDays($ship1->transit_day)->format('l, M d, Y');
                }
                foreach (ShippingDetail::where('ship_city', $datas->city)->where('ship_state', $datas->state)->where('ship_country', $datas->country)->where('city', 'Baltimore')->where('state', 'Maryland')->where('country', 'United States')->where('status', 'Approved')->where('transit_day', '>', 7)->where('transit_day', '<=', 14)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship2) {
                    $title = 'Business day shipping';
                    $shipdata2 = logistic_price($ship2);
                    $shipkg2 = $shipdata2 * $kgs;
                    $ship_detail_id = $shipkg2;
                    $service += $ship_detail_id;
                    $ship_id[] += $ship2->id;
                    $shipping_tax[] += $ship2->shipping_tax;
                    $ship_user_name = $ship2->user->name;
                    $arrivalDay = Carbon::now()->addDays($ship2->transit_day)->format('l, M d, Y');
                }
                foreach (ShippingDetail::where('ship_city', $datas->city)->where('ship_state', $datas->state)->where('ship_country', $datas->country)->where('city', 'Baltimore')->where('state', 'Maryland')->where('country', 'United States')->where('status', 'Approved')->where('transit_day', '>', 14)->where('transit_day', '<=', 30)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship3) {
                    $title = 'Cargo express shipping';
                    $shipdata3 = logistic_price($ship3);
                    $shipkg3 = $shipdata3 * $kgs;
                    $ship_detail_id = $shipkg3;
                    $service += $ship_detail_id;
                    $ship_id[] += $ship3->id;
                    $shipping_tax[] += $ship3->shipping_tax;
                    $ship_user_name = $ship3->user->name;
                    $arrivalDay = Carbon::now()->addDays($ship3->transit_day)->format('l, M d, Y');
                }
            }
            foreach ($admin_products as $prodId) {
                $cart = Cart::where('user_id', $user_id)->where('product_id', $prodId)->first();
                $cartArr = $cart->toArray();
                $prodDetails[] = $cartArr;
            }
            $cart_group[] = [
                'kgs' => $kgs,
                'type' => 'admin',
                'ship_title' => $title,
                'ship_detail_id' => $ship_detail_id,
                'arrival_date' => $arrivalDay,
                'ship_user_name' => $ship_user_name,
                'shop_name' => 'Cusorcart',
                'shop_id' => User::where('user_type', 'admin')->first()->id,
                'cart_items' => $prodDetails
            ];
            $owner_id[] = User::where('user_type', 'admin')->first()->id;
        }
        if (!empty($seller_products)) {
            foreach ($seller_products as $key => $seller_product) {
                $shop = Shop::where('user_id', $key)->first();
                $shop_name = $shop->name;
                $kgs = 0;
                $seller_product_details = array();
                foreach ($seller_product as $cartItem1) {
                    $product1 = Product::find($cartItem1);
                    $kgs += $product1->kg;
                }
                foreach ($seller_product as $cartItem) {
                    $product = Product::find($cartItem);
                }
                if (BusinessSetting::where('type', 'pickup_point')->first()->value == 1 && $product->digital != 1) {
                    $shippingTypeOptions = array(
                        "home_delivery", "pickup_point"
                    );
                    $pickup_points = PickupPoint::where('staff_id', User::where('user_type', 'admin')->first()->id)->get();
                    $shippingDetails = array(
                        'shipping_type_options' => $shippingTypeOptions,
                        'pickup_points' => $pickup_points
                    );
                }
                if ($product->digital == 1) {
                    $ship_id[] += 0;
                    $shipping_tax[] += 0;
                } else {
                    foreach (ShippingDetail::where('ship_city', $datas->city)->where('ship_state', $datas->state)->where('ship_country', $datas->country)->where('city', 'Baltimore')->where('state', 'Maryland')->where('country', 'United States')->where('status', 'Approved')->where('transit_day', '<=', 1)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship) {
                        $title = 'Same day shipping';
                        $shipdata = logistic_price($ship);
                        $shipkg = $shipdata * $kgs;
                        $ship_detail_id = $shipkg;
                        $service += $ship_detail_id;
                        $ship_id[] += $ship->id;
                        $shipping_tax[] += $ship->shipping_tax;
                        $ship_user_name = $ship->user->name;
                        $arrivalDay = Carbon::now()->addDays($ship->transit_day)->format('l, M d, Y');
                    }
                    foreach (ShippingDetail::where('ship_city', $datas->city)->where('ship_state', $datas->state)->where('ship_country', $datas->country)->where('city', 'Baltimore')->where('state', 'Maryland')->where('country', 'United States')->where('status', 'Approved')->where('transit_day', '>', 1)->where('transit_day', '<=', 7)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship1) {
                        $title = 'Express shipping';
                        $shipdata1 = logistic_price($ship1);
                        $shipkg1 = $shipdata1 * $kgs;
                        $ship_detail_id = $shipkg1;
                        $service += $ship_detail_id;
                        $ship_id[] += $ship1->id;
                        $shipping_tax[] += $ship1->shipping_tax;
                        $ship_user_name = $ship1->user->name;
                        $arrivalDay = Carbon::now()->addDays($ship1->transit_day)->format('l, M d, Y');
                    }
                    foreach (ShippingDetail::where('ship_city', $datas->city)->where('ship_state', $datas->state)->where('ship_country', $datas->country)->where('city', 'Baltimore')->where('state', 'Maryland')->where('country', 'United States')->where('status', 'Approved')->where('transit_day', '>', 7)->where('transit_day', '<=', 14)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship2) {
                        $title = 'Business day shipping';
                        $shipdata2 = logistic_price($ship2);
                        $shipkg2 = $shipdata2 * $kgs;
                        $ship_detail_id = $shipkg2;
                        $service += $ship_detail_id;
                        $ship_id[] += $ship2->id;
                        $shipping_tax[] += $ship2->shipping_tax;
                        $ship_user_name = $ship2->user->name;
                        $arrivalDay = Carbon::now()->addDays($ship2->transit_day)->format('l, M d, Y');
                    }
                    foreach (ShippingDetail::where('ship_city', $datas->city)->where('ship_state', $datas->state)->where('ship_country', $datas->country)->where('city', 'Baltimore')->where('state', 'Maryland')->where('country', 'United States')->where('status', 'Approved')->where('transit_day', '>', 14)->where('transit_day', '<=', 30)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship3) {
                        $title = 'Cargo express shipping';
                        $shipdata3 = logistic_price($ship3);
                        $shipkg3 = $shipdata3 * $kgs;
                        $ship_detail_id = $shipkg3;
                        $service += $ship_detail_id;
                        $ship_id[] += $ship3->id;
                        $shipping_tax[] += $ship3->shipping_tax;
                        $ship_user_name = $ship3->user->name;
                        $arrivalDay = Carbon::now()->addDays($ship3->transit_day)->format('l, M d, Y');
                    }
                }

                foreach ($seller_product as $prodId) {
                    $cart = Cart::where('user_id', $user_id)->where('product_id', $prodId)->first();
                    $cartArr = $cart->toArray();
                    $seller_product_details[] = $cartArr;
                }
                $cart_group[] = [
                    'kgs' => $kgs,
                    'type' => 'seller',
                    'ship_title' => $title,
                    'ship_detail_id' => $ship_detail_id,
                    'arrival_date' => $arrivalDay,
                    'ship_user_name' => $ship_user_name,
                    'shop_name' => $shop_name,
                    'shop_id' => $shop->id,
                    'cart_items' => $seller_product_details
                ];

                $owner_id[] = User::where('user_type', 'admin')->first()->id;
            }
        }
        // dd($cart_group);
        return response()->json(
            [
                'owner_id' => $owner_id,
                'ship_detail_id' => $ship_detail_id,
                'ship_id' => $ship_id,
                'shipping_tax' => $shipping_tax,
                'service' => $service,
                'cart_groups' => $cart_group
            ],
            200
        );
    }
}
