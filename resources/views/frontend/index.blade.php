@extends('frontend.layouts.app')
@section('content')
<style>
    .row-class {
    width: 20%;
    }
    .shadow-md {
    text-decoration: none;
    color: white !important;
    }
    .shadow-sm {
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%) !important;
    height: 100%;
    }
    @media(max-width:991px){
    .row-class {
    width: 100%;
    }
    }
</style>
{{-- Categories , Sliders . Today's deal --}}
<div class="home-banner-area mb-4 pt-3">
    <div class="container">
        <div class="row gutters-10 position-relative">
            <!--                <div class="col-lg-3 position-static d-none d-lg-block">-->
            <!--                    @include('frontend.partials.category_menu')-->
            <!--                    <div class="bg-soft-primary rounded-top p-3 d-flex align-items-center justify-content-center">-->
            <!--    <span class="fw-600 fs-16 mr-2 text-truncate">-->
            <!--        Todays Deal-->
            <!--    </span>-->
            <!--    <span class="badge badge-primary badge-inline">Hot</span>-->
            <!--</div>-->
            <!--<div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true" data-infinite="true">-->
            <!--                                <div class="carousel-box">-->
            <!--                                    <a href="#" class="d-block p-2 text-reset bg-white h-130 rounded" tabindex="-1">-->
            <!--                        <div class="row gutters-5 align-items-center">-->
            <!--                            <div class="col-xxl">-->
            <!--                                <div class="img">-->
            <!--                                    <img class="img-fit h-140px h-lg-110px ls-is-cached lazyloaded" src="https://welcometraders.com/public/uploads/all/pIxwDjNNEldG5KO891tfF75HeMK8ddzUqZq0oLxB.jpg" data-src="https://welcometraders.com/public/uploads/all/pIxwDjNNEldG5KO891tfF75HeMK8ddzUqZq0oLxB.jpg" alt="Immune Support Plus Probiotic Gummies, Assorted Fruit Flavors, 42/Bottle" onerror="this.onerror=null;this.src='https://welcometraders.com/public/assets/img/placeholder.jpg';">-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="col-xxl">-->
            <!--                                <div class="fs-16">-->
            <!--                                    <span class="d-block text-primary fw-600">$35.00</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </a>-->
            <!--                                </div>-->
            <!--                                 <div class="carousel-box">-->
            <!--                                    <a href="#" class="d-block p-2 text-reset bg-white h-130 rounded" tabindex="-1">-->
            <!--                        <div class="row gutters-5 align-items-center">-->
            <!--                            <div class="col-xxl">-->
            <!--                                <div class="img">-->
            <!--                                    <img class="img-fit h-140px h-lg-110px ls-is-cached lazyloaded" src="https://welcometraders.com/public/uploads/all/pIxwDjNNEldG5KO891tfF75HeMK8ddzUqZq0oLxB.jpg" data-src="https://welcometraders.com/public/uploads/all/pIxwDjNNEldG5KO891tfF75HeMK8ddzUqZq0oLxB.jpg" alt="Immune Support Plus Probiotic Gummies, Assorted Fruit Flavors, 42/Bottle" onerror="this.onerror=null;this.src='https://welcometraders.com/public/assets/img/placeholder.jpg';">-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="col-xxl">-->
            <!--                                <div class="fs-16">-->
            <!--                                    <span class="d-block text-primary fw-600">$35.00</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </a>-->
            <!--                                </div>-->
            <!--                        </div>-->
            <!--                </div>-->
            @php
            $num_todays_deal = count(filter_products(\App\Product::where('published', 1)->where('todays_deal', 1 ))->get());
            $featured_categories = \App\Category::where('featured', 1)->get();
            @endphp
            <div class="@if($num_todays_deal > 0) col-lg-12 @else col-lg-12 @endif">
                @if (get_setting('home_slider_images') != null)
                <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true" data-infinite="true">
                    @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                    @foreach ($slider_images as $key => $value)
                    <div class="carousel-box">
                        <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                        <img
                        class="d-block mw-100 img-fit rounded shadow-sm"
                        src="{{ uploaded_asset($slider_images[$key]) }}"
                        alt="{{ env('APP_NAME')}} promo"
                        @if(count($featured_categories) == 0)
                        height="457"
                        @else
                        height="315"
                        @endif
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                        >
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
                <!--                    <ul class="list-unstyled mb-0 row gutters-5">-->
                <!--    <li class="minw-0 col-3 col-md mt-3">-->
                <!--        <a href="#" class="d-block rounded bg-white p-2 text-reset shadow-sm">-->
                <!--            <img src="https://welcometraders.com/public/uploads/all/KZJIJtUCyxF1FlYdu9nawjkBlLYmxC9VE31b4ZNT.jpg" data-src="https://welcometraders.com/public/uploads/all/KZJIJtUCyxF1FlYdu9nawjkBlLYmxC9VE31b4ZNT.jpg" alt="Office" class="img-fit lazyloaded" height="78" onerror="this.onerror=null;this.src='https://welcometraders.com/public/assets/img/placeholder-rect.jpg';">-->
                <!--            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Office</div>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--    <li class="minw-0 col-4 col-md mt-3">-->
                <!--        <a href="#" class="d-block rounded bg-white p-2 text-reset shadow-sm">-->
                <!--            <img src="https://welcometraders.com/public/uploads/all/BxZT1nkFsj7UevRfGjZazdVwcKKF23tjpVDxHoPV.jpg" data-src="https://welcometraders.com/public/uploads/all/BxZT1nkFsj7UevRfGjZazdVwcKKF23tjpVDxHoPV.jpg" alt="Technology" class="img-fit lazyloaded" height="78" onerror="this.onerror=null;this.src='https://welcometraders.com/public/assets/img/placeholder-rect.jpg';">-->
                <!--            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Technology</div>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--    <li class="minw-0 col-4 col-md mt-3">-->
                <!--        <a href="#" class="d-block rounded bg-white p-2 text-reset shadow-sm">-->
                <!--            <img src="https://welcometraders.com/public/uploads/all/ArWUciQYM3OVERiISngXsl5pZy4ylNbGYmGet7OF.jpg" data-src="https://welcometraders.com/public/uploads/all/ArWUciQYM3OVERiISngXsl5pZy4ylNbGYmGet7OF.jpg" alt="Food Service" class="img-fit lazyloaded" height="78" onerror="this.onerror=null;this.src='https://welcometraders.com/public/assets/img/placeholder-rect.jpg';">-->
                <!--            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Food Service</div>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--    <li class="minw-0 col-4 col-md mt-3">-->
                <!--        <a href="#" class="d-block rounded bg-white p-2 text-reset shadow-sm">-->
                <!--            <img src="https://welcometraders.com/public/uploads/all/vIJczJT3QdrtbpCQtIRhU3PRkE0MC1J3kQnrzXyw.jpg" data-src="https://welcometraders.com/public/uploads/all/vIJczJT3QdrtbpCQtIRhU3PRkE0MC1J3kQnrzXyw.jpg" alt="Furniture" class="img-fit lazyloaded" height="78" onerror="this.onerror=null;this.src='https://welcometraders.com/public/assets/img/placeholder-rect.jpg';">-->
                <!--            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Furniture</div>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--    <li class="minw-0 col-4 col-md mt-3">-->
                <!--        <a href="#" class="d-block rounded bg-white p-2 text-reset shadow-sm">-->
                <!--            <img src="https://welcometraders.com/public/uploads/all/skwXlaXffEXWvGKeupyeAJMMVwjaTYVH3eVfRtA7.jpg" data-src="https://welcometraders.com/public/uploads/all/skwXlaXffEXWvGKeupyeAJMMVwjaTYVH3eVfRtA7.jpg" alt="Industrial" class="img-fit ls-is-cached lazyloaded" height="78" onerror="this.onerror=null;this.src='https://welcometraders.com/public/assets/img/placeholder-rect.jpg';">-->
                <!--            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Industrial</div>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--    <li class="minw-0 col-4 col-md mt-3">-->
                <!--        <a href="#" class="d-block rounded bg-white p-2 text-reset shadow-sm">-->
                <!--            <img src="https://welcometraders.com/public/uploads/all/cguXvlVJ1PUgeKegU3vVrGxBJ7b4kVkmYBgVGgeZ.jpg" data-src="https://welcometraders.com/public/uploads/all/cguXvlVJ1PUgeKegU3vVrGxBJ7b4kVkmYBgVGgeZ.jpg" alt="Janitorial &amp; Sanitation" class="img-fit ls-is-cached lazyloaded" height="78" onerror="this.onerror=null;this.src='https://welcometraders.com/public/assets/img/placeholder-rect.jpg';">-->
                <!--            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Janitorial &amp; Sanitation</div>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--</ul>-->
                @if (count($featured_categories) > 0)
                <!--<ul class="list-unstyled mb-0 row gutters-5">-->
                <!--    @foreach ($featured_categories as $key => $category)-->
                <!--        <li class="minw-0 col-4 col-md mt-3">-->
                <!--            <a href="{{ route('products.category', $category->slug) }}" class="d-block rounded bg-white p-2 text-reset shadow-sm">-->
                <!--                <img-->
                <!--                    src="{{ static_asset('assets/img/placeholder.jpg') }}"-->
                <!--                    data-src="{{ uploaded_asset($category->banner) }}"-->
                <!--                    alt="{{ $category->getTranslation('name') }}"-->
                <!--                    class="lazyload img-fit"-->
                <!--                    height="78"-->
                <!--                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"-->
                <!--                >-->
                <!--                <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">{{ $category->getTranslation('name') }}</div>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    @endforeach-->
                <!--</ul>-->
                @endif
            </div>
            {{-- Top 10 categories and Brands --}}
            <section style="width: 100%;" class="mb-4 mt-4">
                <div class="container">
                    <div class="row gutters-10">
                        @if (get_setting('top10_categories') != null)
                        <div class="col-lg-12">
                            <div class="d-flex mb-3 align-items-baseline border-bottom">
                                <h3 class="h5 fw-700 mb-0 fs-16">
                                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Categories') }}</span>
                                </h3>
                                <a href="{{ route('categories.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Categories') }}</a>
                            </div>
                            <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
                            <style>
                                .swiper {
                                width: 100%;
                                height: 100%;
                                }
                                .swiper-slide {
                                text-align: center;
                                font-size: 18px;
                                background: #fff;
                                /* Center slide text vertically */
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: -webkit-flex;
                                display: flex;
                                -webkit-box-pack: center;
                                -ms-flex-pack: center;
                                -webkit-justify-content: center;
                                justify-content: center;
                                -webkit-box-align: center;
                                -ms-flex-align: center;
                                -webkit-align-items: center;
                                align-items: center;
                                }
                                .swiper-slide img {
                                display: block;
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                                }
                            </style>
                            <div class="row gutters-5">
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        @php $top10_categories = json_decode(get_setting('top10_categories')); @endphp
                                        @foreach ($top10_categories as $key => $value)
                                        @php $category = \App\Category::find($value); @endphp
                                        @if ($category != null)
                                        <div class="swiper-slide">
                                            <a href="{{ route('products.category', $category->slug) }}" class="bg-white border d-block w-100 text-reset rounded p-2 hov-shadow-md">
                                                <div class="row align-items-center no-gutters">
                                                    <div class="col-12 text-center">
                                                        <img style="width: 100%;height: 125px;"
                                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                            data-src="{{ uploaded_asset($category->banner) }}"
                                                            alt="{{ $category->getTranslation('name') }}"
                                                            class="img-fluid img lazyload h-60px"
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                                            >
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="text-truncat-2 pl-3 fs-14 fw-600 text-center">{{ $category->getTranslation('name') }}</div>
                                                    </div>
                                                    <!--<div class="col-2 text-center">-->
                                                    <!--    <i class="la la-angle-right text-primary"></i>-->
                                                    <!--</div>-->
                                                </div>
                                            </a>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <br>
                                <br><br><br><br>
                                <br>
                                <br><br><br><br>
                                <br><br><br>
                                <div class="swiper-pagination"></div>
                                @php
                                $agent = new \Jenssegers\Agent\Agent;
                                $result = $agent->isDesktop();
                                @endphp
                                <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
                                <!-- Initialize Swiper -->
                                <script>
                                    var swiper = new Swiper(".mySwiper", {
                                        slidesPerView: 2,
                                        spaceBetween: 5,
                                        // Responsive breakpoints
                                        breakpoints: {
                                            // when window width is >= 320px
                                            320: {
                                            slidesPerView: 2,
                                            },
                                            // when window width is >= 640px
                                            640: {
                                            slidesPerView: 4,
                                            },
                                            // when window width is >= 992px
                                            992: {
                                            slidesPerView: 5,
                                            }
                                        },
                                        pagination: {
                                            el: ".swiper-pagination",
                                            clickable: true,
                                        },
                                    });
                                </script>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
{{-- Banner section 1 --}}
@if (get_setting('home_banner1_images') != null)
<div class="mb-4">
    <div class="container">
        <div class="row gutters-10">
            @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
            @foreach ($banner_1_imags as $key => $value)
            <div class="col-xl col-md-6">
                <div class="mb-3 mb-lg-0">
                    <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset">
                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
{{-- Flash Deal --}}
@php
$flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
@endphp
@if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
<section class="mb-4">
    <div class="container">
        <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
            <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                <h3 class="h5 fw-700 mb-0">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Flash Sale') }}</span>
                </h3>
                <div class="aiz-count-down ml-auto ml-lg-3 align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
            </div>
            <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                @php
                $product = \App\Product::find($flash_deal_product->product_id);
                @endphp
                @if ($product != null && $product->published != 0)
                <div class="carousel-box">
                    <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                        <div class="position-relative">
                            <a href="{{ route('product', $product->slug) }}" class="d-block">
                            <img
                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                alt="{{  $product->getTranslation('name')  }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                            </a>
                            <div class="absolute-top-right aiz-p-hov-icon">
                                <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                                <i class="la la-heart-o"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                                <i class="las la-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-md-3 p-2 text-left">
                            d-flex mb-3 align-items-baseline border-bottom
                            <div class="rating rating-sm mt-1">
                                {{ renderStarRating($product->rating) }}
                            </div>
                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                <a href="{{ route('product', $product->slug) }}" style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="d-block text-reset">
                                {{  $product->getTranslation('name')  }}
                                </a>
                            </h3>
                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                            <div class="rounded px-2 mt-1 bg-soft-primary border-soft-primary border">
                                {{ translate('Club Point') }}:
                                <span class="fw-700 float-right">{{ $product->earn_point }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
{{-- Featured Section --}}
<div id="section_featured">
</div>
{{-- Best Selling  --}}
<div id="section_best_selling">
</div>
{{-- Banner Section 2 --}}
@if (get_setting('home_banner2_images') != null)
<div class="mb-4">
    <div class="container">
        <div class="row gutters-10">
            @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
            @foreach ($banner_2_imags as $key => $value)
            <div class="col-xl col-md-6">
                <div class="mb-3 mb-lg-0">
                    <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset">
                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_2_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
{{-- Category wise Products --}}
<div id="section_home_categories">
</div>
{{-- Classified Product --}}
@if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
@php
$classified_products = \App\CustomerProduct::where('status', '1')->where('published', '1')->take(10)->get();
@endphp
@if (count($classified_products) > 0)
<section class="mb-4">
    <div class="container">
        <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
            <div class="d-flex mb-3 align-items-baseline border-bottom">
                <h3 class="h5 fw-700 mb-0">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Classified Ads') }}</span>
                </h3>
                <a href="{{ route('customer.products') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
            </div>
            <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                @foreach ($classified_products as $key => $classified_product)
                <div class="carousel-box">
                    <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                        <div class="position-relative">
                            <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block">
                            <img
                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($classified_product->thumbnail_img) }}"
                                alt="{{ $classified_product->getTranslation('name') }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                            </a>
                            <div class="absolute-top-left pt-2 pl-2">
                                @if($classified_product->conditon == 'new')
                                <span class="badge badge-inline badge-success">{{translate('new')}}</span>
                                @elseif($classified_product->conditon == 'used')
                                <span class="badge badge-inline badge-danger">{{translate('Used')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-md-3 p-2 text-left">
                            <div class="fs-15 mb-1">
                                <span class="fw-700 text-primary"></span>
                            </div>
                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block text-reset">{{ $classified_product->getTranslation('name') }}</a>
                            </h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@endif
{{-- Banner Section 2 --}}
@if (get_setting('home_banner3_images') != null)
<div class="mb-4">
    <div class="container">
        <div class="row gutters-10">
            @php $banner_3_imags = json_decode(get_setting('home_banner3_images')); @endphp
            @foreach ($banner_3_imags as $key => $value)
            <div class="col-xl col-md-6">
                <div class="mb-3 mb-lg-0">
                    <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}" class="d-block text-reset">
                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_3_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
{{-- Best Seller --}}
@if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
<div id="section_best_sellers">
</div>
@endif
{{-- Top 10 categories and Brands --}}
<section class="mb-4">
    <div class="container">
        <div class="row gutters-10">
            @if (get_setting('top10_categories') != null)
            <div class="col-lg-12">
                <div class="d-flex mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Brands') }}</span>
                    </h3>
                    <a href="{{ route('brands.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Brands') }}</a>
                </div>
                <div class="row gutters-5">
                    @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
                    @foreach ($top10_brands as $key => $value)
                    @php $brand = \App\Brand::find($value); @endphp
                    @if ($brand != null)
                    <div class="col-md-1-5 row-class">
                        <a href="{{ route('products.brand', $brand->slug) }}" class="bg-white border d-block text-reset rounded p-2 hov-shadow-md mb-2">
                            <div class="row align-items-center no-gutters">
                                <div class="col-4 text-center">
                                    <img
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($brand->logo) }}"
                                        alt="{{ $brand->getTranslation('name') }}"
                                        class="img-fluid img lazyload h-60px"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                        >
                                </div>
                                <div class="col-6">
                                    <div class="text-truncate-2 pl-3 fs-14 fw-600 text-left">{{ $brand->getTranslation('name') }}</div>
                                </div>
                                <div class="col-2 text-center">
                                    <i class="la la-angle-right text-primary"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!--newsletter-->
