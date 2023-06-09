<?php

namespace App\Http\Resources\V2;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PurchaseHistoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'code' => $data->code,
                    'user_id' => (int) $data->user_id,
                    'shipping_address' => json_decode($data->shipping_address),
                    'payment_type' => ucwords(str_replace('_', ' ', $data->payment_type)),
                    'shipping_type' => $data->shipping_type,
                    'shipping_type_string' => $data->shipping_type != null ? ucwords(str_replace('_', ' ', $data->shipping_type)) : "",
                    'payment_status' => $data->payment_status,
                    'payment_status_string' => ucwords(str_replace('_', ' ', $data->payment_status)),
                    'delivery_status' => $data->delivery_status,
                    'delivery_status_string' => $data->delivery_status == 'pending'? "Order Placed" : ucwords(str_replace('_', ' ',  $data->delivery_status)),
                    'grand_total' => format_price($data->grand_total),
                    'coupon_discount' => format_price($data->coupon_discount),
                    'shipping_cost' => format_price($data->orderDetails->sum('shipping_cost')),
                    'subtotal' => format_price($data->orderDetails->sum('price')),
                    'tax' => format_price($data->orderDetails->sum('tax')),
                    'date' => Carbon::createFromTimestamp($data->date)->format('d-m-Y'),
                    'cancel_request' => $data->cancel_request == 1,
                    'links' => [
                        'details' => route('purchaseHistory.details', $data->id)
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
