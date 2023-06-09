<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\Models\User;
use App\SellerWithdrawRequest;
use App\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerWithdrawRequestController extends Controller
{
    public function info($id)
    {
        return SellerWithdrawRequest::where('user_id', $id)->latest()->paginate(12);
    }

    public function store(Request $request)
    {
        $seller_withdraw_request = new SellerWithdrawRequest;
        $seller_withdraw_request->user_id = $request->seller_id;
        $seller_withdraw_request->amount = $request->amount;
        $seller_withdraw_request->message = $request->message;
        $seller_withdraw_request->status = '0';
        $seller_withdraw_request->viewed = '0';
        if ($seller_withdraw_request->save()) {
            return response()->json([
                'success' => true,
                'error' => false,
                'message' => 'Request has been sent successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'success' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
