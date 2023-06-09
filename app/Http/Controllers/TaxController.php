<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tax;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_taxes = Tax::orderBy('created_at', 'desc')->get();
        return view('backend.setup_configurations.tax.index', compact('all_taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tax = new Tax;
        $tax->name = $request->name;
//        $pickup_point->address = $request->address;
        
        if ($tax->save()) {

            flash(translate('Tax has been inserted successfully'))->success();
            return redirect()->route('tax.index');

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
    public function edit($id)
    {
        $tax = Tax::findOrFail($id);
        return view('backend.setup_configurations.tax.edit', compact('tax'));
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
        $tax = Tax::findOrFail($id);
        $tax->name = $request->name;
//        $language->code = $request->code;
        if($tax->save()){
            flash(translate('Tax has been updated successfully'))->success();
            return redirect()->route('tax.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
    
    public function change_tax_status(Request $request) {
        $tax = Tax::findOrFail($request->id);
        if($tax->tax_status == 1) {
            $tax->tax_status = 0;
        } else {
            $tax->tax_status = 1;
        }
        
        if($tax->save()) {
            return 1;
        } 
        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $tax = Tax::findOrFail($id);
        
        if(Tax::destroy($id)){
            flash(translate('Tax has been deleted successfully'))->success();
            return redirect()->route('tax.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
}
