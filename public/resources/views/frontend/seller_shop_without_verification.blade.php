@extends('frontend.layouts.app')

@section('meta_title'){{ $shop->meta_title }}@stop

@section('meta_description'){{ $shop->meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $shop->meta_title }}">
    <meta itemprop="description" content="{{ $shop->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($shop->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $shop->meta_title }}">
    <meta name="twitter:description" content="{{ $shop->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($shop->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $shop->meta_title }}" />
    <meta property="og:type" content="Shop" />
    <meta property="og:url" content="{{ route('shop.visit', $shop->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($shop->logo) }}" />
    <meta property="og:description" content="{{ $shop->meta_description }}" />
    <meta property="og:site_name" content="{{ $shop->name }}" />
@endsection

@section('content')

    @php
        $total = 0;
        $rating = 0;
        foreach ($shop->user->products as $key => $seller_product) {
            $total += $seller_product->reviews->count();
            $rating += $seller_product->reviews->sum('rating');
        }
    @endphp

    <section class="py-5 mb-4 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="d-flex justify-content-center">
                        <img
                            height="70"
                            class="lazyload"
                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="@if ($shop->logo !== null) {{ uploaded_asset($shop->logo) }} @else {{ static_asset('assets/img/placeholder.jpg') }} @endif"
                            alt="{{ $shop->name }}"
                        >
                        <div class="pl-4">
                            <h1 class="fw-600 h4 mb-0">{{ $shop->name }}
                                @if ($shop->user->seller->verification_status == 1)
                                    <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                @else
                                    <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                @endif
                            </h1>
                            <div class="rating rating-sm mb-1">
                                @if ($total > 0)
                                    {{ renderStarRating($rating/$total) }}
                                @else
                                    {{ renderStarRating(0) }}
                                @endif
                            </div>
                            <div class="location opacity-60">{{ $shop->address }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                    <div class="bg-white rounded shadow-sm p-4 text-center">
                        <h3 class="fw-600 h4">
                            {{$seller->user->name}} {{ translate('has not been verified yet.')}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
