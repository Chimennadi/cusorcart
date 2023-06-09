<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ReviewCollection;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index($id)
    {
        return new ReviewCollection(Review::where('product_id', $id)->latest()->get());
    }
}
