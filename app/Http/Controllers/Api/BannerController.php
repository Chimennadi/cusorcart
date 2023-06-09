<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BannerCollection;

class BannerController extends Controller
{

    public function index()
    {
        return new BannerCollection(json_decode(get_setting('home_banner1_images'), true));
    }
}
