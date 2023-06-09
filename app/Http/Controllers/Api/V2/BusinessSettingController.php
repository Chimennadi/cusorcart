<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\BusinessSettingCollection;
use App\Models\BusinessSetting;

class BusinessSettingController extends Controller
{
    public function index()
    {
        return new BusinessSettingCollection(BusinessSetting::all());
    }
}
