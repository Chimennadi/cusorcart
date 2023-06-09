<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\ProductCollection;
use App\Http\Resources\V2\ProductMiniCollection;
use App\Http\Resources\V2\ProductDetailCollection;
use App\Http\Resources\V2\SearchProductCollection;
use App\Http\Resources\V2\FlashDealCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashDeal;
use App\Models\FlashDealProduct;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Utility\CategoryUtility;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductMiniCollection(Product::latest()->paginate(10));
    }

    public function show($id)
    {
        return new ProductDetailCollection(Product::where('id', $id)->get());
    }

    public function admin()
    {
        return new ProductCollection(Product::where('added_by', 'admin')->latest()->paginate(10));
    }

    public function seller($id, Request $request)
    {
        $shop = Shop::findOrFail($id);
        $products = Product::where('added_by', 'seller')->where('user_id', $shop->user_id);
        if ($request->name != "" || $request->name != null) {
            $products = $products->where('name', 'like', '%' . $request->name . '%');
        }
        return new ProductMiniCollection($products->latest()->paginate(10));
    }

    public function category($id, Request $request)
    {
        $category_ids = CategoryUtility::children_ids($id);
        $category_ids[] = $id;

        $products = Product::whereIn('category_id', $category_ids);

        if ($request->name != "" || $request->name != null) {
            $products = $products->where('name', 'like', '%' . $request->name . '%');
        }
        return new ProductMiniCollection(filter_products($products)->latest()->paginate(10));
    }

    public function subCategory($id)
    {
        $category_ids = CategoryUtility::children_ids($id);
        $category_ids[] = $id;

        return new ProductMiniCollection(Product::whereIn('category_id', $category_ids)->latest()->paginate(10));
    }

    public function subSubCategory($id)
    {
        $category_ids = CategoryUtility::children_ids($id);
        $category_ids[] = $id;

        return new ProductMiniCollection(Product::whereIn('category_id', $category_ids)->latest()->paginate(10));
    }

    public function brand($id, Request $request)
    {
        $products = Product::where('brand_id', $id);
        if ($request->name != "" || $request->name != null) {
            $products = $products->where('name', 'like', '%' . $request->name . '%');
        }
        return new ProductMiniCollection($products->latest()->paginate(10));
    }

    public function todaysDeal()
    {
        return new ProductMiniCollection(Product::where('todays_deal', 1)->limit(20)->latest()->get());
    }

    public function flashDeal()
    {
        $flash_deals = FlashDeal::where('status', 1)->where('featured', 1)->where('start_date', '<=', strtotime(date('d-m-Y')))->where('end_date', '>=', strtotime(date('d-m-Y')))->get();
        return new FlashDealCollection($flash_deals);
    }

    public function featured()
    {
        return new ProductMiniCollection(Product::where('featured', 1)->limit(20)->latest()->get());
    }

    public function bestSeller()
    {
        return new ProductMiniCollection(Product::orderBy('num_of_sale', 'desc')->limit(20)->get());
    }

    public function related($id)
    {
        $product = Product::find($id);
        return new ProductMiniCollection(Product::where('category_id', $product->category_id)->where('id', '!=', $id)->limit(10)->get());
    }

    public function topFromSeller($id)
    {
        $product = Product::find($id);
        return new ProductMiniCollection(Product::where('user_id', $product->user_id)->orderBy('num_of_sale', 'desc')->limit(10)->get());
    }


    public function search(Request $request)
    {
        $category_ids = [];
        $brand_ids = [];

        if ($request->categories != null && $request->categories != "") {
            $category_ids = explode(',', $request->categories);
        }

        if ($request->brands != null && $request->brands != "") {
            $brand_ids = explode(',', $request->brands);
        }

        $sort_by = $request->sort_key;
        $name = $request->name;
        $min = $request->min;
        $max = $request->max;


        $products = Product::query();

        if (!empty($brand_ids)) {
            $products = $products->whereIn('brand_id', $brand_ids);
        }

        if (!empty($category_ids)) {
            $n_cid = [];
            foreach ($category_ids as $cid) {
                $n_cid = array_merge($n_cid, CategoryUtility::children_ids($cid));
            }

            if (!empty($n_cid)) {
                $category_ids = array_merge($category_ids, $n_cid);
            }

            $products = $products->whereIn('category_id', $category_ids);
        }

        if ($name != null && $name != "") {
            $products = $products->where('name', 'like', "%{$name}%");
        }

        if ($min != null && $min != "" && is_numeric($min)) {
            $products = $products->where('unit_price', '>=', $min);
        }

        if ($max != null && $max != "" && is_numeric($max)) {
            $products = $products->where('unit_price', '<=', $max);
        }

        switch ($sort_by) {
            case 'price_low_to_high':
                $products = $products->orderBy('unit_price', 'asc');
                break;

            case 'price_high_to_low':
                $products = $products->orderBy('unit_price', 'desc');
                break;

            case 'new_arrival':
                $products = $products->orderBy('created_at', 'desc');
                break;

            case 'popularity':
                $products = $products->orderBy('num_of_sale', 'desc');
                break;

            case 'top_rated':
                $products = $products->orderBy('rating', 'desc');
                break;

            default:
                $products = $products->orderBy('created_at', 'desc');
                break;
        }

        return new ProductMiniCollection($products->paginate(10));
    }

    public function variantPrice(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $str = '';
        $tax = 0;

        if ($request->has('color') && $request->color != "") {
            $str = Color::where('code', '#' . $request->color)->first()->name;
        }

        $var_str = str_replace(',', '-', $request->variants);
        $var_str = str_replace(' ', '', $var_str);

        if ($var_str != "") {
            $temp_str = $str == "" ? $var_str : '-'.$var_str;
            $str .= $temp_str;
        }


        $product_stock = $product->stocks->where('variant', $str)->first();
        $price = $product_stock->price;
        $stockQuantity = $product_stock->qty;


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
            $price += ($price * $product->tax) / 100;
        } elseif ($product->tax_type == 'amount') {
            $price += $product->tax;
        }

        ini_set('serialize_precision', -1);

        return response()->json([
            'product_id' => $product->id,
            'variant' => $str,
            'price' => (double)convert_price($price),
            'price_string' => format_price(convert_price($price)),
            'stock' => intval($stockQuantity)
        ]);
    }

    public function home()
    {
        return new ProductCollection(Product::inRandomOrder()->take(50)->get());
    }
}
