<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PurchaseHistoryDetailCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'product' => $data->product->name,
                    'variation' => $data->variation,
                    'price' => $data->price,
                    'tax' => $data->tax,
                    'shipping_cost' => $data->shipping_cost,
                    'coupon_discount' => $data->coupon_discount,
                    'quantity' => (int) $data->quantity,
                    'payment_status' => $data->payment_status,
                    'delivery_status' => $data->delivery_status
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
