<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Color;
use App\Models\FlashDeal;
use App\Models\FlashDealProduct;
use App\Models\Product;

use App\Http\Controllers\CheckoutController;
use App\Models\Category;
use App\CheckOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index($id)
    {
        if (request()->temp_user_id) {
            Cart::where('temp_user_id', '=', request()->temp_user_id)->update(['user_id' => $id]);
        }
        return new CartCollection(Cart::where('user_id', $id)->latest()->get(), 'cart fetched');
    }
    public function getList($id, $message = 'Hello')
    {
        return new CartCollection(Cart::where('user_id', '=', $id)->orWhere('temp_user_id', '=', $id)->latest()->get(), $message);
    }
    public function getUserCheckOutDetails(Request $request, $id)
    {

        $getStoreDeliveryDetails = (new CheckoutController())->store_delivery_info_for_api(($request), $id);
        return $getStoreDeliveryDetails;
    }
    public function getDeliveryInfo($id)
    {
        $carts = Cart::where('user_id', $id)->latest()->get();
        return ((new CheckOut())->delivery_info($id));
    }
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $variant = $request->variant;
        $color = $request->color;
        $tax = 0;

        if ($variant == '' && $color == '')
            $price = $product->unit_price;
        else {
            $product_stock = $product->stocks->where('variant', $variant)->first();
            $price = $product_stock->price;
        }

        //discount calculation
        $discount_applicable = false;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        } elseif (
            strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date
        ) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if ($product->discount_type == 'percent') {
                $price -= ($price * $product->discount) / 100;
            } elseif ($product->discount_type == 'amount') {
                $price -= $product->discount;
            }
        }

        //calculation of taxes
        if ($product->tax_type == 'percent') {
            $tax = ($price * $product->tax) / 100;
        } elseif ($product->tax_type == 'amount') {
            $tax = $product->tax;
        }
        $category_id = $product->category_id;

        $category_data = Category::find($category_id);


        if ($category_data->tax != "") {
            $tax += ($price * $category_data->tax) / 100;
        }

        if (!empty($request->user_id) && !empty($request->temp_user_id)) {
            Cart::where('temp_user_id', '=', $request->temp_user_id)->update(['user_id' => $request->user_id]);
        }

        Cart::updateOrCreate([
            'user_id' => $request->user_id,
            'temp_user_id' => isset($request->temp_user_id) ? $request->temp_user_id : null,
            'product_id' => $request->id,
            'owner_id' => $product->user_id,
            'variation' => $variant
        ], [
            'price' => $price,
            'tax' => $tax,
            'shipping_cost' => 0,
            'quantity' => DB::raw("quantity + $request->quantity")
        ]);

        return  $this->getList($request->temp_user_id, 'Product added to cart successfully');
    }
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $variant = $request->variant;
        $color = $request->color;
        $tax = 0;

        if ($variant == '' && $color == '')
            $price = $product->unit_price;
        else {
            $product_stock = $product->stocks->where('variant', $variant)->first();
            $price = $product_stock->price;
        }

        //discount calculation
        $discount_applicable = false;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        } elseif (
            strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date
        ) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if ($product->discount_type == 'percent') {
                $price -= ($price * $product->discount) / 100;
            } elseif ($product->discount_type == 'amount') {
                $price -= $product->discount;
            }
        }

        //calculation of taxes
        if ($product->tax_type == 'percent') {
            $tax = ($price * $product->tax) / 100;
        } elseif ($product->tax_type == 'amount') {
            $tax = $product->tax;
        }
        $category_id = $product->category_id;

        $category_data = Category::find($category_id);
        // dd($category_data);

        if ($category_data->tax != "") {
            $tax += ($price * $category_data->tax) / 100;
        }


        Cart::updateOrCreate([
            'user_id' => $request->user_id,
            'product_id' => $request->id,
            'owner_id' => $product->user_id,
            'variation' => $variant
        ], [
            'price' => $price,
            'tax' => $tax,
            'shipping_cost' => 0,
            'quantity' => DB::raw('quantity + 1')
        ]);

        return  $this->getList($request->user_id, 'Product added to cart successfully');
    }

    public function changeQuantity(Request $request)
    {
        $cart = Cart::find($request->id);
        if ($cart != null) {
            if ($cart->product->stocks->where('variant', $cart->variation)->first()->qty >= $request->quantity) {
                $cart->update([
                    'quantity' => $request->quantity
                ]);
                $user_id = $cart->user_id != null ? $cart->user_id : $cart->temp_user_id;
                return  $this->getList($user_id, 'Cart updated');
            } else {
                return response()->json(['message' => 'Maximum available quantity reached'], 200);
            }
        }

        return response()->json(['message' => 'Something went wrong'], 200);
    }
    public function update(Request $request)
    {
        $cart = Cart::where('user_id', '=', $request->user_id)->update($request->all());
        $user_id = $request->user_id;
        return  $this->getList($user_id, 'Order details Update');
    }
    public function remove(Request $request)
    {
        $cart = Cart::find($request->id);
        $user_id = $cart->user_id != null ? $cart->user_id : $cart->temp_user_id;
        Cart::destroy($request->id);
        return  $this->getList($user_id, 'Product is successfully removed from your cart');
    }
    public function destroy($id)
    {
        Cart::destroy($id);
        return response()->json(['message' => 'Product is successfully removed from your cart'], 200);
    }
}
