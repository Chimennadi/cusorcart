<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GeneralSettingCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'logo' => $data->logo,
                    'site_name' => $data->site_name,
                    'address' => $data->address,
                    'description' => $data->description,
                    'phone' => $data->phone,
                    'email' => $data->email,
                    'facebook' => $data->facebook,
                    'twitter' => $data->twitter,
                    'instagram' => $data->instagram,
                    'youtube' => $data->youtube,
                    'google_plus' => $data->google_plus
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
