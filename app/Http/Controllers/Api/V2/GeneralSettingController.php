<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\GeneralSettingCollection;
use App\Models\GeneralSetting;

class GeneralSettingController extends Controller
{
    public function index()
    {
        return new GeneralSettingCollection(GeneralSetting::all());
    }
}
