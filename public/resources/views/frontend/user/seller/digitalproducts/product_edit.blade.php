@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Products') }}</h1>
            </div>
        </div>
    </div>
    <form class="" action="{{route('digitalproducts.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="hidden" name="lang" value="{{ $lang }}">
        @csrf
        @method('PATCH')
		<input type="hidden" name="added_by" value="seller">


        <div class="card mb-0 border-bottom-0">
            <div class="card-body p-0">
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Language::all() as $key => $language)
                        <li class="nav-item">
                            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('seller.digitalproducts.edit', ['id'=>$product->id, 'lang'=> $language->code] ) }}">
                                <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                                <span>{{$language->name}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('General')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Product Name')}} <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="name" placeholder="{{translate('Product Name')}}" value="{{$product->getTranslation('name', $lang)}}" required>
                    </div>
                </div>
                <div class="form-group row" id="category">
                    <label class="col-lg-3 col-from-label">{{translate('Category')}} <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-selected={{ $product->category_id }} required>
                            @foreach(\App\Category::where('parent_id', 0)->where('digital', 1)->with('childrenCategories')->get(); as $category)
                                <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('categories.child_category', ['child_category' => $childCategory])
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Product File')}} <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="input-group" data-toggle="aizuploader" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="file" class="selected-files" value="{{ $product->file_name }}">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Tags')}} <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control aiz-tag-input" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}">
                        <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Images')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="signinSrEmail">{{translate('Gallery Images')}} <small>(600x600)</small></label>
                    <div class="col-lg-9">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photos" value="{{ $product->photos }}" class="selected-files" required>
                        </div>
                        <div class="file-preview box sm">
                        </div>
                        <small class="text-muted">{{translate('These images are visible in product details page gallery. Use 600x600 sizes images.')}}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="signinSrEmail">{{translate('Thumbnail Image')}} <small>(300x300)</small></label>
                    <div class="col-lg-9">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="thumbnail_img" value="{{ $product->thumbnail_img }}" class="selected-files" required>
                        </div>
                        <div class="file-preview box sm">
                        </div>
                        <small class="text-muted">{{translate('This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.')}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Meta Tags')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Meta Title')}}</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}" placeholder="{{translate('Meta Title')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Description')}}</label>
                    <div class="col-lg-9">
                        <textarea name="meta_description" rows="8" class="form-control">{{ $product->meta_description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="signinSrEmail">{{ translate('Meta Image') }}</label>
                    <div class="col-lg-9">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="meta_img" value="{{ $product->meta_img }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Slug')}}</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="slug" value="{{ $product->slug }}" placeholder="{{translate('Slug')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Price')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Unit price')}}</label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="{{translate('Unit price')}}" name="unit_price" class="form-control" value="{{$product->unit_price}}" required>
                    </div>
                </div>
                <!--<div class="form-group row">-->
                    <!--<label class="col-lg-3 col-from-label">{{translate('Purchase price')}}</label>-->
                    <!--<div class="col-lg-9">-->
                        <input type="hidden" lang="en" min="0" step="0.01" placeholder="{{translate('Purchase price')}}" name="purchase_price" class="form-control" value="{{$product->purchase_price}}" required>
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="form-group row">-->
                <!--    <label class="col-lg-3 col-from-label">{{translate('Tax')}}</label>-->
                <!--    <div class="col-lg-6">-->
                <!--        <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('tax')}}" name="tax" class="form-control" value="{{$product->tax}}" required>-->
                <!--    </div>-->
                <!--    <div class="col-lg-3">-->
                <!--        <select class="form-control aiz-selectpicker" name="tax_type" required>-->
                <!--            <option value="amount" <?php if($product->tax_type == 'amount') echo "selected";?> >{{translate('Flat')}}</option>-->
                <!--            <option value="percent" <?php if($product->tax_type == 'percent') echo "selected";?> >{{translate('Percent')}}</option>-->
                <!--        </select>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Discount')}}</label>
                    <div class="col-lg-6">
                        <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Discount')}}" name="discount" class="form-control" value="{{ $product->discount }}" required>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control aiz-selectpicker" name="discount_type" required>
                            <option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> >{{translate('Flat')}}</option>
                            <option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> >{{translate('Percent')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Description')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Description')}}</label>
                    <div class="col-lg-9">
                        <textarea class="aiz-text-editor" name="description">{{ $product->getTranslation('description', $lang) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-0 text-right">
            <button type="submit" class="btn btn-primary">{{translate('Update Product')}}</button>
        </div>
    </form>

@endsection
