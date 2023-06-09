<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\Models\User;
use App\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function info($id)
    {
        return new UserCollection(User::where('id', $id)->get());
    }

    public function updateName(Request $request)
    {
        $postArray = $request->all();
        $user = User::where('id', $request->id)->first();

        if ($request->new_password != null && ($request->new_password == $request->confirm_password)) {
            $user->password = Hash::make($request->new_password);
        } else {
            $user->name = $request->name;
            $user->address = $request->address;
            $user->country = $request->country;
            $user->city = $request->city;
            $user->postal_code = $request->postal_code;
            $user->phone = $request->phone;

            $user->avatar_original = isset($request->avatar_original) ? $request->avatar_original : $user->avatar_original;
        }
        $user->save();
        // if ($user) {
        //     User::where('id', '=', $request->id)->update($postArray);
        // }
        return response()->json([
            'message' => 'Profile information has been updated successfully'
        ]);
    }

    public function updateSeller(Request $request, $id)
    {
        try {
            $user = AppUser::where('id', $id)->first();

            $seller = $user->seller;
            $seller->cash_on_delivery_status = $request->cash_on_delivery_status == null ? 0 : $request->cash_on_delivery_status;
            $seller->bank_payment_status = isset($request->bank_payment_status) && $request->bank_payment_status != null ? $request->bank_payment_status : 0;
            $seller->bank_name = $request->bank_name;
            $seller->bank_acc_name = $request->bank_acc_name;
            $seller->bank_acc_no = $request->bank_acc_no;
            $seller->bank_routing_no = $request->bank_routing_no;

            if ($seller->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile information has been updated successfully'
                ]);
            }
        } catch (\Throwable $th) {
            abort(403, $th);
        }
    }
}
