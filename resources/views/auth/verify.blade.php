@extends('frontend.layouts.app')

@section('content')
<div class="py-6">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <div class="bg-white rounded shadow-sm p-4 text-left">
                    <h1 class="h3 fw-600 mb-3">{{ translate('Verify Your Email Address') }}</h1>
                    <p class="opacity-60">
                        {{ translate('Before proceeding, please check your email for a verification link.') }}
                        {{ translate('If you did not receive the email.') }}
                    </p>
                    <a href="{{ route('verification.resend') }}" class="btn btn-primary btn-block">{{ translate('Click here to request another') }}</a>
                    @if (session('resent'))
                        <div class="alert alert-success mt-2 mb-0" role="alert">
                            {{ translate('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
