@extends('frontend.layouts.app')

@section('content')
    <section class="pt-4 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="fw-600 h4">{{ translate('Affiliate Informations') }}</h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item opacity-50">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            <a class="text-reset" href="{{ route('affiliate.apply') }}">"{{ translate('Affiliate') }}"</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form class="" action="{{ route('affiliate.store_affiliate_user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (!Auth::check())
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">{{translate('User Info')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{ translate('Name') }}" name="name">
                                                    <span class="input-group-addon">
                                                        <i class="las la-user"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email">
                                                    <span class="input-group-addon">
                                                        <i class="las la-envelope"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password') }}" name="password">
                                                    <span class="input-group-addon">
                                                        <i class="las la-lock"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="password" class="form-control" placeholder="{{ translate('Confirm Password') }}" name="password_confirmation">
                                                    <span class="input-group-addon">
                                                        <i class=" las la-lock"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">{{translate('Verification info')}}</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $verification_form = \App\AffiliateConfig::where('type', 'verification_form')->first()->value;
                                @endphp
                                    @foreach (json_decode($verification_form) as $key => $element)
                                        @if ($element->type == 'text')
                                            <div class="row">
                                                <label class="col-md-2 col-form-label">{{ $element->label }} <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="{{ $element->type }}" class="form-control mb-3" placeholder="{{ $element->label }}" name="element_{{ $key }}" required>
                                                </div>
                                            </div>
                                        @elseif($element->type == 'file')
                                            <div class="row">
                                                <label class="col-md-2 col-form-label">{{ $element->label }}</label>
                                                <div class="col-md-10">
                                                    <input type="{{ $element->type }}" name="element_{{ $key }}" id="file-{{ $key }}" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" required/>
                                                    <label for="file-{{ $key }}" class="mw-100 mb-3">
                                                        <span></span>
                                                        <strong>
                                                            <i class="fa fa-upload"></i>
                                                            {{translate('Choose file')}}
                                                        </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        @elseif ($element->type == 'select' && is_array(json_decode($element->options)))
                                            <div class="row">
                                                <label class="col-md-2 col-form-label">{{ $element->label }}</label>
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
                                                <label class="col-md-2 col-form-label">{{ $element->label }}</label>
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
                                                <label class="col-md-2 col-form-label">{{ $element->label }}</label>
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
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
