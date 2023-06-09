<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\PurchaseHistoryDetailCollection;
use App\Models\OrderDetail;

class PurchaseHistoryDetailController extends Controller
{
    public function index($id)
    {
        return new PurchaseHistoryDetailCollection(OrderDetail::where('order_id', $id)->get());
    }
}
