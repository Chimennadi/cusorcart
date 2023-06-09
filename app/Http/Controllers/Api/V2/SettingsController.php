<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\SettingsCollection;
use App\Models\AppSettings;

class SettingsController extends Controller
{
    public function index()
    {
        return new SettingsCollection(AppSettings::all());
    }
}
