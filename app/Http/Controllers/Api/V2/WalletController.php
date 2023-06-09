<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\WalletCollection;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function balance($id)
    {
        $user = User::find($id);
        $latest = Wallet::where('user_id', $id)->latest()->first();
        return response()->json([
            'balance' => format_price($user->balance),
            'last_recharged' => $latest == null ? "Not Available" : Carbon::createFromTimestamp(strtotime($latest->created_at))->diffForHumans(),
        ]);
    }

    public function walletRechargeHistory($id)
    {
        return new WalletCollection(Wallet::where('user_id', $id)->latest()->paginate(10));
    }

    public function processPayment(Request $request)
    {
        $order = new OrderController;
        $user = User::find($request->user_id);

        if ($user->balance >= $request->amount) {
            $user->balance -= $request->amount;
            $user->save();
            return $order->store($request,true);
        } else {
            return response()->json([
                'result' => false,
                'order_id' => 0,
                'message' => 'Insufficient wallet balance'
            ]);
        }
    }
}
