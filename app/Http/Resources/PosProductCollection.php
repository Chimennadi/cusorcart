<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PosProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'stock_id' => $data->stock_id,
                    'name' => $data->name,
                    'thumbnail_image' => ($data->stock_image == null)  ? uploaded_asset($data->thumbnail_img) : uploaded_asset($data->stock_image),
                    'price' => home_discounted_base_price_by_id($data->id),
                    'base_price' => home_base_price_by_id($data->id),
                    'qty' => $data->stock_qty,
                    'variant' => $data->variant,
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
