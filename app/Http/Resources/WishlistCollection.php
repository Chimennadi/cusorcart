<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WishlistCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => (integer) $data->id,
                    'product' => [
                        'id' => $data->product->id,
                        'name' => $data->product->name,
                        'photos' => explode(',', $data->product->photos),
                        'thumbnail_image' => api_asset($data->product->thumbnail_img),
                        'base_price' => (double) homeBasePrice($data->product),
                        'base_discounted_price' => (double) homeDiscountedBasePrice($data->product),
                        'todays_deal' => (integer) $data->product->todays_deal,
                        'featured' =>(integer) $data->product->featured,
                        'unit' => $data->product->unit,
                        'discount' => (double) $data->product->discount,
                        'discount_type' => $data->product->discount_type,
                        'rating' => (double) $data->product->rating,
                        'sales' => (integer) $data->product->num_of_sale,
                        'links' => [
                            'details' => route('products.show', $data->product->id),
                            'reviews' => route('api.reviews.index', $data->product->id),
                            'related' => route('products.related', $data->product->id),
                            'top_from_seller' => route('products.topFromSeller', $data->product->id)
                        ]
                    ]
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
