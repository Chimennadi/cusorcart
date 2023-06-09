<?php

namespace App\Http\Resources\V2;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'user_id' => intval($data->user_id),
                    'message' => $data->message,
                    'date' => Carbon::createFromFormat('Y-m-d H:i:s',$data->created_at)->format('F d,Y'),
                    'time' => Carbon::createFromFormat('Y-m-d H:i:s',$data->created_at)->format('h:i a'),
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
