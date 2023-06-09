<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id'      => $data->id,
                    'user_id' => $data->user_id,
                    'address' => $data->address,
                    'country' => $data->country,
                    'city' => $data->city,
                    'state' => $data->state,
                    'postal_code' => $data->postal_code,
                    'phone' => $data->phone,
                    'set_default' => $data->set_default
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
