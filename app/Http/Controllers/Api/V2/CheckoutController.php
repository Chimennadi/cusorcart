<?php


namespace App\Http\Controllers\Api\V2;


use App\Coupon;
use App\CouponUsage;
use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController
{
    public function apply_coupon_code(Request $request)
    {
        $cart_items = Cart::where('user_id', $request->user_id)->where('owner_id',$request->owner_id)->get();
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if ($cart_items->isEmpty()) {
            return response()->json([
                'result' => false,
                'message' => 'Cart is empty'
            ]);
        }

        if ($coupon == null) {
            return response()->json([
                'result' => false,
                'message' => 'Invalid coupon code!'
            ]);
        }

        $in_range = strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date;

        if (!$in_range) {
            return response()->json([
                'result' => false,
                'message' => 'Coupon expired!'
            ]);
        }

        $is_used = CouponUsage::where('user_id', $request->user_id)->where('coupon_id', $coupon->id)->first() != null;

        if ($is_used) {
            return response()->json([
                'result' => false,
                'message' => 'You already used this coupon!'
            ]);
        }


        $coupon_details = json_decode($coupon->details);

        if ($coupon->type == 'cart_base') {
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            foreach ($cart_items as $key => $cartItem) {
                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];
                $shipping += $cartItem['shipping'] * $cartItem['quantity'];
            }
            $sum = $subtotal + $tax + $shipping;

            if ($sum >= $coupon_details->min_buy) {
                if ($coupon->discount_type == 'percent') {
                    $coupon_discount = ($sum * $coupon->discount) / 100;
                    if ($coupon_discount > $coupon_details->max_discount) {
                        $coupon_discount = $coupon_details->max_discount;
                    }
                } elseif ($coupon->discount_type == 'amount') {
                    $coupon_discount = $coupon->discount;
                }

                Cart::where('user_id', $request->user_id)->where('owner_id',$request->owner_id)->update([
                    'discount' => $coupon_discount / count($cart_items),
                    'coupon_code' => $request->coupon_code,
                    'coupon_applied' => 1
                ]);

                return response()->json([
                    'result' => true,
                    'message' => 'Coupon Applied'
                ]);


            }
        } elseif ($coupon->type == 'product_base') {
            $coupon_discount = 0;
            foreach ($cart_items as $key => $cartItem) {
                foreach ($coupon_details as $key => $coupon_detail) {
                    if ($coupon_detail->product_id == $cartItem['product_id']) {
                        if ($coupon->discount_type == 'percent') {
                            $coupon_discount += $cartItem['price'] * $coupon->discount / 100;
                        } elseif ($coupon->discount_type == 'amount') {
                            $coupon_discount += $coupon->discount;
                        }
                    }
                }
            }


            Cart::where('user_id', $request->user_id)->where('owner_id',$request->owner_id)->update([
                'discount' => $coupon_discount / count($cart_items),
                'coupon_code' => $request->coupon_code,
                'coupon_applied' => 1
            ]);

            return response()->json([
                'result' => true,
                'message' => 'Coupon Applied'
            ]);

        }


    }

    public function remove_coupon_code(Request $request)
    {
        Cart::where('user_id', $request->user_id)->where('owner_id',$request->owner_id)->update([
            'discount' => 0.00,
            'coupon_code' => "",
            'coupon_applied' => 0
        ]);

        return response()->json([
            'result' => true,
            'message' => 'Coupon Removed'
        ]);
    }
}
