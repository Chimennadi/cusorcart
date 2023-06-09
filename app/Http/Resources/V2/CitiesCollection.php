<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CitiesCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id'      =>(int) $data->id,
                    'country_id' => (int) $data->country_id,
                    'state_id' => (int) $data->state_id,
                    'name' => $data->name,
                    'cost' => $data->cost,
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
