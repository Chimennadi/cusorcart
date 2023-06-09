<?php

namespace App\Http\Controllers\Api\V2;

use App\Address;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\BusinessSetting;
use App\User;
use DB;

class OrderController extends Controller
{
    public function store(Request $request, $set_paid = false)
    {
        $cartItems = Cart::where('user_id', $request->user_id)->where('owner_id', $request->owner_id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'order_id' => 0,
                'result' => false,
                'message' => 'Cart is Empty'
            ]);
        }

        $user = User::find($request->user_id);

        $address = Address::where('id', $cartItems->first()->address_id)->first();
        $shippingAddress = [];
        if ($address != null) {
            $shippingAddress['name'] = $user->name;
            $shippingAddress['email'] = $user->email;
            $shippingAddress['address'] = $address->address;
            $shippingAddress['country'] = $address->country;
            $shippingAddress['city'] = $address->city;
            $shippingAddress['postal_code'] = $address->postal_code;
            $shippingAddress['phone'] = $address->phone;
        }

        $sum = 0.00;
        foreach ($cartItems as $cartItem) {
            $item_sum = 0;
            $item_sum += ($cartItem->price + $cartItem->tax) * $cartItem->quantity;
            $item_sum += $cartItem->shipping_cost - $cartItem->discount;
            $sum += $item_sum;   //// 'grand_total' => $request->g
        }


        // create an order
        $order = Order::create([
            'user_id' => $request->user_id,
            'seller_id' =>$request->owner_id,
            'shipping_address' => json_encode($shippingAddress),
            'payment_type' => $request->payment_type,
            'payment_status' => $set_paid ? 'paid' : 'unpaid',
            'grand_total' => $sum,
            'coupon_discount' => $cartItems->sum('discount'),
            'code' => date('Ymd-his'),
            'date' => strtotime('now')
        ]);

        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);

            $product_stocks = $product->stocks->where('variant', $cartItem->variation)->first();
            $product_stocks->qty -= $cartItem->quantity;
            $product_stocks->save();

            /*if ($cartItem->variation) {
                $product_stocks = $product->stocks->where('variant', $cartItem->variation)->first();
                $product_stocks->qty -= $cartItem->quantity;
                $product_stocks->save();
            } else {
                $product->update([
                    'current_stock' => DB::raw('current_stock - ' . $cartItem->quantity)
                ]);
            }*/

            // save order details
            OrderDetail::create([
                'order_id' => $order->id,
                'seller_id' => $product->user_id,
                'product_id' => $product->id,
                'variation' => $cartItem->variation,
                'price' => $cartItem->price * $cartItem->quantity,
                'tax' => $cartItem->tax * $cartItem->quantity,
                'shipping_cost' => $cartItem->shipping_cost,
                'quantity' => $cartItem->quantity,
                'payment_status' => $set_paid ? 'paid' : 'unpaid'
            ]);
            $product->update([
                'num_of_sale' => DB::raw('num_of_sale + ' . $cartItem->quantity)
            ]);
        }
        // apply coupon usage

        if ($cartItems->first()->coupon_code != '') {
            CouponUsage::create([
                'user_id' => $request->user_id,
                'coupon_id' => Coupon::where('code', $cartItems->first()->coupon_code)->first()->id
            ]);
        }

        Cart::where('user_id', $request->user_id)->where('owner_id', $request->owner_id)->delete();

        return response()->json([
            'order_id' => $order->id,
            'result' => true,
            'message' => translate('Your order has been placed successfully')
        ]);
    }

}
