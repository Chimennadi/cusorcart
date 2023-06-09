<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id'      =>(int) $data->id,
                    'user_id' =>(int) $data->user_id,
                    'address' => $data->address,
                    'country' => $data->country,
                    'city' => $data->city,
                    'postal_code' => $data->postal_code,
                    'phone' => $data->phone,
                    'set_default' =>(int) $data->set_default
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
