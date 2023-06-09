<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'user_id'=> $data->user->id,
                    'user_name'=> $data->user->name,
                    'avatar'=> api_asset($data->user->avatar_original),
                    'rating' => floatval(number_format($data->rating,1,'.','')),
                    'comment' => $data->comment,
                    'time' => $data->updated_at->diffForHumans()
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
