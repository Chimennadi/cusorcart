<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShopCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return array_merge($data->toArray(), (array) [
                    'name' => $data->name,
                    'user' => [
                        'name' => $data->user->name,
                        'email' => $data->user->email,
                        'avatar' => $data->user->avatar,
                        'avatar_original' => $data->user->avatar_original
                    ],
                    // 'logo' => api_asset($data->logo),
                    // 'sliders' => $this->convertPhotos(explode(',', $data->sliders)),
                    'logo' => $data->logo,
                    'sliders' => explode(',', $data->sliders),
                    'address' => $data->address,
                    'facebook' => $data->facebook,
                    'google' => $data->google,
                    'twitter' => $data->twitter,
                    'youtube' => $data->youtube,
                    'instagram' => $data->instagram,
                    'links' => [
                        'featured' => route('shops.featuredProducts', $data->id),
                        'top' => route('shops.topSellingProducts',  $data->id),
                        'new' => route('shops.newProducts', $data->id),
                        'all' => route('shops.allProducts', $data->id),
                        'brands' => route('shops.brands', $data->id)
                    ]
                ]);
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

    protected function convertPhotos($data)
    {
        $result = array();
        foreach ($data as $key => $item) {
            array_push($result, api_asset($item));
        }
        return $result;
    }
}
