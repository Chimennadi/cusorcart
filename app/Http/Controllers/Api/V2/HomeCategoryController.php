<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\HomeCategoryCollection;
use App\Models\HomeCategory;

class HomeCategoryController extends Controller
{
    public function index()
    {
        return new HomeCategoryCollection(HomeCategory::all());
    }
}
