<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\ColorCollection;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        return new ColorCollection(Color::all());
    }
}
