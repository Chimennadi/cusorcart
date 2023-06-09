<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Country;
use App\CityTranslation;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::orderby('id','desc')->paginate(15);
        $countries = Country::paginate(15);
        return view('backend.setup_configurations.states.index', compact('states', 'countries'));
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
        $state = new State();

        $state->name = $request->name;
        $state->cost = $request->cost;
        $state->country_id = $request->country_id;

        $state->save();

        flash(translate('State has been inserted successfully'))->success();

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
         $state  = State::findOrFail($id);
         $countries = Country::where('status', 1)->get();
         return view('backend.setup_configurations.states.edit', compact('State', 'lang', 'countries'));
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
        $state = State::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $state->name = $request->name;
        }

        $state->country_id = $request->country_id;
        $state->cost = $request->cost;

        $state->save();

        $state_translation = CityTranslation::firstOrNew(['lang' => $request->lang, 'State_id' => $state->id]);
        $state_translation->name = $request->name;
        $state_translation->save();

        flash(translate('State has been updated successfully'))->success();
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
        $state = State::findOrFail($id);

        foreach ($state->State_translations as $key => $state_translation) {
            $state_translation->delete();
        }

        State::destroy($id);

        flash(translate('State has been deleted successfully'))->success();
        return redirect()->route('states.index');
    }
    
    public function get_State(Request $request) {
        $country_info = Country::where('status',1)->where('name', $request->country_name)->first();
        
        $states = State::where('country_id', $country_info->id)->get();
        $html = '';
        
        foreach ($states as $row) {
//            $val = $row->id . ' | ' . $row->name;
            $html .= '<option value="' . $row->name . '">' . $row->getTranslation('name') . '</option>';
        }
        
        
        echo json_encode($html);
    }
}
