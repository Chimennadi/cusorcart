<?php

namespace App\Http\Controllers\Api;

use App\PickupPoint;
use Illuminate\Http\Request;

class PickupPointController extends Controller
{
    public function index()
    {
        return response()->json([
            'data'=>PickupPoint::get(),
            'message' => ''], 200);
    }

}
