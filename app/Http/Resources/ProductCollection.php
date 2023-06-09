<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public $collection, $from_seller;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($collection, $from_seller = false)
    {
        $this->collection = $collection;
        $this->from_seller = $from_seller;
    }
    public function toArray($request)
    {

        if ($this->from_seller) {
            return [
                'data' => $this->collection->map(function ($data) {
                    return [
                        'id' => $data->id,
                        'name' => $data->name,
                        'slug' => $data->slug,
                        'photos' => explode(',', $data->photos),
                        'thumbnail_image' => api_asset($data->thumbnail_img),
                        'base_price' => (float) homeBasePrice($data),
                        'base_discounted_price' => (float) homeDiscountedBasePrice($data),
                        'todays_deal' => (int) $data->todays_deal,
                        'featured' => (int) $data->featured,
                        'unit' => $data->unit,
                        'discount' => (float) $data->discount,
                        'discount_type' => $data->discount_type,
                        'rating' => (float) $data->rating,
                        'sales' => (int) $data->num_of_sale,
                        'low_stock_quantity' => $data->low_stock_quantity,
                        'quantity' => (int) getProductQuantity($data),
                        'stock_variants' => getProductQuantity($data, 'stock_variants'),
                        'approval_status' => $data->approval_status,
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
