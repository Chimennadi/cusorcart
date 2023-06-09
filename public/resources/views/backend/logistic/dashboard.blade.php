@extends('backend.layouts.app')

@section('content')
@if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
    <div class="">
        <div class="alert alert-danger d-flex align-items-center">
            {{translate('Please Configure SMTP Setting to work all email sending functionality')}},
            <a class="alert-link ml-2" href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
        </div>
    </div>
@endif

<div class="row gutters-10">
    <div class="col-lg-6">
        <div class="row gutters-10">
         
            <div class="col-6">
                <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Order') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Order::all()->count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-6">
                <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Product category') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Category::all()->count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
         
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row gutters-10">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">{{ translate('Products') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="pie-1" class="w-100" height="305"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">{{ translate('Sellers') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="pie-2" class="w-100" height="305"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="card">
    <div class="card-header">
        <h6 class="mb-0">{{ translate('Top 12 Products') }}</h6>
    </div>
    <div class="card-body">
        <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4" data-md-items="3" data-sm-items="2" data-arrows='true'>
            @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(12)->get() as $key => $product)
                <div class="carousel-box">
                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        <div class="position-relative">
                            <a href="{{ route('product', $product->slug) }}" class="d-block">
                                <img
                                    class="img-fit lazyload mx-auto h-210px"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    alt="{{  $product->getTranslation('name')  }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                            </a>
                        </div>
                        <div class="p-md-3 p-2 text-left">
                            <div class="fs-15">
                                @if(home_base_price($product) != home_discounted_base_price($product))
                                    <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>
                                @endif
                                <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                            </div>
                            <div class="rating rating-sm mt-1">
                                {{ renderStarRating($product->rating) }}
                            </div>
                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{ $product->getTranslation('name') }}</a>
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    AIZ.plugins.chart('#pie-1',{
        type: 'doughnut',
        data: {
            labels: [
                '{{translate('Total published products')}}',
                '{{translate('Total sellers products')}}',
                '{{translate('Total admin products')}}'
            ],
            datasets: [
                {
                    data: [
                        {{ \App\Product::where('published', 1)->get()->count() }},
                        {{ \App\Product::where('published', 1)->where('added_by', 'seller')->get()->count() }},
                        {{ \App\Product::where('published', 1)->where('added_by', 'admin')->get()->count() }}
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }
            ]
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
                position: 'bottom'
            }
        }
    });

    AIZ.plugins.chart('#pie-2',{
        type: 'doughnut',
        data: {
            labels: [
                '{{translate('Total sellers')}}',
                '{{translate('Total approved sellers')}}',
                '{{translate('Total pending sellers')}}'
            ],
            datasets: [
                {
                    data: [
                        {{ \App\Seller::all()->count() }},
                        {{ \App\Seller::where('verification_status', 1)->get()->count() }},
                        {{ \App\Seller::where('verification_status', 0)->count() }}
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }
            ]
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                labels: {
                    fontFamily: 'Montserrat',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
                position: 'bottom'
            }
        }
    });
    var sfs = {
            labels: [
                @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach
            ],
            datasets: [
                @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                {{ \App\Product::where('category_id', $category->id)->sum('num_of_sale') }},
                @endforeach
            ]
    }
    AIZ.plugins.chart('#graph-1',{
        type: 'bar',
        data: {
            labels: [
                @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach
            ],
            datasets: [{
                label: '{{ translate('Number of sale') }}',
                data: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        @php
                            $category_ids = \App\Utility\CategoryUtility::children_ids($category->id);
                            $category_ids[] = $category->id;
                        @endphp
                    {{ \App\Product::whereIn('category_id', $category_ids)->sum('num_of_sale') }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        'rgba(55, 125, 255, 0.4)',
                    @endforeach
                ],
                borderColor: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        'rgba(55, 125, 255, 1)',
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: '#f2f3f8',
                        zeroLineColor: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10
                    }
                }]
            },
            legend:{
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
            }
        }
    });
    AIZ.plugins.chart('#graph-2',{
        type: 'bar',
        data: {
            labels: [
                @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach
            ],
            datasets: [{
                label: '{{ translate('Number of Stock') }}',
                data: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        @php
                            $category_ids = \App\Utility\CategoryUtility::children_ids($category->id);
                            $category_ids[] = $category->id;

                            $products = \App\Product::whereIn('category_id', $category_ids)->get();
                            $qty = 0;
                            foreach ($products as $key => $product) {

                                foreach ($product->stocks as $key => $stock) {
                                    $qty += $stock->qty;
                                }


                            }
                        @endphp
                        {{ $qty }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        'rgba(253, 57, 149, 0.4)',
                    @endforeach
                ],
                borderColor: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        'rgba(253, 57, 149, 1)',
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: '#f2f3f8',
                        zeroLineColor: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10
                    }
                }]
            },
            legend:{
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
            }
        }
    });
</script>
@endsection
