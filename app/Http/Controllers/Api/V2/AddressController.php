<?php

namespace App\Http\Controllers\Api\V2;

use App\City;
use App\State;
use App\Country;
use App\Http\Resources\V2\AddressCollection;
use App\Address;
use App\Http\Resources\V2\CitiesCollection;
use App\Http\Resources\V2\CountriesCollection;
use App\Http\Resources\V2\StateCollection;
use Illuminate\Http\Request;
use App\Models\Cart;

class AddressController extends Controller
{
    public function addresses($id)
    {
        return new AddressCollection(Address::where('user_id', $id)->get());
    }

    public function createShippingAddress(Request $request)
    {
        $address = new Address;
        $address->user_id = $request->user_id;
        $address->address = $request->address;
        $address->country = $request->country;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->phone = $request->phone;
        $address->save();

        return response()->json([
            'result' => true,
            'message' => 'Shipping information has been added successfully'
        ]);
    }

    public function updateShippingAddress(Request $request)
    {
        $address = Address::find($request->id);
        $address->address = $request->address;
        $address->country = $request->country;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->phone = $request->phone;
        $address->save();

        return response()->json([
            'result' => true,
            'message' => 'Shipping information has been updated successfully'
        ]);
    }


    public function deleteShippingAddress($id)
    {
        $address = Address::find($id);
        $address->delete();
        return response()->json([
            'result' => true,
            'message' => 'Shipping information has been deleted'
        ]);
    }

    public function makeShippingAddressDefault(Request $request)
    {
        Address::where('user_id', $request->user_id)->update(['set_default' => 0]); //make all user addressed non default first

        $address = Address::find($request->id);
        $address->set_default = 1;
        $address->save();
        return response()->json([
            'result' => true,
            'message' => 'Default shipping information has been updated'
        ]);
    }

    public function updateAddressInCart(Request $request)
    {
        try {
            Cart::where('user_id', $request->user_id)->update(['address_id' => $request->address_id]);

        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Could not save the address'
            ]);
        }
        return response()->json([
            'result' => true,
            'message' => 'Address is saved'
        ]);


    }

    public function getCities()
    {
        return new CitiesCollection(City::all());
    }

    public function getStates()
    {
        return new StateCollection(State::all());
    }

    public function getCountries()
    {
        return new CountriesCollection(Country::where('status', 1)->get());
    }
}
