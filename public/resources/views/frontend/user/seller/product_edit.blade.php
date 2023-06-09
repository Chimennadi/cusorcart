@extends('frontend.layouts.user_panel')

@section('panel_content')

<div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Update your product') }}</h1>
        </div>
    </div>
</div>

<form class="" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data"
    id="choice_form">
    <div class="row gutters-5">
        <div class="col-lg-8">
            <input name="_method" type="hidden" value="POST">
            <input type="hidden" name="lang" value="{{ $lang }}">
            <input type="hidden" name="id" value="{{ $product->id }}">
            @csrf
            <input type="hidden" name="added_by" value="seller">
            <div class="card">
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Language::all() as $key => $language)
                    <li class="nav-item">
                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                            href="{{ route('seller.products.edit', ['id'=>$product->id, 'lang'=> $language->code] ) }}">
                            <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11"
                                class="mr-1">
                            <span>{{$language->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Product Name')}}</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="name"
                                placeholder="{{translate('Product Name')}}" value="{{$product->getTranslation('name')}}"
                                required>
                        </div>
                    </div>
                    <div class="form-group row" id="category">
                        <label class="col-lg-3 col-from-label">{{translate('Category')}}</label>
                        <div class="col-lg-8">
                            <select class="form-control aiz-selectpicker" name="category_id" id="category_id"
                                data-selected={{ $product->category_id }} required>
                                @foreach ($categories as $category)
                                <option disabled  value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                @foreach ($category->childrenCategories as $childCategory)
                                @include('categories.child_category', ['child_category' => $childCategory])
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="brand">
                        <label class="col-lg-3 col-from-label">{{translate('Brand')}}</label>
                        <div class="col-lg-8">
                            <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id">
                                <option value="">{{ translate('Select Brand') }}</option>
                                @foreach (\App\Brand::all() as $brand)
                                <option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected
                                    @endif>{{ $brand->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Unit')}}</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="unit"
                                placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}"
                                value="{{$product->getTranslation('unit')}}" required>
                        </div>
                    </div>
                    
                    
                      <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Weight in Kg')}}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="kg"
                            value="{{$product->kg}}" 
                                placeholder="{{ translate('Weight in Kg') }}" required>
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Minimum Purchase Qty')}}</label>
                        <div class="col-lg-8">
                            <input type="number" lang="en" class="form-control" name="min_qty"
                                value="@if($product->min_qty <= 1){{1}}@else{{$product->min_qty}}@endif" min="1"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Tags')}}</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control aiz-tag-input" name="tags[]" id="tags"
                                value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}"
                                data-role="tagsinput">
                        </div>
                    </div>
                    @php
                    $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
                    @endphp
                    @if ($pos_addon != null && $pos_addon->activated == 1)
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Barcode')}}</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="barcode"
                                placeholder="{{ translate('Barcode') }}" value="{{ $product->barcode }}">
                        </div>
                    </div>
                    @endif

                    @php
                    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                    @endphp
                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Refundable')}}</label>
                        <div class="col-lg-8">
                            <label class="aiz-switch aiz-switch-success mb-0" style="margin-top:5px;">
                                <input type="checkbox" name="refundable" @if ($product->refundable == 1) checked @endif>
                                <span class="slider round"></span></label>
                            </label>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Product Images')}}</h5>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                            for="signinSrEmail">{{translate('Gallery Images')}}</label>
                        <div class="col-md-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="photos" value="{{ $product->photos }}"
                                    class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Thumbnail Image')}}
                            <small>(290x300)</small></label>
                        <div class="col-md-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="thumbnail_img" value="{{ $product->thumbnail_img }}"
                                    class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                            <label class="col-lg-3 col-from-label">{{translate('Gallery Images')}}</label>
                    <div class="col-lg-8">
                        <div id="photos">
                            @if(is_array(json_decode($product->photos)))
                            @foreach (json_decode($product->photos) as $key => $photo)
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="img-upload-preview">
                                    <img loading="lazy" src="{{ uploaded_asset($photo) }}" alt=""
                                        class="img-responsive">
                                    <input type="hidden" name="previous_photos[]" value="{{ $photo }}">
                                    <button type="button" class="btn btn-danger close-btn remove-files"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="form-group row">
                            <label class="col-lg-3 col-from-label">{{translate('Thumbnail Image')}}
                <small>(290x300)</small></label>
                <div class="col-lg-8">
                    <div id="thumbnail_img">
                        @if ($product->thumbnail_img != null)
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img loading="lazy" src="{{ uploaded_asset($product->thumbnail_img) }}" alt=""
                                    class="img-responsive">
                                <input type="hidden" name="previous_thumbnail_img"
                                    value="{{ $product->thumbnail_img }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Product Videos')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Video Provider')}}</label>
                <div class="col-lg-8">
                    <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">
                        <option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?>>
                            {{translate('Youtube')}}</option>
                        <option value="dailymotion"
                            <?php if($product->video_provider == 'dailymotion') echo "selected";?>>
                            {{translate('Dailymotion')}}</option>
                        <option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?>>
                            {{translate('Vimeo')}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Video Link')}}</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}"
                        placeholder="{{ translate('Video Link') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Product Variation')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-3">
                    <input type="text" class="form-control" value="{{translate('Colors')}}" disabled>
                </div>
                <div class="col-lg-8">
                    <select class="form-control aiz-selectpicker" data-live-search="true"
                        data-selected-text-format="count" name="colors[]" id="colors" multiple>
                        @foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
                        <option value="{{ $color->code }}"
                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}'></span><span>{{ $color->name }}</span></span>"
                            <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?>></option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-1">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input value="1" type="checkbox" name="colors_active"
                            <?php if(count(json_decode($product->colors)) > 0) echo "checked";?>>
                        <span></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-3">
                    <input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>
                </div>
                <div class="col-lg-8">
                    <select name="choice_attributes[]" data-live-search="true" data-selected-text-format="count"
                        id="choice_attributes" class="form-control aiz-selectpicker" multiple
                        data-placeholder="{{ translate('Choose Attributes') }}">
                        @foreach (\App\Attribute::all() as $key => $attribute)
                        <option value="{{ $attribute->id }}" @if($product->attributes != null &&
                            in_array($attribute->id, json_decode($product->attributes, true))) selected
                            @endif>{{ $attribute->getTranslation('name') }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="">
                <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>
                <br>
            </div>

            <div class="customer_choice_options" id="customer_choice_options">
                @foreach (json_decode($product->choice_options) as $key => $choice_option)
                <div class="form-group row">
                    <div class="col-lg-3">
                        <input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
                        <input type="text" class="form-control" name="choice[]"
                            value="{{ \App\Attribute::find($choice_option->attribute_id)->getTranslation('name') }}"
                            placeholder="{{ translate('Choice Title') }}" disabled>
                    </div>
                    <div class="col-lg-8">
                        <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_{{ $choice_option->attribute_id }}[]" multiple>
                            @foreach (\App\AttributeValue::where('attribute_id', $choice_option->attribute_id)->get() as $row)
                                <option value="{{ $row->value }}" @if( in_array($row->value, $choice_option->values)) selected @endif>
                                    {{ $row->value }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-control aiz-tag-input" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="{{ translate('Enter choice values') }}" value="{{ implode(',', $choice_option->values) }}" data-on-change="update_sku"> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Product price + stock')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Unit price')}}</label>
                <div class="col-lg-6">
                    <input type="text" placeholder="{{translate('Unit price')}}" name="unit_price" class="form-control"
                        value="{{$product->unit_price}}" required>
                </div>
            </div>
            
             <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('Unit Price Currency')}} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                            <select class="form-control" name="price_currecny" required>
                            <option>Price Upload Currency:</option>
                            @foreach(App\Currency::where('status','1')->get() as $itemcurrency)
                            <option
                            value="{{$itemcurrency->id}}"
                            @if($product->price_currecny == $itemcurrency->id) selected @endif
                            >{{$itemcurrency->name}}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>
            
            
            
            
            
<!--            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Purchase price')}}</label>
                <div class="col-lg-6">
                    <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Purchase price')}}"
                        name="purchase_price" class="form-control" value="{{$product->purchase_price}}" required>
                </div>
            </div>-->
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Discount')}}</label>
                <div class="col-lg-6">
                    <input type="number" lang="en"  step="0.01" placeholder="{{translate('Discount')}}"
                        name="discount" class="form-control" value="{{ $product->discount }}" >
                </div>
                <div class="col-lg-3">
                    <select class="form-control aiz-selectpicker" name="discount_type" required>
                        <option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?>>
                            {{translate('Flat')}}</option>
                        <option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?>>
                            {{translate('Percent')}}</option>
                    </select>
                </div>
            </div>

            <div id="show-hide-div">
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Quantity')}}</label>
                    <div class="col-lg-6">
                        @if( $product->stocks->first() != "")
                        <input type="number" lang="en" value="{{ $product->stocks->first()->qty }}" step="1"
                            placeholder="{{translate('Quantity')}}" name="current_stock" class="form-control" required>
                        @else
                        <input type="number" lang="en"  required step="1"
                            placeholder="{{translate('Quantity')}}" name="current_stock" class="form-control" required>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">
                        {{translate('SKU')}}
                    </label>
                    <div class="col-md-6">
                    @if($product->stocks->first() != "")
                    <input type="text" placeholder="{{ translate('SKU') }}" value="{{ $product->stocks->first()->sku }}" name="sku" class="form-control">
                    @else
                    <input type="text" placeholder="{{ translate('SKU') }}" required  name="sku" class="form-control">
                    @endif
                    </div>
                </div>
            </div>
            <br>
            <div class="sku_combination" id="sku_combination">

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Product Description')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Description')}}</label>
                <div class="col-lg-9">
                    <textarea class="aiz-text-editor"
                        name="description">{{$product->getTranslation('description')}}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('PDF Specification')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('PDF Specification')}}</label>
                <div class="col-md-8">
                    <div class="input-group" data-toggle="aizuploader">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}
                            </div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="pdf" value="{{ $product->pdf }}" class="selected-files">
                    </div>
                    <div class="file-preview box sm">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('SEO Meta Tags')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Meta Title')}}</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}"
                        placeholder="{{translate('Meta Title')}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Description')}}</label>
                <div class="col-lg-8">
                    <textarea name="meta_description" rows="8"
                        class="form-control">{{ $product->meta_description }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Meta Images')}}</label>
                <div class="col-md-8">
                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}
                            </div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="meta_img" value="{{ $product->meta_img }}" class="selected-files">
                    </div>
                    <div class="file-preview box sm">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">{{translate('Slug')}}</label>
                <div class="col-lg-8">
                    <input type="text" placeholder="{{translate('Slug')}}" id="slug" name="slug"
                        value="{{ $product->slug }}" class="form-control">
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6" class="dropdown-toggle" data-toggle="collapse" data-target="#collapse_2">
                    {{translate('Shipping Configuration')}}
                </h5>
            </div>
            <div class="card-body collapse show" id="collapse_2">
                @if (get_setting('shipping_type') == 'product_wise_shipping')
                <div class="form-group row">
                    <label class="col-lg-6 col-from-label">{{translate('Free Shipping')}}</label>
                    <div class="col-lg-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="shipping_type" value="free" @if($product->shipping_type == 'free')
                            checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-6 col-from-label">{{translate('Flat Rate')}}</label>
                    <div class="col-lg-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="shipping_type" value="flat_rate" @if($product->shipping_type ==
                            'flat_rate') checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="flat_rate_shipping_div" style="display: none">
                    <div class="form-group row">
                        <label class="col-lg-6 col-from-label">{{translate('Shipping cost')}}</label>
                        <div class="col-lg-6">
                            <input type="number" lang="en" min="0" value="{{ $product->shipping_cost }}" step="0.01"
                                placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost"
                                class="form-control">
                        </div>
                    </div>
                </div>

                
                @else
                <p>
                    {{ translate('Shipping configuration is maintained by Admin.') }}
                </p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Low Stock Quantity Warning')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="name">
                        {{translate('Quantity')}}
                    </label>
                    <input type="number" name="low_stock_quantity" value="{{ $product->low_stock_quantity }}" min="0"
                        step="1" class="form-control">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">
                    {{translate('Stock Visibility State')}}
                </h5>
            </div>

            <div class="card-body">

                <div class="form-group row">
                    <label class="col-md-6 col-from-label">{{translate('Show Stock Quantity')}}</label>
                    <div class="col-md-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="stock_visibility_state" value="quantity"
                                @if($product->stock_visibility_state == 'quantity') checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-6 col-from-label">{{translate('Show Stock With Text Only')}}</label>
                    <div class="col-md-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="stock_visibility_state" value="text"
                                @if($product->stock_visibility_state == 'text') checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-6 col-from-label">{{translate('Hide Stock')}}</label>
                    <div class="col-md-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="stock_visibility_state" value="hide"
                                @if($product->stock_visibility_state == 'hide') checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div style="display: none" class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Cash On Delivery')}}</h5>
            </div>
            <div class="card-body">
                @if (get_setting('cash_payment') == '1')
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-6 col-from-label">{{translate('Status')}}</label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="cash_on_delivery" value="1"
                                        @if($product->cash_on_delivery == 1) checked @endif>
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <p>
                    {{ translate('Cash On Delivery activation is maintained by Admin.') }}
                </p>
                @endif
            </div>
        </div>

        <div style="display: none" class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Estimate Shipping Time')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="name">
                        {{translate('Shipping Days')}}
                    </label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="est_shipping_days"
                            value="{{ $product->est_shipping_days }}" min="1" step="1" placeholder="Shipping Days">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">Days</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none" class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('VAT & Tax')}}</h5>
            </div>
            <div class="card-body">
                @foreach(\App\Tax::where('tax_status', 1)->get() as $tax)
                <label for="name">
                    {{$tax->name}}
                    <input type="hidden" value="{{$tax->id}}" name="tax_id[]">
                </label>

                @php
                $tax_amount = 0;
                $tax_type = '';
                foreach($tax->product_taxes as $row) {
                if($product->id == $row->product_id) {
                $tax_amount = $row->tax;
                $tax_type = $row->tax_type;
                }
                }
                @endphp

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="number" lang="en" min="0" value="{{ $tax_amount }}" step="0.01"
                            placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control aiz-selectpicker" name="tax_type[]">
                            <option value="amount" @if($tax_type=='amount' ) selected @endif>
                                {{translate('Flat')}}
                            </option>
                            <option value="percent" @if($tax_type=='percent' ) selected @endif>
                                {{translate('Percent')}}
                            </option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="mar-all text-right">
            <button type="submit" name="button" value="publish"
                class="btn btn-primary">{{ translate('Update Product') }}</button>
        </div>
    </div>
    </div>
