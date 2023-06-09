<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Review;
use App\Models\Attribute;

class ProductDetailCollection extends ResourceCollection
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
                    return array_merge($data->toArray(), (array) [
                        'data_collection' => [
                            'id' => (int) $data->id,
                            'name' => $data->name,
                            'added_by' => $data->added_by,
                            'photos' => $this->convertPhotos(explode(',', $data->photos)),
                            'thumbnail_image' => api_asset($data->thumbnail_img),
                            'tags' => explode(',', $data->tags),
                            'price_lower' => (float) explode('-', homeDiscountedPrice($data))[0],
                            'price_higher' => (float) explode('-', homeDiscountedPrice($data))[1],
                            'choice_options' => $this->convertToChoiceOptions(json_decode($data->choice_options)),
                            'colors' => json_decode($data->colors),
                            'todays_deal' => (int) $data->todays_deal,
                            'featured' => (int) $data->featured,
                            'current_stock' => (int) $data->current_stock,
                            'unit' => $data->unit,
                            'discount' => (float) $data->discount,
                            'discount_type' => $data->discount_type,
                            'tax' => (float) $data->tax,
                            'tax_type' => $data->tax_type,
                            'shipping_type' => $data->shipping_type,
                            'shipping_cost' => (float) $data->shipping_cost,
                            'number_of_sales' => (int) $data->num_of_sale,
                            'rating' => (float) $data->rating,
                            'rating_count' => (int) Review::where(['product_id' => $data->id])->count(),
                            'description' => $data->description,
                            'links' => [
                                'reviews' => route('api.reviews.index', $data->id),
                                'related' => route('products.related', $data->id)
                            ]
                        ]
                    ]);
                })
            ];
        }
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => (int) $data->id,
                    'name' => $data->name,
                    'added_by' => $data->added_by,
                    'user' => [
                        'name' => $data->user->name,
                        'email' => $data->user->email,
                        'avatar' => $data->user->avatar,
                        'avatar_original' => api_asset($data->user->avatar_original),
                        'shop_name' => $data->added_by == 'admin' ? '' : $data->user->shop->name,
                        'shop_logo' => $data->added_by == 'admin' ? '' : uploaded_asset($data->user->shop->logo),
                        'shop_link' => $data->added_by == 'admin' ? '' : route('shops.info', $data->user->shop->id)
                    ],
                    'category' => [
                        'name' => $data->category->name,
                        'banner' => api_asset($data->category->banner),
                        'icon' => $data->category->icon,
                        'links' => [
                            'products' => route('api.products.category', $data->category_id),
                            'sub_categories' => route('subCategories.index', $data->category_id)
                        ]
                    ],
                    'brand' => [
                        'name' => $data->brand != null ? $data->brand->name : null,
                        'logo' => $data->brand != null ? api_asset($data->brand->logo) : null,
                        'links' => [
                            'products' => $data->brand != null ? route('api.products.brand', $data->brand_id) : null
                        ]
                    ],
                    'photos' => $this->convertPhotos(explode(',', $data->photos)),
                    'thumbnail_image' => api_asset($data->thumbnail_img),
                    'tags' => explode(',', $data->tags),
                    'price_lower' => (float) explode('-', homeDiscountedPrice($data))[0],
                    'price_higher' => (float) explode('-', homeDiscountedPrice($data))[1],
                    'choice_options' => $this->convertToChoiceOptions(json_decode($data->choice_options)),
                    'colors' => json_decode($data->colors),
                    'todays_deal' => (int) $data->todays_deal,
                    'featured' => (int) $data->featured,
                    'current_stock' => (int) $data->current_stock,
                    'unit' => $data->unit,
                    'discount' => (float) $data->discount,
                    'discount_type' => $data->discount_type,
                    'tax' => (float) $data->tax,
                    'tax_type' => $data->tax_type,
                    'shipping_type' => $data->shipping_type,
                    'shipping_cost' => (float) $data->shipping_cost,
                    'number_of_sales' => (int) $data->num_of_sale,
                    'rating' => (float) $data->rating,
                    'rating_count' => (int) Review::where(['product_id' => $data->id])->count(),
                    'description' => $data->description,
                    'links' => [
                        'reviews' => route('api.reviews.index', $data->id),
                        'related' => route('products.related', $data->id)
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

    protected function convertToChoiceOptions($data)
    {
        $result = array();
        foreach ($data as $key => $choice) {
            $item['name'] = $choice->attribute_id;
            $item['title'] = Attribute::find($choice->attribute_id)->name;
            $item['options'] = $choice->values;
            array_push($result, $item);
        }
        return $result;
    }

    protected function convertPhotos($data)
    {
        $result = array();
        foreach ($data as $key => $item) {
            array_push($result, api_asset($item));
        }
        return $result;
    }
}
