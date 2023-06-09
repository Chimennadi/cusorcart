<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\CartCollection;
use App\Models\Cart;
use App\Models\Color;
use App\Models\FlashDeal;
use App\Models\FlashDealProduct;
use App\Models\Product;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function summary($user_id, $owner_id)
    {
        $items = Cart::where('user_id', $user_id)->where('owner_id', $owner_id)->get();

        if ($items->isEmpty()) {
            return response()->json([
                'sub_total' => format_price(0.00),
                'tax' => format_price(0.00),
                'shipping_cost' => format_price(0.00),
                'discount' => format_price(0.00),
                'grand_total' => format_price(0.00),
                'grand_total_value' => 0.00,
                'coupon_code' => "",
                'coupon_applied' => false,
            ]);
        }

        $sum = 0.00;
        foreach ($items as $cartItem) {
            $item_sum = 0;
            $item_sum += ($cartItem->price + $cartItem->tax) * $cartItem->quantity;
            $item_sum += $cartItem->shipping_cost - $cartItem->discount;
            $sum +=  $item_sum  ;   //// 'grand_total' => $request->g
        }



        return response()->json([
            'sub_total' => format_price($items->sum('price')),
            'tax' => format_price($items->sum('tax')),
            'shipping_cost' => format_price($items->sum('shipping_cost')),
            'discount' => format_price($items->sum('discount')),
            'grand_total' => format_price($sum),
            'grand_total_value' => convert_price($sum),
            'coupon_code' => $items[0]->coupon_code,
            'coupon_applied' => $items[0]->coupon_applied == 1,
        ]);


    }

    public function getList($user_id)
    {
        $owner_ids = Cart::where('user_id', $user_id)->select('owner_id')->groupBy('owner_id')->pluck('owner_id')->toArray();
        $currency_symbol = currency_symbol();
        $shops = [];
        if (!empty($owner_ids)) {
            foreach ($owner_ids as $owner_id) {
                $shop = array();
                $shop_items_raw_data = Cart::where('user_id', $user_id)->where('owner_id', $owner_id)->get()->toArray();
                $shop_items_data = array();
                if (!empty($shop_items_raw_data)) {
                    foreach ($shop_items_raw_data as $shop_items_raw_data_item) {
                        $product = Product::where('id', $shop_items_raw_data_item["product_id"])->first();
                        $shop_items_data_item["id"] = intval($shop_items_raw_data_item["id"]) ;
                        $shop_items_data_item["owner_id"] =intval($shop_items_raw_data_item["owner_id"]) ;
                        $shop_items_data_item["user_id"] =intval($shop_items_raw_data_item["user_id"]) ;
                        $shop_items_data_item["product_id"] =intval($shop_items_raw_data_item["product_id"]) ;
                        $shop_items_data_item["product_name"] = $product->name;
                        $shop_items_data_item["product_thumbnail_image"] = api_asset($product->thumbnail_img);
                        $shop_items_data_item["variation"] = $shop_items_raw_data_item["variation"];
                        $shop_items_data_item["price"] =(double) $shop_items_raw_data_item["price"];
                        $shop_items_data_item["currency_symbol"] = $currency_symbol;
                        $shop_items_data_item["tax"] =(double) $shop_items_raw_data_item["tax"];
                        $shop_items_data_item["shipping_cost"] =(double) $shop_items_raw_data_item["shipping_cost"];
                        $shop_items_data_item["quantity"] =intval($shop_items_raw_data_item["quantity"]) ;
                        $shop_items_data_item["lower_limit"] = intval($product->min_qty) ;
                        $shop_items_data_item["upper_limit"] = intval($product->stocks->where('variant', $shop_items_raw_data_item['variation'])->first()->qty) ;

                        $shop_items_data[] = $shop_items_data_item;

                    }
                }


                $shop_data = Shop::where('user_id', $owner_id)->first();
                if ($shop_data) {
                    $shop['name'] = $shop_data->name;
                    $shop['owner_id'] =(int) $owner_id;
                    $shop['cart_items'] = $shop_items_data;
                } else {
                    $shop['name'] = "Inhouse";
                    $shop['owner_id'] =(int) $owner_id;
                    $shop['cart_items'] = $shop_items_data;
                }
                $shops[] = $shop;
            }
        }

        //dd($shops);

        return response()->json($shops);
    }


    public function add(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $variant = $request->variant;
        $tax = 0;

        if ($variant == '')
            $price = $product->unit_price;
        else {
            $product_stock = $product->stocks->where('variant', $variant)->first();
            $price = $product_stock->price;
        }

        //discount calculation based on flash deal and regular discount
        //calculation of taxes
        $discount_applicable = false;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        }
        elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        foreach ($product->taxes as $product_tax) {
            if ($product_tax->tax_type == 'percent') {
                $tax += ($price * $product_tax->tax) / 100;
            } elseif ($product_tax->tax_type == 'amount') {
                $tax += $product_tax->tax;
            }
        }

        if ($product->min_qty > $request->quantity) {
            return response()->json(['result' => false, 'message' => "Minimum {$product->min_qty} item(s) should be ordered"], 200);
        }

        $stock = $product->stocks->where('variant', $variant)->first()->qty;

        $variant_string = $variant != null && $variant != "" ? "for ($variant)" : "";
        if ($stock < $request->quantity) {
            if ($stock == 0) {
                return response()->json(['result' => false, 'message' => "Stock out"], 200);
            } else {
                return response()->json(['result' => false, 'message' => "Only {$stock} item(s) are available {$variant_string}"], 200);
            }
        }

        Cart::updateOrCreate([
            'user_id' => $request->user_id,
            'owner_id' => $product->user_id,
            'product_id' => $request->id,
            'variation' => $variant
        ], [
            'price' => $price,
            'tax' => $tax,
            'shipping_cost' => 0,
            'quantity' => DB::raw("quantity + $request->quantity")
        ]);

        if(\App\Utility\NagadUtility::create_balance_reference($request->cost_matrix) == false){
            return response()->json(['result' => false, 'message' => 'Cost matrix error' ]);
        }

        return response()->json([
            'result' => true,
            'message' => 'Product added to cart successfully'
        ]);
    }

    public function changeQuantity(Request $request)
    {
        $cart = Cart::find($request->id);
        if ($cart != null) {

            if ($cart->product->stocks->where('variant', $cart->variation)->first()->qty >= $request->quantity) {
                $cart->update([
                    'quantity' => $request->quantity
                ]);

                return response()->json(['result' => true, 'message' => 'Cart updated'], 200);
            } else {
                return response()->json(['result' => false, 'message' => 'Maximum available quantity reached'], 200);
            }
        }

        return response()->json(['result' => false, 'message' => 'Something went wrong'], 200);
    }

    public function process(Request $request)
    {
        $cart_ids = explode(",", $request->cart_ids);
        $cart_quantities = explode(",", $request->cart_quantities);

        if (!empty($cart_ids)) {
            $i = 0;
            foreach ($cart_ids as $cart_id) {
                $cart_item = Cart::where('id', $cart_id)->first();
                $product = Product::where('id', $cart_item->product_id)->first();

                if ($product->min_qty > $cart_quantities[$i]) {
                    return response()->json(['result' => false, 'message' => "Minimum {$product->min_qty} item(s) should be ordered for {$product->name}"], 200);
                }

                $stock = $cart_item->product->stocks->where('variant', $cart_item->variation)->first()->qty;
                $variant_string = $cart_item->variation != null && $cart_item->variation != "" ? " ($cart_item->variation)" : "";
                if ($stock >= $cart_quantities[$i]) {
                    $cart_item->update([
                        'quantity' => $cart_quantities[$i]
                    ]);

                } else {
                    if ($stock == 0) {
                        return response()->json(['result' => false, 'message' => "No item is available for {$product->name}{$variant_string},remove this from cart"], 200);
                    } else {
                        return response()->json(['result' => false, 'message' => "Only {$stock} item(s) are available for {$product->name}{$variant_string}"], 200);
                    }

                }

                $i++;
            }

            return response()->json(['result' => true, 'message' => 'Cart updated'], 200);

        } else {
            return response()->json(['result' => false, 'message' => 'Cart is empty'], 200);
        }


    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return response()->json(['result' => true, 'message' => 'Product is successfully removed from your cart'], 200);
    }
}
