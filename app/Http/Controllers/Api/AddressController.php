<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AddressCollection;
use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function addresses($id)
    {
        return new AddressCollection(Address::where('user_id', $id)->get());
    }

    public function createShippingAddress(Request $request)
    {
        $postArray=$request->all();
        if(strlen($postArray['address']) > 0){
        $address = Address::create($postArray);
        $address=Address::where('user_id','=',$request->user_id)->get();

        return response()->json([
            'data' => $address,
            'message' => 'Shipping information has been added successfully'
        ]);
        }
        return response()->json([
            'data' => null,
            'message' => 'Shipping information has been added successfully'
        ]);
    }
    public function updateShippingAddress(Request $request, $id)
    {
        Address::where('id', $id)->update($request->all());
        $address=Address::where('user_id','=',$request->user_id)->get();

        return response()->json([
            'data'=>$address,
            'message' => 'Shipping information has been added successfully',
            'success' => true
        ]);
    }

    public function deleteShippingAddress($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return response()->json([
            'message' => 'Shipping information has been added deleted'
        ]);
    }
}
