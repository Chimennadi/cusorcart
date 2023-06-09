<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use DB;
use Artisan;
use Schema;
use App\BusinessSetting;
use App\Language;
use App\Category;
use App\CategoryTranslation;
use App\Brand;
use App\SubCategory;
use App\SubSubCategory;
use App\SubCategoryTranslation;
use App\SubSubCategoryTranslation;
use App\Attribute;
use App\AttributeValue;
use App\ProductStock;
use App\Upload;
use App\Banner;
use App\User;
use App\CustomerPackage;
use App\CustomerProduct;
use App\FlashDeal;
use App\Product;
use App\Tax;
use App\ProductTax;
use App\Shop;
use App\Slider;
use App\HomeCategory;
use App\Order;
use App\OrderDetail;
use Storage;
use ZipArchive;

class UpdateController extends Controller
{
    public function step0(Request $request) {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        if ($request->hasFile('update_zip')) {
            if (class_exists('ZipArchive')) {
                // Create update directory.
                $dir = 'updates';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);

                $path = Storage::disk('local')->put('updates', $request->update_zip);

                $zipped_file_name = $request->update_zip->getClientOriginalName();

                //Unzip uploaded update file and remove zip file.
                $zip = new ZipArchive;
                $res = $zip->open(base_path('public/' . $path));

                if ($res === true) {
                    $res = $zip->extractTo(base_path());
                    $zip->close();
                } else {
                    flash(translate('Could not open the updates zip file.'))->error();
                    return back();
                }

                return redirect()->route('update.step1');
            }
            else {
                flash(translate('Please enable ZipArchive extension.'))->error();
            }
        }
        else {
            return view('update.step0');
        }
    }

    public function step1() {
        if(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '4.6'){
            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        if(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '4.5'){
            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '4.4'){
            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '4.3'){
            $sql_path = base_path('sqlupdates/v44.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '4.2'){
            $sql_path = base_path('sqlupdates/v43.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v44.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '4.1'){
            $sql_path = base_path('sqlupdates/v42.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v43.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v44.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '4.0'){
            $sql_path = base_path('sqlupdates/v41.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v42.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v43.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v44.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '3.9'){
            $sql_path = base_path('sqlupdates/v40.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v41.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v42.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v43.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v44.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '3.8'){
            $sql_path = base_path('sqlupdates/v39.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v40.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v41.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v42.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v43.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v44.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '3.7'){
            $sql_path = base_path('sqlupdates/v38.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v39.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v40.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v41.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v42.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v43.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v44.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '3.6'){
            $sql_path = base_path('sqlupdates/v37.sql');
            DB::unprepared(file_get_contents($sql_path));

            $this->convertCategory();

            $sql_path = base_path('sqlupdates/v38.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v39.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v40.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v41.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v42.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v43.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v44.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v45.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v46.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v47.sql');
            DB::unprepared(file_get_contents($sql_path));

            $sql_path = base_path('sqlupdates/v48.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        else {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            $previousRouteServiceProvier = base_path('app/Providers/RouteServiceProvider.php');
            $newRouteServiceProvier      = base_path('app/Providers/RouteServiceProvider.txt');
            copy($newRouteServiceProvier, $previousRouteServiceProvier);

            return view('update.done');
        }
    }

    public function step2() {
        if(count(ProductTax::all()) == 0){
            $this->convertTaxes();
        }

        foreach (Order::all() as $order) {
            if (count($order->orderDetails) > 0) {
                $order->seller_id = $order->orderDetails->first()->seller_id;
                $order->delivery_status = $order->orderDetails->first()->delivery_status;
                $order->save();
            }
        }

        foreach (Product::all() as $product) {
            if ($product->stocks->isEmpty()) {
                $product_stock = new ProductStock;
                $product_stock->product_id = $product->id;
                $product_stock->variant = '';
                $product_stock->price = $product->unit_price;
                $product_stock->sku = $product->sku;
                $product_stock->qty = $product->current_stock;
                $product_stock->save();
            }
        }

        foreach (Product::all() as $product) {
            if ($product->variant_product) {
                try {
                    $choice_options = json_decode($product->choice_options);
                    foreach ($choice_options as $choice_option) {
                        foreach ($choice_option->values as $value) {
                            $attribute_value = AttributeValue::where('value', $value)->first();
                            if ($attribute_value == null) {
                                $attribute_value = new AttributeValue;
                                $attribute_value->attribute_id = $choice_option->attribute_id;
                                $attribute_value->value = $value;
                                $attribute_value->save();
                            }
                        }
                    }
                } catch (\Exception $e) {

                }
            }
        }

        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        $previousRouteServiceProvier = base_path('app/Providers/RouteServiceProvider.php');
        $newRouteServiceProvier      = base_path('app/Providers/RouteServiceProvider.txt');
        copy($newRouteServiceProvier, $previousRouteServiceProvier);

        return view('update.done');
    }

    public function convertTaxes(){
        $tax = Tax::first();

        foreach (Product::all() as $product) {
            $product_tax = new ProductTax;
            $product_tax->product_id = $product->id;
            $product_tax->tax_id = $tax->id;
            $product_tax->tax = $product->tax;
            $product_tax->tax_type = $product->tax_type;
            $product_tax->save();
        }
    }
}
