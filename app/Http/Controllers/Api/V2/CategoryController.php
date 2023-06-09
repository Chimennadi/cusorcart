<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\CategoryCollection;
use App\Models\BusinessSetting;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index($parent_id = 0)
    {
        if(request()->has('parent_id') && is_numeric (request()->get('parent_id'))){
          $parent_id = request()->get('parent_id');
        }
        return new CategoryCollection(Category::where('parent_id', $parent_id)->get());
    }

    public function featured()
    {
        return new CategoryCollection(Category::where('featured', 1)->get());
    }

    public function home()
    {
        $homepageCategories = BusinessSetting::where('type', 'home_categories')->first();
        $homepageCategories = json_decode($homepageCategories->value);
        return new CategoryCollection(Category::whereIn('id', $homepageCategories)->get());
    }

    public function top()
    {
        $homepageCategories = BusinessSetting::where('type', 'home_categories')->first();
        $homepageCategories = json_decode($homepageCategories->value);
        return new CategoryCollection(Category::whereIn('id', $homepageCategories)->limit(20)->get());
    }
}
