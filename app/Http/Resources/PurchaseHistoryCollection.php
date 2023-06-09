<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PurchaseHistoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'code' => $data->code,
                    'user' => [
                        'name' => $data->user->name,
                        'email' => $data->user->email,
                        'avatar' => $data->user->avatar,
                        'avatar_original' => api_asset($data->user->avatar_original)
                    ],
                    'shipping_address' => json_decode($data->shipping_address),
                    'payment_type' => str_replace('_', ' ', $data->payment_type),
                    'payment_status' => $data->payment_status,
                    'grand_total' => (double) $data->grand_total,
                    'coupon_discount' => (double) $data->coupon_discount,
                    'shipping_cost' => (double) $data->orderDetails->sum('shipping_cost'),
                    'subtotal' => (double) $data->orderDetails->sum('price'),
                    'tax' => (double) $data->orderDetails->sum('tax'),
                    'date' => Carbon::createFromTimestamp($data->date)->format('d-m-Y'),
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
