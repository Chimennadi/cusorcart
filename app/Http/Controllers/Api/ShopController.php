<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ProductController;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductDetailCollection;
use App\Http\Resources\ShopCollection;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Shop;
use App\User;
use App\OrderDetail;
use App\SellerWithdrawRequest;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return new ShopCollection(Shop::all());
    }

    public function info($id)
    {
        return new ShopCollection(Shop::where('id', $id)->get());
    }

    public function shopOfUser($id)
    {
        return new ShopCollection(Shop::where('user_id', $id)->get());
    }

    public function userSummary($id)
    {
        return response()->json([
            'admin_to_pay' => User::where('id', $id)->first()->seller->admin_to_pay,
            'products' => Product::where('user_id', $id)->count(),
            'total_sales' => OrderDetail::where('seller_id', $id)->where('delivery_status', 'delivered')->count(),
            'total_earnings' => (float) OrderDetail::where('seller_id', $id)->where('payment_status', '=', 'paid')->sum('price'),
            'successful_orders' => OrderDetail::where('seller_id', $id)->where('delivery_status', 'delivered')->count(),
            'total_orders' => OrderDetail::where('seller_id', $id)->count(),
            'pending_orders' => OrderDetail::where('seller_id', $id)->where('delivery_status', 'pending')->count(),
            'cancelled_orders' => OrderDetail::where('seller_id', $id)->where('delivery_status', 'cancelled')->count(),
            'withdrawals' => (float)  SellerWithdrawRequest::where('user_id', $id)->where('status', 1)->sum('amount'),
            'seller' => Seller::where('user_id', $id)->first()
        ]);
    }

    public function update(Request $request)
    {
        $shop = Shop::find($request->id);

        if ($request->has('name') && $request->has('address')) {
            $shop->name = $request->name;
            if ($request->has('shipping_cost')) {
                $shop->shipping_cost = $request->shipping_cost;
            }
            $shop->address = $request->address;
            $shop->phone = $request->phone;
            $shop->country = $request->country;
            $shop->state = $request->state;
            $shop->city = $request->city;

            $shop->slug = preg_replace('/\s+/', '-', $request->name) . '-' . $shop->id;

            $shop->meta_title = $request->meta_title;
            $shop->meta_description = $request->meta_description;
            $shop->logo = $request->logo;

            if ($request->has('pick_up_point_id')) {
                $shop->pick_up_point_id = json_encode($request->pick_up_point_id);
            } else {
                $shop->pick_up_point_id = json_encode(array());
            }
        } elseif ($request->has('facebook') || $request->has('google') || $request->has('twitter') || $request->has('youtube') || $request->has('instagram')) {
            $shop->facebook = $request->facebook;
            $shop->google = $request->google;
            $shop->twitter = $request->twitter;
            $shop->youtube = $request->youtube;
        } else {
            $shop->sliders = implode(', ', $request->sliders);
        }

        if ($shop->save()) {
            return new ShopCollection(Shop::where('id', $request->id)->get());
        }

        return response()->json([
            'data' => null,
            'message' => 'Error occurred while saving',
        ]);
    }
    public function allProducts($id)
    {
        $shop = Shop::findOrFail($id);
        // dd($shop);
        return new ProductCollection(Product::where('user_id', $shop->user_id)->latest()->get(), true);
    }
    public function productDetails($id)
    {
        $product = Product::where('id', $id)->get();
        // dd($product);
        return new ProductDetailCollection($product, true);
    }
    public function updateProductPublished(Request $request)
    {
        $data = (new ProductController)->updatePublished($request);
        return response()->json([
            'data' => $data,
            'message' => 'Product updated successfully',
        ]);
    }
    public function updateProduct(Request $request)
    {
        $data = (new ProductController)->update($request, $request->id, true);
        return $data;
    }

    public function topSellingProducts($id)
    {
        $shop = Shop::findOrFail($id);
        return new ProductCollection(Product::where('user_id', $shop->user_id)->orderBy('num_of_sale', 'desc')->limit(4)->get());
    }

    public function featuredProducts($id)
    {
        $shop = Shop::findOrFail($id);
        return new ProductCollection(Product::where(['user_id' => $shop->user_id, 'featured'  => 1])->latest()->get());
    }

    public function newProducts($id)
    {
        $shop = Shop::findOrFail($id);
        return new ProductCollection(Product::where('user_id', $shop->user_id)->orderBy('created_at', 'desc')->limit(10)->get());
    }

    public function brands($id)
    {
    }
}
