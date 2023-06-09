<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\AddressCollection;
use App\Models\Cart;
use App\City;
use App\Product;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function shipping_cost(Request $request)
    {
        $admin_products = array();
        $seller_products = array();
        $calculate_shipping = 0;

        $shop_items_raw_data = Cart::where('user_id', $request->user_id)->where('owner_id', $request->owner_id)->get();
        foreach ($shop_items_raw_data as $key => $shop_items_raw_data_item) {
            $product = \App\Product::find($shop_items_raw_data_item->product_id);
            if ($product->added_by == 'admin') {
                array_push($admin_products, $shop_items_raw_data_item->product_id);
            } else {
                $product_ids = array();
                if (array_key_exists($product->user_id, $seller_products)) {
                    $product_ids = $seller_products[$product->user_id];
                }
                array_push($product_ids, $shop_items_raw_data_item->product_id);
                $seller_products[$product->user_id] = $product_ids;
            }

            if (get_setting('shipping_type') == 'flat_rate') {
                $calculate_shipping = \App\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value;
            } elseif (get_setting('shipping_type') == 'seller_wise_shipping') {
                if (!empty($admin_products)) {
                    $calculate_shipping = \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value;
                }
                if (!empty($seller_products)) {
                    foreach ($seller_products as $key => $seller_product) {
                        $calculate_shipping += \App\Shop::where('user_id', $key)->first()->shipping_cost;
                    }
                }
            } elseif (get_setting('shipping_type') == 'area_wise_shipping') {
                $city = City::where('name', $request->city_name)->first();
                if ($city != null) {
                    $calculate_shipping = $city->cost;
                }
            } elseif (get_setting('shipping_type') == 'product_wise_shipping') {
                $product_shipping_cost = $product->shipping_cost;
                if(isset($product_shipping_cost) && is_array(json_decode($product_shipping_cost, true))) {
                    foreach(json_decode($product_shipping_cost, true) as $shipping_region => $val) {
                        if($request->city_name == $shipping_region) {
                            $product_shipping_cost =  (double)($val);
                            break;
                            //$calculate_shipping += (double)($val) * $shop_items_raw_data_item->quantity;
                        } else {
                            $product_shipping_cost = 0;
                        }
                    }
                } else {
                    if ($product_shipping_cost == null || !$product_shipping_cost) {
                        $product_shipping_cost = 0;
                    }
                }
                if($product->is_quantity_multiplied) {
                    $product_shipping_cost =  $product_shipping_cost * $shop_items_raw_data_item->quantity;
                }



                $calculate_shipping += $product_shipping_cost;

                $cart = Cart::find($shop_items_raw_data_item->id);
                $cart->shipping_cost = $product_shipping_cost;
                $cart->save();
            }

        }

        $shop_items_raw_data = Cart::where('user_id', $request->user_id)->where('owner_id', $request->owner_id)->get();
        foreach ($shop_items_raw_data as $key => $shop_items_raw_data_item) {
            $value = 0;
            if (get_setting('shipping_type') == 'flat_rate') {
                $value =  $calculate_shipping / count($shop_items_raw_data);

            } elseif (get_setting('shipping_type') == 'seller_wise_shipping') {
                if ($product->added_by == 'admin') {
                    $value =  \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value / count($admin_products);
                } else {
                    $value =  \App\Shop::where('user_id', $product->user_id)->first()->shipping_cost / count($seller_products[$product->user_id]);
                }
            } elseif (get_setting('shipping_type') == 'area_wise_shipping') {
                if ($product->added_by == 'admin') {
                    $value = $calculate_shipping / count($admin_products);
                } else {
                    $value = $calculate_shipping / count($seller_products[$product->user_id]);
                }
            }

            if (get_setting('shipping_type') != 'product_wise_shipping') {
                $cart = Cart::find($shop_items_raw_data_item->id);
                $cart->shipping_cost = $value;
                $cart->save();
            }
        }

        //Total shipping cost $calculate_shipping

        $total_shipping_cost = Cart::where('user_id', $request->user_id)->where('owner_id', $request->owner_id)->sum('shipping_cost');

        return response()->json(['result' => true, 'shipping_type' => get_setting('shipping_type'), 'value' => convert_price($total_shipping_cost) ,'value_string'=>format_price($total_shipping_cost)], 200);
    }


}
