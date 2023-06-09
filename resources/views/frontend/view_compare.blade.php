@extends('frontend.layouts.app')

@section('content')

<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Compare')}}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('compare.reset') }}">"{{ translate('Compare')}}"</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="mb-4">
    <div class="container text-left">
        <div class="bg-white shadow-sm rounded">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <div class="fs-15 fw-600">{{ translate('Comparison')}}</div>
                <a href="{{ route('compare.reset') }}" style="text-decoration: none;" class="btn btn-soft-primary btn-sm fw-600">{{ translate('Reset Compare List')}}</a>
            </div>
            @if(Session::has('compare'))
                @if(count(Session::get('compare')) > 0)
                    <div class="p-3">
                        <table class="table table-responsive table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:16%" class="font-weight-bold">
                                        {{ translate('Name')}}
                                    </th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        <th scope="col" style="width:28%" class="font-weight-bold">
                                            <a class="text-reset fs-15" href="{{ route('product', \App\Product::find($item)->slug) }}">{{ \App\Product::find($item)->getTranslation('name') }}</a>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{ translate('Image')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        <td>
                                            <img loading="lazy" src="{{ uploaded_asset(\App\Product::find($item)->thumbnail_img) }}" alt="{{ translate('Product Image') }}" class="img-fluid py-4">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">{{ translate('Price')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        @php
                                            $product = \App\Product::find($item);
                                        @endphp
                                        <td>
                                            @if(home_base_price($product) != home_discounted_base_price($product))
                                                <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>
                                            @endif
                                            <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">{{ translate('Brand')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        <td>
                                            @if (\App\Product::find($item)->brand != null)
                                                {{ \App\Product::find($item)->brand->getTranslation('name') }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">{{ translate('Sub Sub Category')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        <td>
                                            @if (\App\Product::find($item)->subsubcategory != null)
                                                {{ \App\Product::find($item)->subsubcategory->getTranslation('name') }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        <td class="text-center py-4">
                                            <button type="button" class="btn btn-primary fw-600" onclick="showAddToCartModal({{ $item }})">
                                                {{ translate('Add to cart')}}
                                            </button>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            @else
                <div class="text-center p-4">
                    <p class="fs-17">{{ translate('Your comparison list is empty')}}</p>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
