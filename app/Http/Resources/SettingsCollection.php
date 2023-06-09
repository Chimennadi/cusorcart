<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\BusinessSetting;
use App\Currency;

class SettingsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'name' => $data->name,
                    'logo' => $data->logo,
                    'facebook' => $data->facebook,
                    'twitter' => $data->twitter,
                    'instagram' => $data->instagram,
                    'youtube' => $data->youtube,
                    'google_plus' => $data->google_plus,
                    'currency' => [
                        'name' => Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->name,
                        'symbol' => Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->symbol,
                        'exchange_rate' => (double) $this->exchangeRate(Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)),
                        'code' => Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->code
                    ],
                    'currency_format' => $data->currency_format
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

    public function exchangeRate($currency){
        $base_currency = Currency::find(BusinessSetting::where('type', 'system_default_currency')->first()->value);
        return $currency->exchange_rate/$base_currency->exchange_rate;
    }
}
