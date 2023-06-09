@extends('frontend.layouts.app')

@section('content')
<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Register My Shop')}}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('shops.create') }}">"{{ translate('Register My Shop')}}"</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="pt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <form id="shop" class="" action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (!Auth::check())
                        <div class="bg-white rounded shadow-sm mb-3">
                            <div class="fs-15 fw-600 p-3 border-bottom">
                                {{ translate('Personal Info')}}
                            </div>
                            <div class="p-3">
                                <div class="form-group">
                                    <label>{{ translate('Your Name')}} <span class="text-primary">*</span></label>
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Name') }}" name="name">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Your Email')}} <span class="text-primary">*</span></label>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                </div>
                                        <style>
                                            .field-icon {
                                                float: right;
                                                margin-left: -25px;
                                                margin-top: -26px;
                                                position: relative;
                                                z-index: 3;
                                                margin-right: 8px;
                                            }
                                        </style>
                                <div class="form-group">
                                    <label>{{ translate('Your Password')}} <span class="text-primary">*</span></label>
                                    <input id="password-field" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" aria-hidden="true"></span>
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Repeat Password')}} <span class="text-primary">*</span></label>
                                    <input id="password-field1" type="password" class="form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                    <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password1" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white rounded shadow-sm mb-4">
                        <div class="fs-15 fw-600 p-3 border-bottom">
                            {{ translate('Basic Info')}}
                        </div>
                        <div class="p-3">
                            <div class="form-group">
                                <label>{{ translate('Shop Name')}} <span class="text-primary">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ translate('Shop Name')}}" name="name" required>
                            </div>
                            <!-- <div class="form-group">
                                <label>{{ translate('Logo')}}</label>
                                <div class="custom-file">
                                    <label class="custom-file-label">
                                        <input type="file" class="custom-file-input" name="logo" accept="image/*">
                                        <span class="custom-file-name">{{ translate('Choose image') }}</span>
                                    </label>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label>{{ translate('Address')}} <span class="text-primary">*</span></label>
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Address')}}" name="address" required>
                            </div>
                        </div>
                    </div>

                    @if(get_setting('google_recaptcha') == 1)
                        <div class="form-group mt-2 mx-auto row">
                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                        </div>
                    @endif

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Register My Shop')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

 $(".toggle-password1").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    // making the CAPTCHA  a required field for form submission
    $(document).ready(function(){
        // alert('helloman');
        $("#shop").on("submit", function(evt)
        {
            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
                alert("please verify you are humann!");
                evt.preventDefault();
                return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#reg-form").submit();
        });
    });
</script>
@endsection
