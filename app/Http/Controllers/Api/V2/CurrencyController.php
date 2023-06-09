<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\CurrencyCollection;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        return new CurrencyCollection(Currency::all());
    }
}