<!--   <div id="myModal" class="modal fade">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-content position-relative border-0 rounded-0">-->
<!--                    <div class="aiz-editor-data">-->
<!--                        <p><img src="https://demo.activeitzone.com/ecommerce/public/uploads/all/dwaK3um8tkVgEsgmZN1peQb844tFRAIQ1wAS8e3z.png" style="width: 100%;"></p><p style="text-align: center; "><br></p><h2 style="text-align: center; "><b>Subscribe to Our Newsletter</b></h2><p style="text-align: center;">Subscribe our newsletter for coupon, offer and exciting promotional discount..</p>-->
<!--                    </div>-->
<!--                                            <div class="pb-5 pt-4 px-5">-->
<!--                            <form class="" method="POST" action="/subscribers">-->
<!--                                @csrf-->
<!--                             <div class="form-group mb-0">-->
<!--                                    <input type="email" class="form-control" placeholder="Your Email Address" name="email" required>-->
<!--                                </div>-->
<!--                                <button type="submit" class="btn btn-primary btn-block mt-3">-->
<!--                                    Subscribe Now-->
<!--                                </button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                         <button class="absolute-top-right bg-white shadow-lg btn btn-circle btn-icon mr-n3 mt-n3 set-session"  data-dismiss="modal">-->
<!--                        <i class="la la-close fs-20"></i>-->
<!--                    </button>-->
<!--                </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--newsletter-->
@endsection
@section('script')
<script>
    localStorage.setItem('#myModal',true);
    localStorage.getItem('#myModal');
    
    $(document).ready(function(){
        $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#section_featured').html(data);
            AIZ.plugins.slickCarousel();
        });
        $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#section_best_selling').html(data);
            AIZ.plugins.slickCarousel();
        });
        $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#section_home_categories').html(data);
            AIZ.plugins.slickCarousel();
        });
    
        @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
        $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#section_best_sellers').html(data);
            AIZ.plugins.slickCarousel();
        });
        @endif
    });
</script>
@endsection