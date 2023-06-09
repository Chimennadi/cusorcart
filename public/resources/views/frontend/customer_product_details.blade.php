@extends('frontend.layouts.app')
@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $customer_product->meta_title }}">
    <meta itemprop="description" content="{{ $customer_product->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($customer_product->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $customer_product->meta_title }}">
    <meta name="twitter:description" content="{{ $customer_product->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($customer_product->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($customer_product->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $customer_product->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $customer_product->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($customer_product->meta_img) }}" />
    <meta property="og:description" content="{{ $customer_product->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($customer_product->unit_price) }}" />
@endsection

@section('content')
    <section class="mb-4 pt-3">
        <div class="container">
            <div class="bg-white shadow-sm rounded p-3">
                <div class="row ">
                    <div class="col-xl-5 col-lg-6 mb-4">
                        <div class="sticky-top z-3 row gutters-10">
                            @if($customer_product->photos != null)
                                @php
                                    $photos = explode(',',$customer_product->photos);
                                @endphp
                                <div class="col order-1 order-md-2">
                                    <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true'>
                                        @foreach ($photos as $key => $photo)
                                        <div class="carousel-box img-zoom rounded">
                                            <img
                                                class="img-fluid lazyload"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto w-md-80px order-2 order-md-1 mt-3 mt-md-0">
                                    <div class="aiz-carousel product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-vertical-sm='false' data-focus-select='true'>
                                        @foreach ($photos as $key => $photo)
                                        <div class="carousel-box c-pointer border p-1 rounded">
                                            <img
                                                class="lazyload mw-100 size-60px mx-auto"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-6">
                        <div class="text-left">
                            <h1 class="mb-2 fs-20 fw-600">
                                {{ $customer_product->getTranslation('name') }}
                            </h1>

                            <div class="row no-gutters mt-3">
                                <div class="col-2">
                                    <div class="opacity-50 mt-2">{{ translate('Price')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div class="">
                                        <strong class="h2 fw-600 text-primary">
                                            {{ single_price($customer_product->unit_price) }}
                                        </strong>
                                        @if($customer_product->unit != null || $customer_product->unit != '')
                                            <span class="opacity-70">/{{ $customer_product->getTranslation('unit') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group rounded mt-5">
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center justify-content-center rounded-circle size-30px bg-soft-secondary mr-2">
                                            <i class="la la-user fs-18"></i>
                                        </span>
                                        <div class="flex-grow-1 fs-17 fw-600">
                                            {{ $customer_product->user->name }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center justify-content-center rounded-circle size-30px bg-soft-secondary mr-2">
                                            <i class="la la-map-marker fs-18"></i>
                                        </span>
                                        <div class="flex-grow-1 fs-17 fw-600">
                                            {{ $customer_product->location }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item c-pointer" onclick="show_number(this)">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center justify-content-center rounded-circle size-30px bg-primary text-white mr-2">
                                            <i class="la la-phone fs-18"></i>
                                        </span>
                                        <div class="flex-grow-1">
                                            <h3 class="h5 fw-700 mb-0">
                                                <span class="dummy">{{ str_replace(substr($customer_product->user->phone,3),'XXXXXXXX', $customer_product->user->phone) }}</span>
                                                <span class="real d-none">{{ $customer_product->user->phone }}</span>
                                            </h3>
                                            <p class="mb-0 opacity-50">{{ translate('Click to show phone number') }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="row no-gutters mt-5">
                                <div class="col-2">
                                    <div class="opacity-50 mt-2">{{ translate('Share')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div class="aiz-share"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container">
            <div class="bg-white mb-3 shadow-sm rounded">
                <div class="nav border-bottom aiz-nav-tabs">
                    <a href="#tab_default_1" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset active show">{{ translate('Description')}}</a>
                    @if($customer_product->video_link != null)
                        <a href="#tab_default_2" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Video')}}</a>
                    @endif
                    @if($customer_product->pdf != null)
                        <a href="#tab_default_3" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Downloads')}}</a>
                    @endif
                </div>

                <div class="tab-content pt-0">
                    <div class="tab-pane active show" id="tab_default_1">
                        <div class="p-4">
                            <div class="mw-100 overflow-hidden text-left">
                                <?php echo $customer_product->getTranslation('description'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_default_2">
                        <div class="p-4">
                            <div class="embed-responsive embed-responsive-16by9 mb-5">
                                @if ($customer_product->video_provider == 'youtube' && isset(explode('=', $customer_product->video_link)[1]))
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $customer_product->video_link)[1] }}"></iframe>
                                @elseif ($customer_product->video_provider == 'dailymotion' && isset(explode('video/', $customer_product->video_link)[1]))
                                    <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $customer_product->video_link)[1] }}"></iframe>
                                @elseif ($customer_product->video_provider == 'vimeo' && isset(explode('vimeo.com/', $customer_product->video_link)[1]))
                                    <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $customer_product->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_default_3">
                        <div class="p-4 text-center ">
                            <a href="{{ uploaded_asset($customer_product->pdf) }}" class="btn btn-primary">{{  translate('Download') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-4">
        <div class="container">
           <div class="bg-white shadow-sm rounded">
                <div class="d-flex mb-3 align-items-baseline border-bottom px-3 py-2">
                    <h3 class="fs-16 fw-600 mb-0">
                        {{ translate('Other Ads of') }} {{$customer_product->category->getTranslation('name') }}
                    </h3>
                    <a href="{{ route('customer_products.category', $customer_product->category->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                </div>
                <div class="p-3">
                    <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                        @php
                            $products = \App\CustomerProduct::where('category_id', $customer_product->category_id)->where('id', '!=', $customer_product->id)->where('status', '1')->where('published', '1')->limit(10)->get();
                        @endphp
                        @foreach ($products as $key => $product)
                        <div class="carousel-box">
                            <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                <div class="position-relative">
                                    <a href="{{ route('customer.product', $product->slug) }}" class="d-block">
                                        <img
                                            class="img-fit lazyload mx-auto h-140px h-md-210px"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                            alt="{{  $product->getTranslation('name')  }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                        >
                                    </a>
                                    <div class="absolute-top-left pt-2 pl-2">
                                        @if($product->conditon == 'new')
                                           <span class="badge badge-inline badge-success">{{translate('new')}}</span>
                                       @elseif($product->conditon == 'used')
                                           <span class="badge badge-inline badge-danger">{{translate('Used')}}</span>
                                       @endif
                                    </div>
                                </div>
                                <div class="p-md-3 p-2 text-left">
                                    <div class="fs-15 mb-1">
                                        <span class="fw-700 text-primary">{{ single_price($product->unit_price) }}</span>
                                    </div>
                                    <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                        <a href="{{ route('customer.product', $product->slug) }}" style="  display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="d-block text-reset">
                                            {{  $product->getTranslation('name')  }}
                                        </a>
                                    </h3>
                                </div>
                           </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    <script type="text/javascript">

        function show_number(el){
            $(el).find('.dummy').addClass('d-none');
            $(el).find('.real').removeClass('d-none').addClass('d-block');
        }

    </script>
@endsection
