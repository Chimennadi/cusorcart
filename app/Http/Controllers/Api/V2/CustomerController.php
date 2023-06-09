<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function show($id)
    {
        return new CustomerResource(Customer::find($id));
    }
}
