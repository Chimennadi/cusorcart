<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\State;
use App\CityTranslation;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderBy('name')->paginate(15);
        $countries = Country::paginate(15);
        $states = State::orderby('id','desc')->paginate(15);
        return view('backend.setup_configurations.cities.index', compact('cities', 'countries','states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City;

        $city->name = $request->name;
        $city->cost = $request->cost;
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id;
        
        $city->save();

        flash(translate('City has been inserted successfully'))->success();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request, $id)
     {
         $lang  = $request->lang;
         $city  = City::findOrFail($id);
         $countries = Country::where('status', 1)->get();
          $states = State::all();
         return view('backend.setup_configurations.cities.edit', compact('city', 'lang', 'countries','states'));
     }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $city->name = $request->name;
        }

        $city->country_id = $request->country_id;
         $city->state_id = $request->state_id;
        $city->cost = $request->cost;

        $city->save();

        $city_translation = CityTranslation::firstOrNew(['lang' => $request->lang, 'city_id' => $city->id]);
        $city_translation->name = $request->name;
        $city_translation->save();

        flash(translate('City has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);

        foreach ($city->city_translations as $key => $city_translation) {
            $city_translation->delete();
        }

        City::destroy($id);

        flash(translate('City has been deleted successfully'))->success();
        return redirect()->route('cities.index');
    }
    
    public function get_city(Request $request) {
        $country_info = State::where('name', $request->state)->first();
        
        $cities = City::where('state_id', $country_info->id)->limit(5)->get();
        $html = '';
        
        foreach ($cities as $row) {
//            $val = $row->id . ' | ' . $row->name;
            $html .= '<option value="' . $row->name . '">' . $row->getTranslation('name') . '</option>';
        }
        
        
        echo json_encode($html);
    }
    
    
       public function get_state(Request $request) {
        $country_info = Country::where('status',1)->where('name', $request->country_name)->first();
        
        $states = State::where('country_id', $country_info->id)->get();
        $html = '';
        
        foreach ($states as $row) {
//            $val = $row->id . ' | ' . $row->name;
            $html .= '<option value="' . $row->name . '">' . $row->name . '</option>';
        }
        
        
        echo json_encode($html);
    }
}
