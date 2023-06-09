<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'photos' => explode(',', $data->photos),
                    'thumbnail_image' => api_asset($data->thumbnail_img),
                    'base_price' => (float) homeBasePrice($data),
                    'base_discounted_price' => (float) homeDiscountedBasePrice($data),
                    'todays_deal' => (int) $data->todays_deal,
                    'featured' => (int) $data->featured,
                    'unit' => $data->unit,
                    'published' => (int) $data->published == 1,
                    'discount' => (float) $data->discount,
                    'discount_type' => $data->discount_type,
                    'rating' => (float) $data->rating,
                    'sales' => (int) $data->num_of_sale,
                    'links' => [
                        'details' => route('products.show', $data->id),
                        'reviews' => route('api.reviews.index', $data->id),
                        'related' => route('products.related', $data->id),
                        'top_from_seller' => route('products.topFromSeller', $data->id)
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
