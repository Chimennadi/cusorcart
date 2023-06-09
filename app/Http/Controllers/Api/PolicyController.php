<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PolicyCollection;
use App\Page;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function sellerPolicy()
    {
        return new PolicyCollection(Page::where('type', 'seller_policy_page')->get());
    }

    public function supportPolicy()
    {
        return new PolicyCollection(Page::where('type', 'support_policy_page')->get());
    }

    public function returnPolicy()
    {
        return new PolicyCollection(Page::where('type', 'return_policy_page')->get());
    }
}