</form>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function (){
        show_hide_shipping_div();
    });

    $("[name=shipping_type]").on("change", function (){
        show_hide_shipping_div();
    });

    function show_hide_shipping_div() {
        var shipping_val = $("[name=shipping_type]:checked").val();

        $(".flat_rate_shipping_div").hide();
        
        if(shipping_val == 'flat_rate'){
            $(".flat_rate_shipping_div").show();
        }
    }


    function add_more_customer_choice_option(i, name){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'{{ route('products.add-more-choice-option') }}',
            data:{
               attribute_id: i
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#customer_choice_options').append('\
                <div class="form-group row">\
                    <div class="col-md-3">\
                        <input type="hidden" name="choice_no[]" value="'+i+'">\
                        <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="{{ translate('Choice Title') }}" readonly>\
                    </div>\
                    <div class="col-md-8">\
                        <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" multiple>\
                            '+obj+'\
                        </select>\
                    </div>\
                </div>');
                AIZ.plugins.bootstrapSelect('refresh');
           }
       });

        
    }

    $('input[name="colors_active"]').on('change', function() {
        if(!$('input[name="colors_active"]').is(':checked')){
            $('#colors').prop('disabled', true);
            AIZ.plugins.bootstrapSelect('refresh');
        }
        else{
            $('#colors').prop('disabled', false);
            AIZ.plugins.bootstrapSelect('refresh');
        }
        update_sku();
    });

    $(document).on("change", ".attribute_choice",function() {
        update_sku();
    });

    $('#colors').on('change', function() {
        update_sku();
    });

    function delete_row(em){
        $(em).closest('.form-group').remove();
        update_sku();
    }

    function delete_variant(em){
        $(em).closest('.variant').remove();
    }

    function update_sku(){
        $.ajax({
           type:"POST",
           url:'{{ route('products.sku_combination_edit') }}',
           data:$('#choice_form').serialize(),
           success: function(data){
               $('#sku_combination').html(data);
               AIZ.uploader.previewGenerate();
                AIZ.plugins.fooTable();
               if (data.length > 1) {
                   $('#show-hide-div').hide();
               }
               else {
                    $('#show-hide-div').show();
               }
           }
       });
    }

    AIZ.plugins.tagify();


    $(document).ready(function(){
        update_sku();

        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
    });

    $('#choice_attributes').on('change', function() {
        $.each($("#choice_attributes option:selected"), function(j, attribute){
            flag = false;
            $('input[name="choice_no[]"]').each(function(i, choice_no) {
                if($(attribute).val() == $(choice_no).val()){
                    flag = true;
                }
            });
            if(!flag){
                add_more_customer_choice_option($(attribute).val(), $(attribute).text());
            }
        });

        var str = @php echo $product->attributes @endphp;

        $.each(str, function(index, value){
            flag = false;
            $.each($("#choice_attributes option:selected"), function(j, attribute){
                if(value == $(attribute).val()){
                    flag = true;
                }
            });
            if(!flag){
                $('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
            }
        });

        update_sku();
    });


</script>
@endsection