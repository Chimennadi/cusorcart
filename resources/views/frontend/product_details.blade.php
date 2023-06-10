@php
$variantImages = [];
$defaultImages = [];
// dd($detailedProduct);
$vIids = [];
foreach ($detailedProduct->stocks as $key => $stock) {
$imgsToArray = explode(',', $stock->image);
$vIids=array_merge($vIids, $imgsToArray);
}
$vIids = array_unique($vIids);
$vIids = array_filter($vIids, function ($a) {
return ($a !== 0);
});
foreach ($vIids as $key => $image) {
$row = [];
$row += ['imageId' => $image, 'imageUrl' => uploaded_asset($image)];
$variantImages[] = $row;
}
// dd($variantImages);
$photos = explode(',', $detailedProduct->photos);
foreach ($photos as $key => $photo) {
$row = [];
$row += ['imageId' => $photo, 'imageUrl' => uploaded_asset($photo)];
$defaultImages[] = $row;
}
@endphp
@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}">
@section('meta_title'){{ $detailedProduct->meta_title }}@stop
@section('meta_description'){{ $detailedProduct->meta_description }}@stop
@section('meta_keywords'){{ $detailedProduct->tags }}@stop
@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
<meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
<meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
<meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
<meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
<meta name="twitter:label1" content="Price">
<!-- Open Graph data -->
<meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
<meta property="og:type" content="og:product" />
<meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
<meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
<meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
<meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
<meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
<meta property="product:price:currency" content="{{ \App\Currency::findOrFail(get_setting('system_default_currency'))->code }}" />
<meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection
<style>
    .measure-label-s{
    font-weight: bolder;
    }
</style>
<style>
    .addReadMore.showlesscontent .SecSec,
    .addReadMore.showlesscontent .readLess {
    display: none;
    }
    .addReadMore.showmorecontent .readMore {
    display: none;
    }
    .addReadMore .readMore,
    .addReadMore .readLess {
    font-weight: bold;
    margin-left: 2px;
    color: blue;
    cursor: pointer;
    }
    .addReadMoreWrapTxt.showmorecontent .SecSec,
    .addReadMoreWrapTxt.showmorecontent .readLess {
    display: block;
    }
    #chosen_price_div{
    display:none;
    }
