<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{
    public $collection, $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($collection, $message)
    {
        $this->collection = $collection;
        $this->message = $message;
    }

    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'product' => [
                        'name' => $data->product->name,
                        'image' => api_asset($data->product->thumbnail_img)
                    ],
                    'variation' => $data->variation,
                    'price' => (double) $data->price,
                    'tax' => (double) $data->tax,
                    'shipping_cost' => (double) $data->shipping_cost,
                    'quantity' => (integer) $data->quantity,
                    'date' => $data->created_at->diffForHumans()
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'message' => $this->message,
            'success' => true,
            'status' => 200
        ];
    }
}
