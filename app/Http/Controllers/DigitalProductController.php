<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductStock;
use App\Category;
use App\ProductTranslation;
use Storage;
use App\Language;
use App\Upload;
use Auth;

class DigitalProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search    = null;
        $products       = Product::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search    = $request->search;
            $products       = $products->where('name', 'like', '%'.$sort_search.'%');
        }
        $products = $products->where('digital', 1)->paginate(10);
        return view('backend.product.digital_products.index', compact('products','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->where('digital', 1)
            ->with('childrenCategories')
            ->get();
        return view('backend.product.digital_products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $product                    = new Product;
        $product->name              = $request->name;
        $product->added_by          = $request->added_by;
        $product->user_id           = Auth::user()->id;
        $product->category_id       = $request->category_id;
        $product->digital           = 1;
        $product->photos            = $request->photos;
        $product->thumbnail_img     = $request->thumbnail_img;

        $tags = array();
        if($request->tags[0] != null){
            foreach (json_decode($request->tags[0]) as $key => $tag) {
                array_push($tags, $tag->value);
            }
        }
        $product->tags = implode(',', $tags);

        $product->description       = $request->description;
        $product->unit_price        = $request->unit_price;
        $product->purchase_price    = $request->purchase_price;
        $product->tax               = $request->tax;
        $product->tax_type          = $request->tax_type;
        $product->discount          = $request->discount;
        $product->discount_type     = $request->discount_type;

        $product->meta_title        = $request->meta_title;
        $product->meta_description  = $request->meta_description;
        $product->meta_img          = $request->meta_img;

        // if($request->hasFile('file')){
        //     $product->file_name = $request->file('file')->getClientOriginalName();
        //     $product->file_path = $request->file('file')->store('uploads/products/digital');
        // }

        $product->file_name = $request->file;

        $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.rand(10000,99999);

        if($product->save()){
            
            $product_stock              = new ProductStock;
            $product_stock->product_id  = $product->id;
            $product_stock->variant     = '';
            $product_stock->price       = $request->unit_price;
            $product_stock->sku         = '';
            $product_stock->qty         = 0;
            $product_stock->save();

            // Product Translations
            $product_translation                = ProductTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'product_id' => $product->id]);
            $product_translation->name          = $request->name;
            $product_translation->description   = $request->description;
            $product_translation->save();

            flash(translate('Digital Product has been inserted successfully'))->success();
            if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                return redirect()->route('digitalproducts.index');
            }
            else{
                if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
                    $seller = Auth::user()->seller;
                    $seller->remaining_digital_uploads -= 1;
                    $seller->save();
                }
                return redirect()->route('seller.digitalproducts');
            }
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
        $lang = $request->lang;
        $product = Product::findOrFail($id);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 1)
            ->with('childrenCategories')
            ->get();
        return view('backend.product.digital_products.edit', compact('product','lang', 'categories'));
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
        $product                    = Product::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $product->name          = $request->name;
            $product->description   = $request->description;
        }

        $product->user_id           = Auth::user()->id;
        $product->category_id       = $request->category_id;
        $product->digital           = 1;
        $product->photos            = $request->photos;
        $product->thumbnail_img     = $request->thumbnail_img;

        $tags = array();
        if($request->tags[0] != null){
            foreach (json_decode($request->tags[0]) as $key => $tag) {
                array_push($tags, $tag->value);
            }
        }
        $product->tags = implode(',', $tags);

        $product->unit_price        = $request->unit_price;
        $product->purchase_price    = $request->purchase_price;
        $product->tax               = $request->tax;
        $product->tax_type          = $request->tax_type;
        $product->discount          = $request->discount;
        $product->discount_type     = $request->discount_type;

        $product->meta_title        = $request->meta_title;
        $product->meta_description  = $request->meta_description;
        $product->meta_img          = $request->meta_img;
        $product->slug              = strtolower($request->slug);

        // if($request->hasFile('file')){
        //     $product->file_name = $request->file('file')->getClientOriginalName();
        //     $product->file_path = $request->file('file')->store('uploads/products/digital');
        // }

        $product->file_name = $request->file;

        // Delete From Product Stock
        foreach ($product->stocks as $key => $stock) {
            $stock->delete();
        }
        
        if($product->save()){
            // Insert Into Product Stock
            $product_stock              = new ProductStock;
            $product_stock->product_id  = $product->id;
            $product_stock->variant     = '';
            $product_stock->price       = $request->unit_price;
            $product_stock->sku         = '';
            $product_stock->qty         = 0;
            $product_stock->save();
            
            // Product Translations
            $product_translation                = ProductTranslation::firstOrNew(['lang' => $request->lang, 'product_id' => $product->id]);
            $product_translation->name          = $request->name;
            $product_translation->description   = $request->description;
            $product_translation->save();

            flash(translate('Digital Product has been updated successfully'))->success();
            if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                return back();
            }
            else{
                return back();
            }
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
        $product = Product::findOrFail($id);
        foreach ($product->product_translations as $key => $product_translation) {
            $product_translation->delete();
        }
        Product::destroy($id);

        flash(translate('Product has been deleted successfully'))->success();
        if(Auth::user()->user_type == 'admin'){
            return redirect()->route('digitalproducts.index');
        }
        else{
            return redirect()->route('seller.digitalproducts');
        }

    }


    public function download(Request $request){
        $product = Product::findOrFail(decrypt($request->id));
        $downloadable = false;
        foreach (Auth::user()->orders as $key => $order) {
            foreach ($order->orderDetails as $key => $orderDetail) {
                if($orderDetail->product_id == $product->id && $orderDetail->payment_status == 'paid'){
                    $downloadable = true;
                    break;
                }
            }
        }
        if(Auth::user()->user_type == 'admin' || Auth::user()->id == $product->user_id || $downloadable){
            $upload = Upload::findOrFail($product->file_name);
            if (env('FILESYSTEM_DRIVER') == "s3") {
                return \Storage::disk('s3')->download($upload->file_name, $upload->file_original_name.".".$upload->extension);
            }
            else {
                if (file_exists(base_path('public/'.$upload->file_name))) {
                    return response()->download(base_path('public/'.$upload->file_name));
                }
            }
        }
        else {
            abort(404);
        }
    }

    public function updatePublished(Request $request)
    {
        $product = DigitalProduct::findOrFail($request->id);
        $product->published = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }
}