</style>
@section('content')
<section class="mb-4 pt-3">
    <div class="container">
        <div class="bg-white shadow-sm rounded p-3">
            <div class="row">
                <div class="col-xl-5 col-lg-6 mb-4">
                    <div class="sticky-top z-3 row gutters-10">
                        <div class="col order-1 order-md-2">
                            <div class="aiz-carousel product-gallery" id="product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true'>
                                @foreach ($photos as $key => $photo)
                                <div class="carousel-box img-zoom rounded">
                                    <img
                                        role="presentation" 
                                        class="img-fluid lazyload"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($photo) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                        style="position: relative !important; height: 100% !important;">
                                </div>
                                @endforeach
                                {{-- @foreach ($detailedProduct->stocks as $key => $stock)
                                @if ($stock->image != null)
                                <div class="carousel-box img-zoom rounded">
                                    <img
                                        class="img-fluid lazyload"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($stock->image) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                        >
                                </div>
                                @endif
                                @endforeach --}}
                            </div>
                        </div>
                        <div class="col-12 col-md-auto w-md-80px order-2 order-md-1 mt-3 mt-md-0">
                            <div class="aiz-carousel product-gallery-thumb" id="product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-vertical-sm='false' data-focus-select='true' data-arrows='true'>
                                @foreach ($photos as $key => $photo)
                                <div class="carousel-box c-pointer border p-1 rounded">
                                    <img
                                        class="lazyload mw-100 size-50px mx-auto"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($photo) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                        >
                                </div>
                                @endforeach
                                {{-- @foreach ($detailedProduct->stocks as $key => $stock)
                                @if ($stock->image != null)
                                <div class="carousel-box c-pointer border p-1 rounded stock-image variant-{{ $stock->variant }}" data-variation="{{ $stock->variant }}">
                                    <img
                                        class="lazyload mw-100 size-50px mx-auto"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($stock->image) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                        >
                                </div>
                                @endif
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="text-left">
                        <h1 class="mb-2 fs-20 fw-600">
                            {{ $detailedProduct->getTranslation('name') }}
                        </h1>
                        <div class="row align-items-center">
                            <div class="col-12">
                                @php
                                $total = 0;
                                $total += $detailedProduct->reviews->count();
                                @endphp
                                <span class="rating">
                                {{ renderStarRating($detailedProduct->rating) }}
                                </span>
                                <span class="ml-1 opacity-50">({{ $total }} {{ translate('reviews') }})</span>
                            </div>
                            @if ($detailedProduct->est_shipping_days)
                            <div class="col-auto ml">
                                <small class="mr-2 opacity-50">{{ translate('Estimate Shipping Time') }}: </small>{{ $detailedProduct->est_shipping_days }} {{ translate('Days') }}
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <small class="mr-2 opacity-50">{{ translate('Sold by') }}: </small><br>
                                @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                                <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="text-reset">{{ $detailedProduct->user->shop->name }}</a>
                                @else
                                {{ translate('Cusorcart') }}
                                @endif
                            </div>
                            <!--@if (get_setting('conversation_system') == 1)-->
                            <!--    <div class="col-auto">-->
                            <!--        <button class="btn btn-sm btn-soft-primary" onclick="show_chat_modal()">{{ translate('Message Seller') }}</button>-->
                            <!--    </div>-->
                            <!--@endif-->
                        </div>
                        <hr>
                        @if (home_discounted_price($detailedProduct) != home_discounted_price($detailedProduct))
                        <div class="row no-gutters mt-3">
                            <div class="col-sm-2">
                                <div class="opacity-50 my-2">{{ translate('Price') }}:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="fs-20 opacity-60">
                                    <del>
                                    {{ home_discounted_price($detailedProduct) }}
                                    @if ($detailedProduct->unit != null)
                                    <span>/{{ $detailedProduct->getTranslation('unit') }}</span>
                                    @endif
                                    </del>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters my-2">
                            <div class="col-sm-2">
                                <div class="opacity-50">{{ translate('Discount Price') }}:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="">
                                    <strong class="h2 fw-600 text-primary">
                                    {{ home_discounted_price($detailedProduct) }}
                                    </strong>
                                    @if ($detailedProduct->unit != null)
                                    <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                    @endif
                                </div>
                                <p>
                                    @if (home_discounted_base_price($detailedProduct) !== '₦0.00')
                                    <del class="fw-600 opacity-50 mr-1">{{ home_discounted_base_price($detailedProduct) }}</del>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @else
                        <div class="row no-gutters mt-3">
                            <div class="col-sm-2">
                                <div class="opacity-50 my-2">{{ translate('Price') }}:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="">
                                    <strong class="h2 fw-600 text-primary">
                                    {{ home_discounted_price($detailedProduct) }}
                                    </strong>
                                    @if ($detailedProduct->unit != null)
                                    <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                    @endif
                                </div>
                                <p>
                                    @if (home_discounted_base_price($detailedProduct) !== '₦0.00')
                                    <del class="fw-600 opacity-50 mr-1">{{ home_discounted_base_price($detailedProduct) }}</del>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endif
                        @if (
                        \App\Addon::where('unique_identifier', 'club_point')->first() != null &&
                        \App\Addon::where('unique_identifier', 'club_point')->first()->activated &&
                        $detailedProduct->earn_point > 0)
                        <div class="row no-gutters mt-4">
                            <div class="col-sm-2">
                                <div class="opacity-50 my-2">{{ translate('Club Point') }}:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="d-inline-block rounded px-2 bg-soft-primary border-soft-primary border">
                                    <span class="strong-700">{{ $detailedProduct->earn_point }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <form id="option-choice-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                            <input type="hidden" name="neck_size" id="neck_size" value="0" class="form-control">
                            <input type="hidden" name="chest_size" id="chest_size" value="0" class="form-control">
                            <input type="hidden" name="sleeves_size" id="sleeves_size" value="0" class="form-control">
                            <input type="hidden" name="waist_size" id="waist_size" value="0" class="form-control">
                            <input type="hidden" name="shoulder_size" id="shoulder_size" class="form-control">
                            <input type="hidden" name="length_size" id="length_size" class="form-control">
                            <input type="hidden" name="knee_size" id="knee_size" class="form-control">
                            <input type="hidden" name="laps_size" id="laps_size" class="form-control">
                            <input type="hidden" name="size" id="leg_size" class="form-control">
                            <input type="hidden" name="gender" id="user_gender" class="form-control">
                            <input type="hidden" name="size_type" id="size_type" class="form-control">
                            @if ($detailedProduct->choice_options != null)
                            @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ \App\Attribute::find($choice->attribute_id)->getTranslation('name') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="aiz-radio-inline">
                                        @foreach ($choice->values as $key => $value)
                                        <label class="aiz-megabox pl-0 mr-2">
                                        <input
                                        type="radio"
                                        name="attribute_id_{{ $choice->attribute_id }}"
                                        value="{{ $value }}"
                                        @if ($key == 0) checked @endif
                                        >
                                        <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2">
                                        {{ $value }}
                                        </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @if (count(json_decode($detailedProduct->colors)) > 0)
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Color') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="aiz-radio-inline">
                                        <label role="button" class="aiz-megabox pl-0 mr-2" onclick="getImages()">
                                        <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                        <span class="size-30px d-inline-block rounded" style="">
                                        <img src="/assets/img/Alecive-Flatwoken-Apps-Gallery.svg" width="100%" style="vertical-align: unset;" alt="">
                                        </span>
                                        </span>
                                        {{-- <img src="/assets/img/Alecive-Flatwoken-Apps-Gallery.svg" class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2" alt=""> --}}
                                        </label>
                                        @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Color::where('code', $color)->first()->name }}">
                                        <input
                                        type="radio"
                                        name="color"
                                        value="{{ \App\Color::where('code', $color)->first()->name }}"
                                        {{-- @if ($key == 0) checked @endif --}}
                                        onclick="getColorVariants('{{ \App\Color::where('code', $color)->first()->name }}')"
                                        >
                                        <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                        <span class="size-30px d-inline-block rounded" style="background: {{ $color }};"></span>
                                        </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endif
                            <!-- Quantity + Add to cart -->
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Quantity') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="product-quantity d-flex align-items-center">
                                        <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                            <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" disabled="">
                                            <i class="las la-minus"></i>
                                            </button>
                                            <input type="number" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="10">
                                            <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                            <i class="las la-plus"></i>
                                            </button>
                                        </div>
                                        @php
                                        $qty = 0;
                                        foreach ($detailedProduct->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                        }
                                        @endphp
                                        <div class="avialable-amount opacity-60">
                                            @if ($detailedProduct->stock_visibility_state == 'quantity')
                                            (<span id="available-quantity">{{ $qty }}</span> {{ translate('available') }})
                                            @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                            (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if ($detailedProduct->size_chart)
                            <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">Tailoring Feature:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="product-price">
                                        <a type="button" data-toggle="modal" data-target="#exampleModal">
                                        See Details
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Size Chart</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img style="width: 100%;" src="{{ asset('public/images/Products/' . $detailedProduct->size_chart) }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Total Price') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="product-price">
                                        <strong id="chosen_price" class="h4 fw-600 text-primary">
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="mt-3">
                            <button type="button" class="btn btn-soft-primary mr-2 add-to-cart fw-600" onclick="addToCart()" style="background: #FC9F01; border-color: #FC9F01">
                            <i class="las la-shopping-bag"></i>
                            <span class="d-none d-md-inline-block"> {{ translate('Add to cart') }}</span>
                            </button>
                            <button type="button" class="btn btn-primary buy-now fw-600" onclick="buyNow()">
                            <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                            </button>
                            <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                            <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock') }}
                            </button>
                        </div>
                        <div class="d-table width-100 mt-3">
                            <div class="d-table-cell">
                                <!-- Add to wishlist button -->
                                <button type="button" class="btn pl-0 btn-link fw-600" onclick="addToWishList({{ $detailedProduct->id }})">
                                {{ translate('Add to wishlist') }}
                                </button>
                                <!-- Add to compare button -->
                                <!--<button type="button" class="btn btn-link btn-icon-left fw-600" onclick="addToCompare({{ $detailedProduct->id }})">-->
                                <!--    {{ translate('Add to compare') }}-->
                                <!--</button>-->
                                @if (Auth::check() &&
                                \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                                \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated &&
                                (\App\AffiliateOption::where('type', 'product_sharing')->first()->status ||
                                \App\AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) &&
                                Auth::user()->affiliate_user != null &&
                                Auth::user()->affiliate_user->status)
                                @php
                                if(Auth::check()){
                                if(Auth::user()->referral_code == null){
                                Auth::user()->referral_code = substr(Auth::user()->id.Str::random(10), 0, 10);
                                Auth::user()->save();
                                }
                                $referral_code = Auth::user()->referral_code;
                                $referral_code_url = URL::to('/product').'/'.$detailedProduct->slug."?product_referral_code=$referral_code";
                                }
                                @endphp
                                <div>
                                    <button type=button id="ref-cpurl-btn" class="btn btn-sm btn-secondary" data-attrcpy="{{ translate('Copied') }}" onclick="CopyToClipboard(this)" data-url="{{ $referral_code_url }}">{{ translate('Copy the Promote Link') }}</button>
                                </div>
                                @endif
                                @if ($detailedProduct->category_id == '253' || $detailedProduct->category_id == '384')
                                <button type="button" class="btn pl-0 btn-link fw-600" id="measurement_btn">
                                {{ translate('Made to Measurement') }} 
                                </button>
                                @endif
                            </div>
                        </div>
                        <!--Measurement Start-->
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                                $(document).ready(function(){
                                $("#measurement_btn").click(function(){
                                    $(".madetomeasure").toggle();
                                });
                                
                                
                                $("#neck").change(function(){
                                    var neck = $("#neck").val();
                                
                                    if(neck <= '18' && neck >'17'){
                                        $("#neck_size").val($("#neck").val());
                                        $("#neck_size1").text('X-Large');
                                    }else if(neck <= '17' && neck >'16'){
                                    $("#neck_size").val($("#neck").val());
                                    $("#neck_size1").text('Large');
                                    }else if(neck <= '16' && neck >'15'){
                                        $("#neck_size").val($("#neck").val());
                                        $("#neck_size1").text('Medium');
                                    }else if(neck <= '15'){
                                        $("#neck_size").val($("#neck").val());
                                        $("#neck_size1").text('Small');
                                    }else{
                                        $("#neck_size").val($("#neck").val());
                                        $("#neck_size1").text('XX-Large');
                                    }
                                });
                                
                                
                                $("#chest").change(function(){
                                    var neck = $("#chest").val();
                                    var neck_size = $("#neck_size").val();
                                    var chest_size = $("#chest_size").val();
                                    if(neck <= '49' && neck >'46'){
                                        $("#chest_size").val($("#chest").val());
                                        $("#chest_size1").text('X-Large');
                                
                                    }else if(neck <= '46' && neck >'43'){
                                    $("#chest_size").val($("#chest").val());
                                    $("#chest_size1").text('Large');
                                    }else if(neck <= '43' && neck >'40'){
                                        $("#chest_size").val($("#chest").val());
                                        $("#chest_size1").text('Medium');
                                    }else if(neck <= '40'){
                                        $("#chest_size").val($("#chest").val());
                                        $("#chest_size1").text('Small');
                                    }else{
                                        $("#chest_size").val($("#chest").val());
                                        $("#chest_size1").text('XX-Large');
                                    }
                                
                                });
                            
                                $("#sleeves").change(function(){
                                    var neck = $("#sleeves").val();
                                
                                    if(neck <= '37' && neck >'36'){
                                        $("#sleeves_size").val($("#sleeves").val());
                                        $("#sleeves_size1").text('X-Large');
                                    }else if(neck <= '36' && neck >'35'){
                                    $("#sleeves_size").val($("#sleeves").val());
                                    $("#sleeves_size1").text('Large');
                                    }else if(neck <= '35' && neck >'34'){
                                        $("#sleeves_size").val($("#sleeves").val());
                                        $("#sleeves_size1").text('Medium');
                                    }else if(neck <= '34'){
                                        $("#sleeves_size").val($("#sleeves").val());
                                        $("#sleeves_size1").text('Small');
                                    }else{
                                        $("#sleeves_size").val($("#sleeves").val());
                                        $("#sleeves_size1").text('XX-Large');
                                    }
                                });
                                
                                
                                
                                
                                $("#waist").change(function(){
                                    var neck = $("#waist").val();
                                
                                    if(neck <= '43' && neck >'38'){
                                        $("#waist_size").val($("#waist").val());
                                        $("#waist_size1").text('X-Large');
                                    }else if(neck <= '37' && neck >'35'){
                                    $("#waist_size").val($("#waist").val());
                                    $("#waist_size1").text('Large');
                                    }else if(neck <= '35' && neck >'32'){
                                        $("#waist_size").val($("#waist").val());
                                        $("#waist_size1").text('Medium');
                                    }else if(neck <= '32'){
                                        $("#waist_size").val($("#waist").val());
                                        $("#waist_size1").text('Small');
                                    }else{
                                        $("#waist_size").val($("#waist").val());
                                        $("#waist_size1").text('XX-Large');
                                    }
                                });
                                
                                
                                
                                
                                
                                
                                $("#shoulder").change(function(){
                                    var neck = $("#shoulder").val();
                                
                                    if(neck <= '43' && neck >'38'){
                                        $("#shoulder_size").val($("#shoulder").val());
                                        $("#shoulder_size1").text('X-Large');
                                    }else if(neck <= '37' && neck >'35'){
                                    $("#shoulder_size").val($("#shoulder").val());
                                    $("#shoulder_size1").text('Large');
                                    }else if(neck <= '35' && neck >'32'){
                                        $("#shoulder_size").val($("#shoulder").val());
                                        $("#shoulder_size1").text('Medium');
                                    }else if(neck <= '32'){
                                        $("#shoulder_size").val($("#shoulder").val());
                                        $("#shoulder_size1").text('Small');
                                    }else{
                                        $("#shoulder_size").val($("#shoulder").val());
                                        $("#shoulder_size1").text('XX-Large');
                                    }
                                });
                                
                                
                                
                                
                                
                                $("#length").change(function(){
                                    var neck = $("#length").val();
                                
                                    if(neck <= '43' && neck >'38'){
                                        $("#length_size").val($("#length").val());
                                        $("#length_size1").text('X-Large');
                                    }else if(neck <= '37' && neck >'35'){
                                    $("#length_size").val($("#length").val());
                                    $("#length_size1").text('Large');
                                    }else if(neck <= '35' && neck >'32'){
                                        $("#length_size").val($("#length").val());
                                        $("#length_size1").text('Medium');
                                    }else if(neck <= '32'){
                                        $("#length_size").val($("#length").val());
                                        $("#length_size1").text('Small');
                                    }else{
                                        $("#length_size").val($("#length").val());
                                        $("#length_size1").text('XX-Large');
                                    }
                                });
                                
                                
                                
                                
                                
                                
                                $("#knee").change(function(){
                                    var neck = $("#knee").val();
                                
                                    if(neck <= '43' && neck >'38'){
                                        $("#knee_size").val($("#knee").val());
                                        $("#knee_size1").text('X-Large');
                                    }else if(neck <= '37' && neck >'35'){
                                    $("#knee_size").val($("#knee").val());
                                    $("#knee_size1").text('Large');
                                    }else if(neck <= '35' && neck >'32'){
                                        $("#knee_size").val($("#knee").val());
                                        $("#knee_size1").text('Medium');
                                    }else if(neck <= '32'){
                                        $("#knee_size").val($("#knee").val());
                                        $("#knee_size1").text('Small');
                                    }else{
                                        $("#knee_size").val($("#knee").val());
                                        $("#knee_size1").text('XX-Large');
                                    }
                                });
                                
                                
                                
                                
                                
                                $("#laps").change(function(){
                                    var neck = $("#laps").val();
                                
                                    if(neck <= '43' && neck >'38'){
                                        $("#laps_size").val($("#laps").val());
                                        $("#laps_size1").text('X-Large');
                                    }else if(neck <= '37' && neck >'35'){
                                    $("#laps_size").val($("#laps").val());
                                    $("#laps_size1").text('Large');
                                    }else if(neck <= '35' && neck >'32'){
                                        $("#laps_size").val($("#laps").val());
                                        $("#laps_size1").text('Medium');
                                    }else if(neck <= '32'){
                                        $("#laps_size").val($("#laps").val());
                                        $("#laps_size1").text('Small');
                                    }else{
                                        $("#laps_size").val($("#laps").val());
                                        $("#laps_size1").text('XX-Large');
                                    }
                                });
                                
                                
                                $("#laps").change(function(){
                                    var neck = $("#laps").val();
                                
                                    if(neck <= '43' && neck >'38'){
                                        $("#laps_size").val($("#laps").val());
                                        $("#laps_size1").text('X-Large');
                                    }else if(neck <= '37' && neck >'35'){
                                    $("#laps_size").val($("#laps").val());
                                    $("#laps_size1").text('Large');
                                    }else if(neck <= '35' && neck >'32'){
                                        $("#laps_size").val($("#laps").val());
                                        $("#laps_size1").text('Medium');
                                    }else if(neck <= '32'){
                                        $("#laps_size").val($("#laps").val());
                                        $("#laps_size1").text('Small');
                                    }else{
                                        $("#laps_size").val($("#laps").val());
                                        $("#laps_size1").text('XX-Large');
                                    }
                                });
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            });
                            
                            
                        </script>
                        <script src="{{ url('/assets/js/shoes&slippers.js') }}"></script>
                        <div class="madetomeasure" style="display: none;">
                            <form>
                                <div class="row">
                                    @if ($detailedProduct->category_id == '384')
                                    <div class="iO-z" style="overflow: scroll">
                                        <div class="lO-z" style="width: 100%">
                                            <div>
                                                <label for="gender">Select your gender group</label>
                                                <select name="gender" id="gender" required>
                                                    <option selected="" value="" disabled="">Select Gender</option>
                                                    <option value="womens">Women's</option>
                                                    <option value="mens">Men's</option>
                                                    <option value="bigkids">Big Kids' (7 - 12 years)</option>
                                                    <option value="littlekids">Little Kids' (4 - 7 years)</option>
                                                    <option value="toddler">Toddlers' (9 month - 4 years)</option>
                                                    <option value="infant">Infants' (0 - 9 months)</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="typeOne">Select your shoe size country</label>
                                                <select name="size_type" id="select_size_type" required class="mO-z">
                                                    <option selected="" value="usac">US &amp; Canada</option>
                                                    <option value="uk">UK</option>
                                                    <option value="eur">Europe</option>
                                                    <option value="in">Inches</option>
                                                    <option value="cm">Centimeters</option>
                                                </select>
                                            </div>
                                            <div class="nO-z">
                                                <p>→</p>
                                            </div>
                                            <div>
                                                <label for="sizeOne">Select your shoe size number</label>
                                                <select  name="size" id="size" required>
                                                    <option selected="" value="" disabled="">Select Your Size</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div style="text-align: center;" class="form-group">
                                            <label class="measure-label-s" for="exampleInputEmail3">Top Measuremnt</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Neck*</label>
                                            <input type="number" name="neck" id="neck" class="form-control" placeholder="inches" required>
                                            <p id="neck_size1" class="text-red"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Shoulder*</label>
                                            <input type="number" name="shoulder" id="shoulder" class="form-control" placeholder="inches" required>
                                            <p id="shoulder_size1" class="text-red"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Sleeves*</label>
                                            <input type="number" name="sleeves" id="sleeves" class="form-control" placeholder="inches" required>
                                            <p id="sleeves_size1"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">R-sleeve*</label>
                                            <input type="number" name="r-sleeves" id="r-sleeves" class="form-control" placeholder="inches" required>
                                            <p id="sleeves_size1"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Chest*</label>
                                            <input type="number" name="chest" id="chest" class="form-control" placeholder="inches" required>
                                            <p id="chest_size1"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div style="text-align: center;" class="form-group">
                                            <label class="measure-label-s" for="exampleInputEmail3">Trouser Measurement</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Waist*</label>
                                            <input type="number" name="waist" id="waist" class="form-control" placeholder="inches" required>
                                            <p id="waist_size1"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Length*</label>
                                            <input type="number" name="length" id="length" class="form-control" placeholder="inches" required>
                                            <p id="length_size1"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Knee*</label>
                                            <input type="number" name="knee" id="knee" class="form-control" placeholder="inches" required>
                                            <p id="knee_size1"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Laps*</label>
                                            <input type="number" name="laps" id="laps" class="form-control" placeholder="inches" required>
                                            <p id="laps_size1"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">R-leg*</label>
                                            <input type="number" name="r-leg" id="r-leg" class="form-control" placeholder="inches" required>
                                            <p id="waist_size1"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">Anckle*</label>
                                            <input type="number" name="anckle" id="Anckle" class="form-control" placeholder="Anckle" required>
                                            <p id="knee_size1"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="measure-label" for="exampleInputEmail3">boot mouth(BM)*</label>
                                            <input type="number" name="laps" id="bm" class="form-control" placeholder="boot mouth(BM)" required>
                                            <p id="laps_size1"></p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--Measurement End-->
                        @php
                        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                        $refund_sticker = \App\BusinessSetting::where('type', 'refund_sticker')->first();
                        @endphp
                        @if ($refund_request_addon != null && $refund_request_addon->activated == 1 && $detailedProduct->refundable)
                        <div class="row no-gutters mt-4">
                            <div class="col-sm-2">
                                <div class="opacity-50 my-2">{{ translate('Refund') }}:</div>
                            </div>
                            <div class="col-sm-10">
                                <a href="{{ route('returnpolicy') }}" target="_blank">
                                @if ($refund_sticker != null && $refund_sticker->value != null)
                                <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" height="36">
                                @else
                                <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" height="36">
                                @endif
                                </a>
                                <a href="{{ route('returnpolicy') }}" class="ml-2" target="_blank">{{ translate('View Policy') }}</a>
                            </div>
                        </div>
                        @endif
                        <!--<div class="row no-gutters mt-4">-->
                        <!--    <div class="col-sm-2">-->
                        <!--        <div class="opacity-50 my-2">{{ translate('Share') }}:</div>-->
                        <!--    </div>-->
                        <!--    <div class="col-sm-10">-->
                        <!--        <div class="aiz-share"></div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mb-4">
    <div class="container">
        <div class="row gutters-10">
            <div class="col-xl-3 order-1 order-xl-0">
                <div class="bg-white shadow-sm mb-3">
                    <div class="position-relative p-3 text-left">
                        @if (
                        $detailedProduct->added_by == 'seller' &&
                        get_setting('vendor_system_activation') == 1 &&
                        $detailedProduct->user->seller->verification_status == 1)
                        <div class="absolute-top-right p-2 bg-white z-1">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" viewBox="0 0 287.5 442.2" width="22" height="34">
                                <polygon style="fill:#F8B517;" points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 "/>
                                <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8"/>
                                <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6"/>
                                <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                    60,116.6 124.1,116.6 "/>
                            </svg>
                        </div>
                        @endif
                        <div class="opacity-50 fs-12 border-bottom">{{ translate('Sold By') }}</div>
                        @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="text-reset d-block fw-600">
                        {{ $detailedProduct->user->shop->name }}
                        @if ($detailedProduct->user->seller->verification_status == 1)
                        <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                        @else
                        <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                        @endif
                        </a>
                        <!--<div class="location opacity-70">{{ $detailedProduct->user->shop->address }}</div>-->
                        @else
                        <div class="fw-600">{{ env('APP_NAME') }}</div>
                        @endif
                        <div class="text-center border rounded p-2 mt-3">
                            <div class="rating">
                                @if ($total > 0)
                                {{ renderStarRating($detailedProduct->rating / $total) }}
                                @else
                                {{ renderStarRating(0) }}
                                @endif
                            </div>
                            <div class="opacity-60 fs-12">({{ $total }} {{ translate('customer reviews') }})</div>
                        </div>
                    </div>
                    @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                    <div class="row no-gutters align-items-center border-top">
                        <div class="col">
                            <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="d-block btn btn-soft-primary rounded-0">{{ translate('Visit Store') }}</a>
                        </div>
                        <div class="col">
                            <ul class="social list-inline mb-0 d-none">
                                <li class="list-inline-item mr-0">
                                    <a href="{{ $detailedProduct->user->shop->facebook }}" class="facebook" target="_blank">
                                    <i class="lab la-facebook-f opacity-60"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="{{ $detailedProduct->user->shop->google }}" class="google" target="_blank">
                                    <i class="lab la-google opacity-60"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="{{ $detailedProduct->user->shop->twitter }}" class="twitter" target="_blank">
                                    <i class="lab la-twitter opacity-60"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ $detailedProduct->user->shop->youtube }}" class="youtube" target="_blank">
                                    <i class="lab la-youtube opacity-60"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="bg-white rounded shadow-sm mb-3">
                    <div class="p-3 border-bottom fs-16 fw-600">
                        {{ translate('Top Selling Products') }}
                    </div>
                    <div class="p-3">
                        <ul class="list-group list-group-flush">
                            @foreach (filter_products(
                            \App\Product::where('approved', 1)->where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'),
                            )->limit(6)->get() as $key => $top_product)
                            <li class="py-3 px-0 list-group-item border-light">
                                <div class="row gutters-10 align-items-center">
                                    <div class="col-5">
                                        <a href="{{ route('product', $top_product->slug) }}" class="d-block text-reset">
                                        <img
                                            class="img-fit lazyload h-xxl-110px h-xl-80px h-120px"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($top_product->thumbnail_img) }}"
                                            alt="{{ $top_product->getTranslation('name') }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </a>
                                    </div>
                                    <div class="col-7 text-left">
                                        <h4 class="fs-13 text-truncate-2">
                                            <a href="{{ route('product', $top_product->slug) }}" class="d-block text-reset">{{ $top_product->getTranslation('name') }}</a>
                                        </h4>
                                        <div class="rating rating-sm mt-1">
                                            {{ renderStarRating($top_product->rating) }}
                                        </div>
                                        <div class="mt-2">
                                            <span class="fs-17 fw-600 text-primary">{{ home_base_price($top_product) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 order-0 order-xl-1">
                <div class="bg-white mb-3 shadow-sm rounded">
                    <div class="nav border-bottom aiz-nav-tabs">
                        <a href="#tab_default_1" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset active show">{{ translate('Description') }}</a>
                        @if ($detailedProduct->video_link != null)
                        <a href="#tab_default_2" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Video') }}</a>
                        @endif
                        @if ($detailedProduct->pdf != null)
                        <a href="#tab_default_3" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Downloads') }}</a>
                        @endif
                        <a href="#tab_default_4" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Reviews') }}</a>
                    </div>
                    <div class="tab-content pt-0">
                        <div class="tab-pane fade active show" id="tab_default_1">
                            <div class="p-4">
                                <div class="mw-100 overflow-hidden text-left aiz-editor-data">
                                    <?php echo $detailedProduct->getTranslation('description'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_default_2">
                            <div class="p-4">
                                <div class="embed-responsive embed-responsive-16by9">
                                    @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                    @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                    <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                    @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                    <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_default_3">
                            <div class="p-4 text-center ">
                                <a href="{{ uploaded_asset($detailedProduct->pdf) }}" class="btn btn-primary">{{ translate('Download') }}</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_default_4">
                            <div class="p-4">
                                <ul class="list-group list-group-flush">
                                    @foreach ($detailedProduct->reviews as $key => $review)
                                    @if ($review->user != null)
                                    <li class="media list-group-item d-flex">
                                        <span class="avatar avatar-md mr-3">
                                        <img
                                        class="lazyload"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                        @if ($review->user->avatar_original != null)
                                        data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                        @else
                                        data-src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        @endif
                                        >
                                        </span>
                                        <div class="media-body text-left">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}</h3>
                                                <span class="rating rating-sm">
                                                @for ($i = 0; $i < $review->rating; $i++)
                                                <i class="las la-star active"></i>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                <i class="las la-star"></i>
                                                @endfor
                                                </span>
                                            </div>
                                            <div class="opacity-60 mb-2">{{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                                            <p class="comment-text">
                                                {{ $review->comment }}
                                            </p>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                                @if (count($detailedProduct->reviews) <= 0)
                                <div class="text-center fs-18 opacity-70">
                                    {{ translate('There have been no reviews for this product yet.') }}
                                </div>
                                @endif
                                @if (Auth::check())
                                @php
                                $commentable = false;
                                @endphp
                                @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                @if (
                                $orderDetail->order != null &&
                                $orderDetail->order->user_id == Auth::user()->id &&
                                $orderDetail->delivery_status == 'delivered' &&
                                \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                @php
                                $commentable = true;
                                @endphp
                                @endif
                                @endforeach
                                @if ($commentable)
                                <div class="pt-4">
                                    <div class="border-bottom mb-4">
                                        <h3 class="fs-17 fw-600">
                                            {{ translate('Write a review') }}
                                        </h3>
                                    </div>
                                    <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="text-uppercase c-gray-light">{{ translate('Your name') }}</label>
                                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="text-uppercase c-gray-light">{{ translate('Email') }}</label>
                                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="opacity-60">{{ translate('Rating') }}</label>
                                            <div class="rating rating-input">
                                                <label>
                                                <input type="radio" name="rating" value="1" required>
                                                <i class="las la-star"></i>
                                                </label>
                                                <label>
                                                <input type="radio" name="rating" value="2">
                                                <i class="las la-star"></i>
                                                </label>
                                                <label>
                                                <input type="radio" name="rating" value="3">
                                                <i class="las la-star"></i>
                                                </label>
                                                <label>
                                                <input type="radio" name="rating" value="4">
                                                <i class="las la-star"></i>
                                                </label>
                                                <label>
                                                <input type="radio" name="rating" value="5">
                                                <i class="las la-star"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="opacity-60">{{ translate('Comment') }}</label>
                                            <textarea class="form-control" rows="4" name="comment" placeholder="{{ translate('Your review') }}" required></textarea>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary mt-3">
                                            {{ translate('Submit review') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded shadow-sm za-related-products-wrap">
                    <div class="border-bottom p-3">
                        <h3 class="fs-16 fw-600 mb-0">
                            <span class="mr-4">{{ translate('Related products') }}</span>
                        </h3>
                    </div>
                    <div class="p-3">
                        <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="3" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                            @foreach (filter_products(
                            \App\Product::where('approved', 1)->where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id),
                            )->limit(10)->get() as $key => $related_product)
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="{{ route('product', $related_product->slug) }}" class="d-block">
                                        <img
                                            class="img-fit lazyload mx-auto h-140px h-md-210px"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($related_product->thumbnail_img) }}"
                                            alt="{{ $related_product->getTranslation('name') }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <h3 class="fw-600 fs-13">
                                            <a href="{{ route('product', $related_product->slug) }}" class="d-block text-reset">{{ $related_product->getTranslation('name') }}</a>
                                        </h3>
                                        <div class="rating rating-sm mt-1">
                                            {{ renderStarRating($related_product->rating) }}
                                        </div>
                                        <div class="fs-15">
                                            <!--@if (home_base_price($related_product) != home_discounted_base_price($related_product))-->
                                            <!--    <del class="fw-600 opacity-50 mr-1">{{ home_base_price($related_product) }}</del>-->
                                            <!--@endif-->
                                            <span class="fw-700 text-primary">{{ home_base_price($related_product) }}</span>
                                        </div>
                                        @if (
                                        \App\Addon::where('unique_identifier', 'club_point')->first() != null &&
                                        \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                        <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                            {{ translate('Club Point') }}:
                                            <span class="fw-700 float-right">{{ $related_product->earn_point }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('modal')
<div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="form-group">
                        <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary fw-600" data-dismiss="modal">{{ translate('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary fw-600">{{ translate('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">{{ translate('Login') }}</h6>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            @if (
                            \App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
                            \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                            <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone') }}" name="email" id="email">
                            @else
                            <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email">
                            @endif
                            @if (
                            \App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
                            \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                            <span class="opacity-60">{{ translate('Use country code before number') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password') }}">
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="aiz-checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class=opacity-60>{{ translate('Remember Me') }}</span>
                                <span class="aiz-square-check"></span>
                                </label>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?') }}</a>
                            </div>
                        </div>
                        <div class="mb-5">
                            <button type="submit" class="btn btn-primary btn-block fw-600">{{ translate('Login') }}</button>
                        </div>
                    </form>
                    <div class="text-center mb-3">
                        <p class="text-muted mb-0">{{ translate('Dont have an account?') }}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                    </div>
                    @if (get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                    <div class="separator mb-3">
                        <span class="bg-white px-3 opacity-60">{{ translate('Or Login With') }}</span>
                    </div>
                    <ul class="list-inline social colored text-center mb-5">
                        @if (get_setting('facebook_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                            <i class="lab la-facebook-f"></i>
                            </a>
                        </li>
                        @endif
                        @if (get_setting('google_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                            <i class="lab la-google"></i>
                            </a>
                        </li>
                        @endif
                        @if (get_setting('twitter_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                            <i class="lab la-twitter"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const stocks = {!! json_encode($detailedProduct->stocks) !!};
    const variantImages = {!! json_encode($variantImages) !!};
    const defaultImages ={!! json_encode($defaultImages) !!};
    console.log('defaultImages: ', defaultImages);
    const getUploadedImage = (id)=>{
        const data = variantImages.find(i=>i.imageId===id);
        console.log(id,data);
        return data.imageUrl;
    }
    const getUploadedImages = (id)=>{
        const data = variantImages.find(i=>i.imageId===id);
        return data.imageUrl;
    }
    const getColorVariants=(color)=>{
        const data = stocks.filter(i=> (i.variant).includes(color))[0],
        images=data.image.split(','),
        filteredImages=images.filter(i=>i!=='0'&&i!=='');
        console.log('images: ',filteredImages);
        const galleryThumb = filteredImages.map(item=>`<div class="carousel-box c-pointer border p-1 rounded stock-image">
                                                <img
                                                    class="lazyload mw-100 size-50px mx-auto"
                                                    src="/assets/img/placeholder.jpg"
                                                    data-src="${getUploadedImage(item)}"
                                                    onerror="this.onerror=null;this.src='/assets/img/placeholder.jpg';"
                                                >
                                            </div>`).join(''),
            galleryItems=filteredImages.map(item=>`<div class="carousel-box img-zoom rounded">
                                                <img
                                                    class="img-fluid lazyload"
                                                    src="/assets/img/placeholder.jpg"
                                                    data-src="${getUploadedImage(item)}"
                                                    onerror="this.onerror=null;this.src='/assets/img/placeholder.jpg';"
                                                >
                                            </div>`).join('')
    
    $('#product-gallery-thumb').html(galleryThumb);
    $('#product-gallery').html(galleryItems);
    $('#product-gallery-thumb').removeClass('slick-initialized').removeClass('slick-slider');
    $('#product-gallery').removeClass('slick-initialized').removeClass('slick-slider');
    
    
    setTimeout(() => {
    
    AIZ.plugins.slickCarousel();
    AIZ.plugins.noUiSlider();
    console.log('reloading slides');
    }, 1000);
    }
    const getImages=()=>{
        const galleryThumb = defaultImages.map(item=>`<div class="carousel-box c-pointer border p-1 rounded stock-image">
                                                <img
                                                    class="lazyload mw-100 size-50px mx-auto"
                                                    src="/assets/img/placeholder.jpg"
                                                    data-src="${item.imageUrl}"
                                                    onerror="this.onerror=null;this.src='/assets/img/placeholder.jpg';"
                                                >
                                            </div>`).join(''),
            galleryItems=defaultImages.map(item=>`<div class="carousel-box img-zoom rounded">
                                                <img
                                                    class="img-fluid lazyload"
                                                    src="/assets/img/placeholder.jpg"
                                                    data-src="${item.imageUrl}"
                                                    onerror="this.onerror=null;this.src='/assets/img/placeholder.jpg';"
                                                >
                                            </div>`)
    
    $('#product-gallery-thumb').html(galleryThumb);
    $('#product-gallery').html(galleryItems);
    $('#product-gallery-thumb').removeClass('slick-initialized').removeClass('slick-slider');
    $('#product-gallery').removeClass('slick-initialized').removeClass('slick-slider');
    
    setTimeout(() => {
    
    AIZ.plugins.slickCarousel();
    AIZ.plugins.noUiSlider();
    console.log('reloading slides');
    }, 1000);
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        getVariantPrice();
        AddReadMore();
    });
    function AddReadMore() {
    //This limit you can set after how much characters you want to show Read More.
    var carLmt = 500;
    // Text to show when text is collapsed
    var readMoreTxt = " ... Read More";
    // Text to show when text is expanded
    var readLessTxt = " Read Less";
    
    
    //Traverse all selectors with this class and manupulate HTML part to show Read More
    $(".addReadMore").each(function() {
        if ($(this).find(".firstSec").length)
            return;
    
        var allstr = $(this).text();
        if (allstr.length > carLmt) {
            var firstSet = allstr.substring(0, carLmt);
            var secdHalf = allstr.substring(carLmt, allstr.length);
            var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
            $(this).html(strtoadd);
        }
    
    });
    //Read More and Read Less Click Event binding
    $(document).on("click", ".readMore,.readLess", function() {
        $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
    });
    }
    
    function CopyToClipboard(e) {
        var url = $(e).data('url');
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(url).select();
        try {
            document.execCommand("copy");
            AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
        } catch (err) {
            AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
        }
        $temp.remove();
        // if (document.selection) {
        //     var range = document.body.createTextRange();
        //     range.moveToElementText(document.getElementById(containerid));
        //     range.select().createTextRange();
        //     document.execCommand("Copy");
    
        // } else if (window.getSelection) {
        //     var range = document.createRange();
        //     document.getElementById(containerid).style.display = "block";
        //     range.selectNode(document.getElementById(containerid));
        //     window.getSelection().addRange(range);
        //     document.execCommand("Copy");
        //     document.getElementById(containerid).style.display = "none";
    
        // }
        // AIZ.plugins.notify('success', 'Copied');
    }
    function show_chat_modal(){
        @if (Auth::check())
            $('#chat_modal').modal('show');
        @else
            $('#login_modal').modal('show'); @endif
        }



    $(document).ready(function(){
        $("#myModal").modal('show');
    });

    $(document).ready(function() {
        $('.category-nav-element').each(function(i, el) {
            $(el).on('mouseover', function(){
                if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                    $.post('/category/nav-element-list', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                        $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                    });
                }
            });
        });
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language',{_token: AIZ.data.csrf, locale:locale}, function(data){
                        location.reload();
                    });
    
                });
            });
        }
    
        if ($('#currency-change').length > 0) {
            $('#currency-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var currency_code = $this.data('currency');
                    $.post('/currency',{_token: AIZ.data.csrf, currency_code:currency_code}, function(data){
                        location.reload();
                    });
    
                });
            });
        }
    });
    
    $('#search').on('keyup', function(){
        search();
    });
    
    $('#search').on('focus', function(){
        search();
    });
    
    function search(){
        var searchKey = $('#search').val();
        if(searchKey.length > 0){
            $('body').addClass("typed-search-box-shown");
    
            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
            $.post('/ajax-search', { _token: AIZ.data.csrf, search:searchKey}, function(data){
                if(data == '0'){
                    // $('.typed-search-box').addClass('d-none');
                    $('#search-content').html(null);
                    $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                    $('.search-preloader').addClass('d-none');
    
                }
                else{
                    $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                    $('#search-content').html(data);
                    $('.search-preloader').addClass('d-none');
                }
            });
        }
        else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }
    
    
    $('#search1').on('keyup', function(){
        search1();
    });
    
    $('#search1').on('focus', function(){
        search1();
    });
    
    function search1(){
        var searchKey = $('#search1').val();
        if(searchKey.length > 0){
            $('body').addClass("typed-search-box-shown");
    
            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
            $.post('/ajax-search', { _token: AIZ.data.csrf, search:searchKey}, function(data){
                if(data == '0'){
                    // $('.typed-search-box').addClass('d-none');
                    $('#search1-content').html(null);
                    $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                    $('.search-preloader').addClass('d-none');
    
                }
                else{
                    $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                    $('#search1-content').html(data);
                    $('.search-preloader').addClass('d-none');
                }
            });
        }
        else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }
    
    
    
    function updateNavCart(){
        $.post('/cart/nav-cart-items', {_token: AIZ.data.csrf }, function(data){
            $('#cart_items').html(data);
        });
    }
    
    function removeFromCart(key){
        $.post('/cart/removeFromCart', {_token: AIZ.data.csrf, key:key}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
            AIZ.plugins.notify('success', 'Item has been removed from cart');
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
        });
    }
    
    function addToCompare(id){
        $.post('/compare/addToCompare', {_token: AIZ.data.csrf, id:id}, function(data){
            $('#compare').html(data);
            AIZ.plugins.notify('success', "Item has been added to compare list");
            $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
        });
    }
    
    function addToWishList(id){
        AIZ.plugins.notify('warning', "Please login first");
    }
    
    function showAddToCartModal(id){
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $('#addToCart-modal-body').html(null);
        $('#addToCart').modal();
        $('.c-preloader').show();
        $.post('/cart/show-cart-modal', {_token: AIZ.data.csrf, id:id}, function(data){
            $('.c-preloader').hide();
            $('#addToCart-modal-body').html(data);
            AIZ.plugins.slickCarousel();
            AIZ.plugins.zoom();
            AIZ.extra.plusMinus();
            getVariantPrice();
        });
    }
    
    $('#option-choice-form input').on('change', function(){
        getVariantPrice();
    });
    
    function getVariantPrice(){
        if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
            $.ajax({
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                type:"POST",
                url: '/product/variant_price',
                data: $('#option-choice-form').serializeArray(),
                success: function(data){
        
                        $('.product-gallery-thumb .carousel-box').each(function (i) {
                            if($(this).data('variation') && data.variation == $(this).data('variation')){
                                $('.product-gallery-thumb').slick('slickGoTo', i);
                            }
                        })
        
                    $('#option-choice-form #chosen_price_div').removeClass('d-none');
                    $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                    $('#available-quantity').html(data.quantity);
                    $('.input-number').prop('max', data.quantity);
                    if(parseInt(data.quantity) < 1 && data.digital  == 0){
                        $('.buy-now').hide();
                        $('.add-to-cart').hide();
                    }
                    else{
                        $('.buy-now').show();
                        $('.add-to-cart').show();
                    }
                }
            });
        }
    }
    
    function checkAddToCartValidity(){
        var names = {};
        $('#option-choice-form input:radio').each(function() { // find unique names
            names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function() { // then count them
            count++;
        });
    
        if($('#option-choice-form input:radio:checked').length == count){
            return true;
        }
    
        return false;
    }
    
    function addToCart(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url: '/cart/addtocart',
                data: $('#option-choice-form').serializeArray(),
                success: function(data){
                    $('#addToCart-modal-body').html(null);
                    $('.c-preloader').hide();
                    $('#modal-size').removeClass('modal-lg');
                    $('#addToCart-modal-body').html(data.view);
                    updateNavCart();
                    $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                }
            });
        }
        else{
            AIZ.plugins.notify('warning', 'Please choose all the options');
        }
    }
    
    function buyNow(){
        if(checkAddToCartValidity()) {
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url: '/cart/addtocart',
                data: $('#option-choice-form').serializeArray(),
                success: function(data){
                    if(data.status == 1){
                            updateNavCart();
                            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                            window.location.replace("/cart");
                    }
                    else{
                            $('#addToCart-modal-body').html(null);
                            $('.c-preloader').hide();
                            $('#modal-size').removeClass('modal-lg');
                            $('#addToCart-modal-body').html(data.view);
                    }
                }
            });
        }
        else{
            AIZ.plugins.notify('warning', 'Please choose all the options');
        }
    }
    
    function show_purchase_history_details(order_id)
    {
        $('#order-details-modal-body').html(null);
    
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
    
        $.post('/purchase_history/details', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }
    
    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);
    
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
    
        $.post('/orders/details', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }
    
    function cartQuantityInitialize(){
        $('.btn-number').click(function(e) {
            e.preventDefault();
    
            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
    
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
    
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }
    
                } else if (type == 'plus') {
    
                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }
    
                }
            } else {
                input.val(0);
            }
        });
    
        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });
    
        $('.input-number').change(function() {
    
            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
    
            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
    
    
        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }
    
    function imageInputInitialize(){
        $('.custom-input-file').each(function() {
            var $input = $(this),
                $label = $input.next('label'),
                labelVal = $label.html();

            $input.on('change', function(e) {
                var fileName = '';

                if (this.files && this.files.length > 1)
                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                else if (e.target.value)
                    fileName = e.target.value.split('\\').pop();

                if (fileName)
                    $label.find('span').html(fileName);
                else
                    $label.html(labelVal);
            });

            // Firefox bug fix
            $input
                .on('focus', function() {
                    $input.addClass('has-focus');
                })
                .on('blur', function() {
                    $input.removeClass('has-focus');
                });
        });
    }
    
</script>
<script type="text/javascript">
    function removeFromCartView(e, key) {
        e.preventDefault();
        removeFromCart(key);
    }
    
    function updateQuantity(key, element) {
        $.post('/cart/updateQuantity', {
            _token: 'I2bOSwvtGiNZboQMp33gCvPxHmoAjJgfCPytHgCE',
            id: key,
            quantity: element.value
        }, function(data) {
            updateNavCart();
            $('#cart-summary').html(data);
        });
    }
    
    function showCheckoutModal() {
        $('#GuestCheckout').modal();
    }
</script>
@endsection