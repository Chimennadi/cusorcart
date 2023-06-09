<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PickupPoint;
use App\PickupPointTranslation;

class PickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $pickup_points = PickupPoint::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $pickup_points = $pickup_points->where('name', 'like', '%'.$sort_search.'%');
        }
        $pickup_points = $pickup_points->paginate(10);
        return view('backend.setup_configurations.pickup_point.index', compact('pickup_points','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup_configurations.pickup_point.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pickup_point = new PickupPoint;
        $pickup_point->name = $request->name;
        $pickup_point->address = $request->address;
        $pickup_point->phone = $request->phone;
        $pickup_point->pick_up_status = $request->pick_up_status;
        $pickup_point->staff_id = $request->staff_id;
        if ($pickup_point->save()) {

            $pickup_point_translation = PickupPointTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'pickup_point_id' => $pickup_point->id]);
            $pickup_point_translation->name = $request->name;
            $pickup_point_translation->address = $request->address;
            $pickup_point_translation->save();

            flash(translate('PicupPoint has been inserted successfully'))->success();
            return redirect()->route('pick_up_points.index');

        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang           = $request->lang;
        $pickup_point   = PickupPoint::findOrFail($id);
        return view('backend.setup_configurations.pickup_point.edit', compact('pickup_point','lang'));
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
        $pickup_point = PickupPoint::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $pickup_point->name = $request->name;
            $pickup_point->address = $request->address;
        }

        $pickup_point->phone = $request->phone;
        $pickup_point->pick_up_status = $request->pick_up_status;
        $pickup_point->staff_id = $request->staff_id;
        if ($pickup_point->save()) {

            $pickup_point_translation = PickupPointTranslation::firstOrNew(['lang' => $request->lang,  'pickup_point_id' => $pickup_point->id]);
            $pickup_point_translation->name = $request->name;
            $pickup_point_translation->address = $request->address;
            $pickup_point_translation->save();

            flash(translate('PicupPoint has been updated successfully'))->success();
            return redirect()->route('pick_up_points.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pickup_point = PickupPoint::findOrFail($id);

        foreach ($pickup_point->pickup_point_translations as $key => $pickup_point_translation) {
            $pickup_point_translation->delete();
        }

        if(PickupPoint::destroy($id)){
            flash(translate('PicupPoint has been deleted successfully'))->success();
            return redirect()->route('pick_up_points.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
}
