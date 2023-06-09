<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\WishlistCollection;
use App\Models\Wishlist;
use App\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function index($id)
    {
        $product_ids = Wishlist::where('user_id', $id)->pluck("product_id")->toArray();
        $existing_product_ids = Product::whereIn('id', $product_ids)->pluck("id")->toArray();

        $query = Wishlist::query();
        $query->where('user_id', $id)->whereIn("product_id", $existing_product_ids);

        return new WishlistCollection($query->latest()->get());
    }

    public function store(Request $request)
    {
        Wishlist::updateOrCreate(
            ['user_id' => $request->user_id, 'product_id' => $request->product_id]
        );
        return response()->json(['message' => 'Product is successfully added to your wishlist'], 201);
    }

    public function destroy($id)
    {
        try {
            Wishlist::destroy($id);
            return response()->json(['result' => true, 'message' => 'Product is successfully removed from your wishlist'], 200);
        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }

    }

    public function add(Request $request)
    {
        $product = Wishlist::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->count();
        if ($product > 0) {
            return response()->json([
                'message' => 'Product present in wishlist',
                'is_in_wishlist' => true,
                'product_id' => (integer)$request->product_id,
                'wishlist_id' => (integer)Wishlist::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->first()->id
            ], 200);
        } else {
            Wishlist::create(
                ['user_id' => $request->user_id, 'product_id' => $request->product_id]
            );

            return response()->json([
                'message' => 'Product added to wishlist',
                'is_in_wishlist' => true,
                'product_id' => (integer)$request->product_id,
                'wishlist_id' => (integer)Wishlist::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->first()->id
            ], 200);
        }

    }

    public function remove(Request $request)
    {
        $product = Wishlist::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->count();
        if ($product == 0) {
            return response()->json([
                'message' => 'Product in not in wishlist',
                'is_in_wishlist' => false,
                'product_id' => (integer)$request->product_id,
                'wishlist_id' => 0
            ], 200);
        } else {
            Wishlist::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->delete();

            return response()->json([
                'message' => 'Product is removed from wishlist',
                'is_in_wishlist' => false,
                'product_id' => (integer)$request->product_id,
                'wishlist_id' => 0
            ], 200);
        }
    }

    public function isProductInWishlist(Request $request)
    {
        $product = Wishlist::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->count();
        if ($product > 0)
            return response()->json([
                'message' => 'Product present in wishlist',
                'is_in_wishlist' => true,
                'product_id' => (integer)$request->product_id,
                'wishlist_id' => (integer)Wishlist::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->first()->id
            ], 200);

        return response()->json([
            'message' => 'Product is not present in wishlist',
            'is_in_wishlist' => false,
            'product_id' => (integer)$request->product_id,
            'wishlist_id' => 0
        ], 200);
    }
}
