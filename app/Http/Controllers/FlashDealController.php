<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FlashDeal;
use App\FlashDealTranslation;
use App\FlashDealProduct;
use App\Product;
use Illuminate\Support\Str;

class FlashDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $flash_deals = FlashDeal::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $flash_deals = $flash_deals->where('title', 'like', '%'.$sort_search.'%');
        }
        $flash_deals = $flash_deals->paginate(15);
        return view('backend.marketing.flash_deals.index', compact('flash_deals', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.marketing.flash_deals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flash_deal = new FlashDeal;
        $flash_deal->title = $request->title;
        $flash_deal->text_color = $request->text_color;

        $date_var               = explode(" to ", $request->date_range);
        $flash_deal->start_date = strtotime($date_var[0]);
        $flash_deal->end_date   = strtotime( $date_var[1]);

        $flash_deal->background_color = $request->background_color;
        $flash_deal->slug = strtolower(str_replace(' ', '-', $request->title).'-'.Str::random(5));
        $flash_deal->banner = $request->banner;
        if($flash_deal->save()){
            foreach ($request->products as $key => $product) {
                $flash_deal_product = new FlashDealProduct;
                $flash_deal_product->flash_deal_id = $flash_deal->id;
                $flash_deal_product->product_id = $product;
                $flash_deal_product->save();

                $root_product = Product::findOrFail($product);
                $root_product->discount = $request['discount_'.$product];
                $root_product->discount_type = $request['discount_type_'.$product];
                $root_product->discount_start_date = strtotime($date_var[0]);
                $root_product->discount_end_date   = strtotime( $date_var[1]);
                $root_product->save();
            }

            $flash_deal_translation = FlashDealTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'flash_deal_id' => $flash_deal->id]);
            $flash_deal_translation->title = $request->title;
            $flash_deal_translation->save();

            flash(translate('Flash Deal has been inserted successfully'))->success();
            return redirect()->route('flash_deals.index');
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
        $flash_deal = FlashDeal::findOrFail($id);
        return view('backend.marketing.flash_deals.edit', compact('flash_deal','lang'));
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
        $flash_deal = FlashDeal::findOrFail($id);

        $flash_deal->text_color = $request->text_color;

        $date_var               = explode(" to ", $request->date_range);
        $flash_deal->start_date = strtotime($date_var[0]);
        $flash_deal->end_date   = strtotime( $date_var[1]);

        $flash_deal->background_color = $request->background_color;

        if($request->lang == env("DEFAULT_LANGUAGE")){
          $flash_deal->title = $request->title;
          if (($flash_deal->slug == null) || ($flash_deal->title != $request->title)) {
              $flash_deal->slug = strtolower(str_replace(' ', '-', $request->title) . '-' . Str::random(5));
          }
        }

        $flash_deal->banner = $request->banner;
        foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product) {
            $flash_deal_product->delete();
        }
        if($flash_deal->save()){
            foreach ($request->products as $key => $product) {
                $flash_deal_product = new FlashDealProduct;
                $flash_deal_product->flash_deal_id = $flash_deal->id;
                $flash_deal_product->product_id = $product;
                $flash_deal_product->save();

                $root_product = Product::findOrFail($product);
                $root_product->discount = $request['discount_'.$product];
                $root_product->discount_type = $request['discount_type_'.$product];
                $root_product->discount_start_date = strtotime($date_var[0]);
                $root_product->discount_end_date   = strtotime( $date_var[1]);
                $root_product->save();
            }

            $sub_category_translation = FlashDealTranslation::firstOrNew(['lang' => $request->lang, 'flash_deal_id' => $flash_deal->id]);
            $sub_category_translation->title = $request->title;
            $sub_category_translation->save();

            flash(translate('Flash Deal has been updated successfully'))->success();
            return back();
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
        $flash_deal = FlashDeal::findOrFail($id);
        foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product) {
            $flash_deal_product->delete();
        }

        foreach ($flash_deal->flash_deal_translations as $key => $flash_deal_translation) {
            $flash_deal_translation->delete();
        }

        FlashDeal::destroy($id);
        flash(translate('FlashDeal has been deleted successfully'))->success();
        return redirect()->route('flash_deals.index');
    }

    public function update_status(Request $request)
    {
        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->status = $request->status;
        if($flash_deal->save()){
            flash(translate('Flash deal status updated successfully'))->success();
            return 1;
        }
        return 0;
    }

    public function update_featured(Request $request)
    {
        foreach (FlashDeal::all() as $key => $flash_deal) {
            $flash_deal->featured = 0;
            $flash_deal->save();
        }
        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->featured = $request->featured;
        if($flash_deal->save()){
            flash(translate('Flash deal status updated successfully'))->success();
            return 1;
        }
        return 0;
    }

    public function product_discount(Request $request){
        $product_ids = $request->product_ids;
        return view('backend.marketing.flash_deals.flash_deal_discount', compact('product_ids'));
    }

    public function product_discount_edit(Request $request){
        $product_ids = $request->product_ids;
        $flash_deal_id = $request->flash_deal_id;
        return view('backend.marketing.flash_deals.flash_deal_discount_edit', compact('product_ids', 'flash_deal_id'));
    }
}
