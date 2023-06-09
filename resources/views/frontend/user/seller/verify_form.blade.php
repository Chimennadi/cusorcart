@extends('frontend.layouts.user_panel')

@section('panel_content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                    {{ translate('Shop Verification')}}
                    <a href="{{ route('shop.visit', $shop->slug) }}" class="btn btn-link btn-sm" target="_blank">({{ translate('Visit Shop')}} <i class="la la-external-link"></i>)</a>
                </h2>
            </div>
            <div class="col-md-6">
                <div class="float-md-right">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                        <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                        <li class="active"><a href="{{ route('shops.index') }}">{{ translate('Shop Settings')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form class="" action="{{ route('shop.verify.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-box bg-white mt-4">
            <div class="form-box-title px-3 py-2">
                {{ translate('Verification info')}}
            </div>
            @php
                $verification_form = get_setting('verification_form');
            @endphp
            <div class="form-box-content p-3">
                @foreach (json_decode($verification_form) as $key => $element)
                    @if ($element->type == 'text')
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ $element->label }} <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="{{ $element->type }}" class="form-control mb-3" placeholder="{{ $element->label }}" name="element_{{ $key }}" required>
                            </div>
                        </div>
                    @elseif($element->type == 'file')
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ $element->label }}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="{{ $element->type }}" name="element_{{ $key }}" id="file-{{ $key }}" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" required/>
                                <label for="file-{{ $key }}" class="mw-100 mb-3">
                                    <span></span>
                                    <strong>
                                        <i class="fa fa-upload"></i>
                                        {{ translate('Choose file')}}
                                    </strong>
                                </label>
                            </div>
                        </div>
                    @elseif ($element->type == 'select' && is_array(json_decode($element->options)))
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ $element->label }}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="element_{{ $key }}" required>
                                        @foreach (json_decode($element->options) as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @elseif ($element->type == 'multi_select' && is_array(json_decode($element->options)))
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ $element->label }}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="element_{{ $key }}[]" multiple required>
                                        @foreach (json_decode($element->options) as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @elseif ($element->type == 'radio')
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ $element->label }}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    @foreach (json_decode($element->options) as $value)
                                        <div class="radio radio-inline">
                                            <input type="radio" name="element_{{ $key }}" value="{{ $value }}" id="{{ $value }}" required>
                                            <label for="{{ $value }}">{{ $value }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
         </div>
        </div>
        <div class="text-right mt-4">
            <button type="submit" class="btn btn-primary">{{ translate('Apply')}}</button>
        </div>
    </form>
@endsection
