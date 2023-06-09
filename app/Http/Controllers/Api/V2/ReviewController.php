<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\ReviewCollection;
use App\Models\Review;
use App\Product;
use Illuminate\Http\Request;
use App\User;

class ReviewController extends Controller
{
    public function index($id)
    {
        return new ReviewCollection(Review::where('product_id', $id)->where('status', 1)->orderBy('updated_at', 'desc')->paginate(10));
    }

    public function submit(Request $request)
    {
        $product = Product::find($request->product_id);
        $user = User::find($request->user_id);

        /*
         @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                            @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                @php
                                                    $commentable = true;
                                                @endphp
                                            @endif
                                        @endforeach
        */

        $reviewable = false;

        foreach ($product->orderDetails as $key => $orderDetail) {
            if($orderDetail->order != null && $orderDetail->order->user_id == $request->user_id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', $request->user_id)->where('product_id', $product->id)->first() == null){
                $reviewable = true;
            }
        }

        if(!$reviewable){
            return response()->json([
                'result' => false,
                'message' => 'You cannot review this product'
            ]);
        }

        $review = new \App\Review;
        $review->product_id = $request->product_id;
        $review->user_id = $request->user_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->viewed = 0;
        if($review->save()){
            $count = Review::where('product_id', $product->id)->where('status', 1)->count();
            if($count > 0){
                $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/$count;
            }
            else {
                $product->rating = 0;
            }
            $product->save();
        }

        return response()->json([
            'result' => true,
            'message' => 'Review  Submitted'
        ]);
    }
}
