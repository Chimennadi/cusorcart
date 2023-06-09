@extends('frontend.layouts.app')

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 mx-auto">
                    <div class="card">
                        <div class="text-center pt-5">
                            <h1 class="h2 fw-600">
                                {{translate('Phone Verification')}}
                            </h1>
                            <p>Verification code has been sent. Please wait a few minutes.</p>
                            <a href="{{ route('verification.phone.resend') }}" class="btn btn-link">{{translate('Resend Code')}}</a>
                        </div>
                        <div class="px-5 py-lg-5">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg">
                                    <form class="form-default" role="form" action="{{ route('verification.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="form-control" name="verification_code">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">{{ translate('Verify') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
