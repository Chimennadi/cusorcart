<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function cashOnDelivery(Request $request)
    {
        $order = new OrderController;
        return $order->store($request);
    }
}
