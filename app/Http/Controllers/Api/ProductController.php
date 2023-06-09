<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductDetailCollection;
use App\Http\Resources\SearchProductCollection;
use App\Http\Resources\FlashDealCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashDeal;
use App\Models\FlashDealProduct;
use App\Models\Product;

use App\Product as AppProduct;
use App\Attribute;
use App\Models\Shop;
use App\Models\Color;
use App\ProductStock;
use Illuminate\Http\Request;
use App\Utility\CategoryUtility;
use Illuminate\Support\Str;
use App\Cart;
use Illuminate\Support\Facades\Artisan;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductCollection(Product::latest()->paginate(10));
    }

    public function show($id)
    {
        return new ProductDetailCollection(Product::where('id', $id)->get());
    }

    public function admin()
    {
        return new ProductCollection(Product::where('added_by', 'admin')->latest()->paginate(10));
    }

    public function seller()
    {
        return new ProductCollection(Product::where('added_by', 'seller')->latest()->paginate(10));
    }

    public function category($id)
    {
        $category_ids = CategoryUtility::children_ids($id);
        $category_ids[] = $id;

        return new ProductCollection(Product::whereIn('category_id', $category_ids)->latest()->paginate(10));
    }
    // get max prices
    public function categoryMaxPrice($id)
    {
        $category_ids = CategoryUtility::children_ids($id);
        $category_ids[] = $id;
        $max_price = Product::whereIn('category_id', $category_ids)->max('unit_price');
        
        return [
            'data'=>(float) $max_price,
            'success' => true,
            'status' => 200
        ];
    }
    public function maxPrice()
    {
        $max_price = Product::max('unit_price');
        
        return [
            'data'=>(float) $max_price,
            'success' => true,
            'status' => 200
        ];
    }
    
    public function duplicate(Request $request, $id)
    {
        $product = Product::find($id);
        $product_new = $product->replicate();
        $product_new->slug = substr($product_new->slug, 0, -5) . Str::random(5);

        if ($product_new->save()) {
            foreach ($product->stocks as $key => $stock) {
                $product_stock              = new ProductStock();
                $product_stock->product_id  = $product_new->id;
                $product_stock->variant     = $stock->variant;
                $product_stock->price       = $stock->price;
                $product_stock->sku         = $stock->sku;
                $product_stock->qty         = $stock->qty;
                $product_stock->save();
            }

            flash(translate('Product has been duplicated successfully'))->success();
        
            return [
                'message'=> 'Product has been duplicated successfully',
                'success' => true,
                'status' => 200
            ];
        } else {
            flash(translate('Something went wrong'))->error();
            return [
                'message'=> 'Something went wrong',
                'success' => false,
                'status' => 200
            ];
        }
    }
    public function delete($id)
    {
        $product = AppProduct::findOrFail($id);
        foreach ($product->product_translations as $key => $product_translations) {
            $product_translations->delete();
        }

        foreach ($product->stocks as $key => $stock) {
            $stock->delete();
        }

        if (AppProduct::destroy($id)) {
            Cart::where('product_id', $id)->delete();

            flash(translate('Product has been deleted successfully'))->success();

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

             return [
                'message'=> 'Product has been deleted successfully',
                'success' => true,
                'status' => 200
            ];
        } else {
            flash(translate('Something went wrong'))->error();
            return [
                'message'=> 'Something went wrong',
                'success' => false,
                'status' => 200
            ];
        }
    }
    public function getAllAttributes()
    {
        $data = Attribute::get();
        
        return [
            'data'=> $data,
            'success' => true,
            'status' => 200
        ];
    }

    public function subCategory($id)
    {
        $category_ids = CategoryUtility::children_ids($id);
        $category_ids[] = $id;

        return new ProductCollection(Product::whereIn('category_id', $category_ids)->latest()->paginate(10));
    }

    public function subSubCategory($id)
    {
        $category_ids = CategoryUtility::children_ids($id);
        $category_ids[] = $id;

        return new ProductCollection(Product::whereIn('category_id', $category_ids)->latest()->paginate(10));
    }

    public function brand($id)
    {
        return new ProductCollection(Product::where('brand_id', $id)->latest()->paginate(10));
    }

    public function todaysDeal()
    {
        return new ProductCollection(Product::where('todays_deal', 1)->latest()->get());
    }

    public function flashDeal()
    {
        $flash_deals = FlashDeal::where('status', 1)->where('featured', 1)->where('start_date', '<=', strtotime(date('d-m-Y')))->where('end_date', '>=', strtotime(date('d-m-Y')))->get();
        return new FlashDealCollection($flash_deals);
    }

    public function featured()
    {
        return new ProductCollection(Product::where('featured', 1)->latest()->get());
    }

    public function bestSeller()
    {
        return new ProductCollection(Product::orderBy('num_of_sale', 'desc')->limit(20)->get());
    }

    public function related($id)
    {
        $product = Product::find($id);
        return new ProductCollection(Product::where('category_id', $product->category_id)->where('id', '!=', $id)->limit(10)->get());
    }

    public function topFromSeller($id)
    {
        $product = Product::find($id);
        return new ProductCollection(Product::where('user_id', $product->user_id)->orderBy('num_of_sale', 'desc')->limit(4)->get());
    }

    public function search()
    {
        $key = request('key');
        $scope = request('scope');

        switch ($scope) {

            case 'price_low_to_high':
                $collection = new SearchProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('unit_price', 'asc')->paginate(10));
                $max_price=Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('unit_price', 'asc')->max('unit_price');
                $collection->appends(['key' =>  $key, 'scope' => $scope,'max_price'=>$max_price]);
                return $collection;

            case 'price_high_to_low':
                $collection = new SearchProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('unit_price', 'desc')->paginate(10));
                $max_price=Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('unit_price', 'desc')->max('unit_price');
                $collection->appends(['key' =>  $key, 'scope' => $scope,'max_price'=>$max_price]);
                return $collection;

            case 'new_arrival':
                $collection = new SearchProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('created_at', 'desc')->paginate(10));
                $max_price=Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('created_at', 'desc')->max('unit_price');
                $collection->appends(['key' =>  $key, 'scope' => $scope,'max_price'=>$max_price]);
                return $collection;

            case 'popularity':
                $collection = new SearchProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('num_of_sale', 'desc')->paginate(10));
                $max_price=Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('num_of_sale', 'desc')->max('unit_price');
                $collection->appends(['key' =>  $key, 'scope' => $scope,'max_price'=>$max_price]);
                return $collection;

            case 'top_rated':
                $collection = new SearchProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('rating', 'desc')->paginate(10));
                $max_price=Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('rating', 'desc')->max('unit_price');
                $collection->appends(['key' =>  $key, 'scope' => $scope,'max_price'=>$max_price]);
                return $collection;

            // case 'category':
            //
            //     $categories = Category::select('id')->where('name', 'like', "%{$key}%")->get()->toArray();
            //     $collection = new SearchProductCollection(Product::where('category_id', $categories)->orderBy('num_of_sale', 'desc')->paginate(10));
            //     $collection->appends(['key' =>  $key, 'scope' => $scope]);
            //     return $collection;
            //
            // case 'brand':
            //
            //     $brands = Brand::select('id')->where('name', 'like', "%{$key}%")->get()->toArray();
            //     $collection = new SearchProductCollection(Product::where('brand_id', $brands)->orderBy('num_of_sale', 'desc')->paginate(10));
            //     $collection->appends(['key' =>  $key, 'scope' => $scope]);
            //     return $collection;
            //
            // case 'shop':
            //
            //     $shops = Shop::select('user_id')->where('name', 'like', "%{$key}%")->get()->toArray();
            //     $collection = new SearchProductCollection(Product::where('user_id', $shops)->orderBy('num_of_sale', 'desc')->paginate(10));
            //     $collection->appends(['key' =>  $key, 'scope' => $scope]);
            //     return $collection;

            default:
                $collection = new SearchProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('num_of_sale', 'desc')->paginate(10));
                $max_price=Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('num_of_sale', 'desc')->max('unit_price');
                $collection->appends(['key' =>  $key, 'scope' => $scope,'max_price'=>$max_price]);
                return $collection;
        }
    }

    public function variantPrice(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $str = '';
        $tax = 0;

        if ($request->has('color')) {
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
        }

        foreach (json_decode($request->choice) as $option) {
            $str .= $str != '' ?  '-'.str_replace(' ', '', $option->name) : str_replace(' ', '', $option->name);
        }

        if($str != null && $product->variant_product){
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;
            $stockQuantity = $product_stock->qty;
        }
        else{
            $price = $product->unit_price;
            $stockQuantity = $product->current_stock;
        }

        //discount calculation
        $discount_applicable = false;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        }
        elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if ($product->tax_type == 'percent') {
            $price += ($price*$product->tax) / 100;
        }
        elseif ($product->tax_type == 'amount') {
            $price += $product->tax;
        }

        return response()->json([
            'product_id' => $product->id,
            'variant' => $str,
            'price' => (double) $price,
            'in_stock' => $stockQuantity < 1 ? false : true
        ]);
    }

    public function home()
    {
        return new ProductCollection(Product::inRandomOrder()->take(50)->get());
    }
}
