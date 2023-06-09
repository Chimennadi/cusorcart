<?php

namespace App\Http\Resources\V2;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryHistoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'delivery_boy_id' => $data->delivery_boy_id,
                    'order_id' => $data->order_id,
                    'order_code' => $data->order->code,
                    'delivery_status' => $data->delivery_status,
                    'earning' => format_price($data->earning) ,
                    'collection' => format_price($data->collection),
                    'payment_type' => $data->payment_type,
                    'date' => Carbon::createFromTimestamp($data->created_at)->format('d-m-Y'),
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
