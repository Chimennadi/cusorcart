@extends('frontend.layouts.app')

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h3 fw-600">{{ translate('Reset Password') }}</h1>
                            <p class="mb-4">{{translate('Enter your phone, code and new password and confirm password.')}} </p>
                            <form method="POST" action="{{ route('password.update.phone') }}">
                                @csrf

                                <div class="form-group">
                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="phone" value="{{ $email ?? old('email') }}" placeholder="Phone" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="code" value="{{ $email ?? old('email') }}" placeholder="Code" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ translate('Reset Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
