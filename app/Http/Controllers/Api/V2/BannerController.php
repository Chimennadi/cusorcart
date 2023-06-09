<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\BannerCollection;

class BannerController extends Controller
{

    public function index()
    {
        return new BannerCollection(json_decode(get_setting('home_banner1_images'), true));
    }
}
