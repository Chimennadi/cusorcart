<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\SubSubCategory;
use App\Category;
use App\Cart;
use Auth;
use Session;
use App\Color;
use Cookie;

class CartController extends Controller
{
    public function index(Request $request)
    {
        //dd($cart->all());
        $categories = Category::all();
        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            if($request->session()->get('temp_user_id')) {
                Cart::where('temp_user_id', $request->session()->get('temp_user_id'))
                        ->update(
                                [
                                    'user_id' => $user_id,
                                    'temp_user_id' => null
                                ]
                );

                Session::forget('temp_user_id');
            }
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }


        return view('frontend.view_cart', compact('categories', 'carts'));
    }

    public function showCartModal(Request $request)
    { 
        if($request->ajax()) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $product = Product::find($request->id);
            return view('frontend.partials.addToCart', compact('product'));
        }
    }

    public function updateNavCart(Request $request)
    {
        return view('frontend.partials.cart');
    }

    public function addToCart(Request $request) {
        if($request->ajax()) {
            $product = Product::find($request->id);
            //echo $product;
            $carts = array();
            $data = array();

            
            if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $data['user_id'] = $user_id;
                $data['neck'] =$user_id;
                $data['sleeves'] = $request['sleeves_size'];
                $data['chest'] = $request['chest_size'];
                $data['waist'] = $request['waist_size'];
                $carts = Cart::where('user_id', $user_id)->get();
                } else {
                if($request->session()->get('temp_user_id')) {
                    $temp_user_id = $request->session()->get('temp_user_id');
                } else {
                    $temp_user_id = bin2hex(random_bytes(10));
                    $request->session()->put('temp_user_id', $temp_user_id);
                }
                $data['temp_user_id'] = $temp_user_id;
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            }

            $data['product_id'] = $product->id;
            $data['owner_id'] = $product->user_id;
            //echo $product;


            $str = '';
            $tax = 0;


            if($product->digital != 1 && $request->quantity < $product->min_qty) {
                return array('status' => 0, 'view' => view('frontend.partials.minQtyNotSatisfied', [
                    'min_qty' => $product->min_qty
                ])->render());
            }
            //echo $product;


            //check the color enabled or disabled for the product
            if($request->has('color')) {
                $str = $request['color'];
            }

            if ($product->digital != 1) {
                //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
                foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
                    if($str != null){
                        $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                    }
                    else{
                        $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                    }
                }
            }
            //echo $product;

            $data['variation'] = $str;

            if($str != null && $product->variant_product){
                $product_stock = $product->stocks->where('variant', $str)->first();
                $price = $product_stock->price;
                $quantity = $product_stock->qty;

                if($quantity < $request['quantity']){
                    return array('status' => 0, 'view' => view('frontend.partials.outOfStockCart')->render());
                }
            }
            else {
                $price = home_base_price1($product);
            }
            //echo $product;
            

            //discount calculation
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

            //calculation of taxes
            foreach ($product->taxes as $product_tax) {
                if($product_tax->tax_type == 'percent'){
                    $tax += ($price * $product_tax->tax) / 100;
                }
                elseif($product_tax->tax_type == 'amount'){
                    $tax += $product_tax->tax;
                }
            }
            //echo $product;
            
            
            $category_id = $product->category_id;
            //echo $category_id;
            
            $category_data = Category::find($category_id);
            //echo $category_data;
            
            if($category_data->tax != "") {
                $tax += ($price * $category_data->tax) / 100;
            }
            //echo $tax;
            
            
            

            $data['quantity'] = $request['quantity'];

            $data['price'] = $price;
            $data['tax'] = $tax;
            $data['shipping'] = 0;
            $data['shipping_cost'] = 0;
            $data['product_referral_code'] = null;
            $data['cash_on_delivery'] = $product->cash_on_delivery;
            $data['digital'] = $product->digital;

            if ($request['quantity'] == null){
                $data['quantity'] = 1;
            }

            if(Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
                $data['product_referral_code'] = Cookie::get('product_referral_code');
            }

            if($carts && count($carts) > 0){
                $foundInCart = false;

                foreach ($carts as $key => $cartItem){
                    if($cartItem['product_id'] == $request->id) {
                        //echo $cartItem;
                        $product_stock = $product->stocks->where('variant', $str)->first();
                        $quantity = $product_stock->qty;
                        $cartItem['neck'] = $request['neck_size'];
                        $cartItem['sleeves'] = $request['sleeves_size'];
                        $cartItem['chest'] = $request['chest_size'];
                        $cartItem['waist'] = $request['waist_size'];
                        $cartItem['gender'] = $request['gender'];
                        $cartItem['size'] = $request['size'];
                        $cartItem['size_type'] = $request['size_type'];
                        if($quantity < $cartItem['quantity'] + $request['quantity']){
                            return array('status' => 0, 'view' => view('frontend.partials.outOfStockCart')->render());
                        }
                        //echo $cartItem;
                        if(($str != null && $cartItem['variation'] == $str) || $str == null){
                            $foundInCart = true;
                            $cartItem['quantity'] += $request['quantity'];
                            //echo $cartItem;
                            $cartItem->save();
                        }
                    }
                }
                if (!$foundInCart) {
                    Cart::create($data);
                }
            }
            else {
                Cart::create($data);
            }

            return response()->json(array('status' => 1, 'view' => view('frontend.partials.addedToCart', compact('product', 'data'))->render()), 200);
        }
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        Cart::destroy($request->key);
        // dd($request->key);
        //  $data = Cart::where('temp_user_id', $request->session()->get('temp_user_id'))->get();
        // //  $data->delete();
        
        // dd($data);
        
        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }


        return view('frontend.partials.cart_details', compact('carts'));
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $object = Cart::findOrFail($request->id);

        if($object['id'] == $request->id){
            $product = \App\Product::find($object['product_id']);
            $product_stock = $product->stocks->where('variant', $object['variation'])->first();
            $quantity = $product_stock->qty;
            
            if($quantity >= $request->quantity) {
                if($request->quantity >= $product->min_qty){
                    $object['quantity'] = $request->quantity;
                }
            }

            $object->save();
        }

        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        return view('frontend.partials.cart_details', compact('carts'));
    }
}
