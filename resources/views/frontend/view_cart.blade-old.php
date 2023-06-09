@extends('frontend.layouts.app')

@section('content')

<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row aiz-steps arrow-divider">
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-4" id="cart-summary">
    <div class="container">
        {{-- @if( Session::has('cart') && count(Session::get('cart')) > 0 ) --}}
        @if( $carts && count($carts) > 0 )
            <div class="row">
                <div class="col-xxl-8 col-xl-10 mx-auto">
                    <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
                        <div class="mb-4">
                            <div class="row gutters-5 d-none d-lg-flex border-bottom mb-3 pb-3">
                                <div class="col-md-5 fw-600">{{ translate('Product')}}</div>
                                <div class="col fw-600">{{ translate('Price')}}</div>
                                <div class="col fw-600">{{ translate('Tax')}}</div>
                                <div class="col fw-600">{{ translate('Quantity')}}</div>
                                <div class="col fw-600">{{ translate('Total')}}</div>
                                <div class="col-auto fw-600">{{ translate('Remove')}}</div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @php
                                $total = 0;
                                @endphp
                                @foreach ($carts as $key => $cartItem)
                                    @php
                                    $product = \App\Product::find($cartItem['product_id']);
                                    $total = $total + ($cartItem['price'] * $cartItem['quantity']) + $cartItem['tax'];
                                    $product_name_with_choice = $product->getTranslation('name');
                                    if ($cartItem['variation'] != null) {
                                        $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                                    }
                                    @endphp
                                    <li class="list-group-item px-0 px-lg-3">
                                        <div class="row gutters-5">
                                            <div class="col-lg-5 d-flex">
                                                <span class="mr-2 ml-0">
                                                    <img
                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        class="img-fit size-60px rounded"
                                                        alt="{{  $product->getTranslation('name')  }}"
                                                    >
                                                </span>
                                                <span class="fs-14 opacity-60">{{ $product_name_with_choice }}</span>
                                            </div>

                                            <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Price')}}</span>
                                                <span class="fw-600 fs-16">{{ home_base_price($product) }}</span>
                                            </div>
                                            <div class="col-lg col-4 order-2 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Tax')}}</span>
                                                <span class="fw-600 fs-16">{{ single_price($cartItem['tax']) }}</span>
                                            </div>

                                            <div class="col-lg col-6 order-4 order-lg-0">
                                                @if($cartItem['digital'] != 1)
                                                    <div class="row no-gutters align-items-center aiz-plus-minus mr-2 ml-0">
                                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                            <i class="las la-minus"></i>
                                                        </button>
                                                        <input type="number" name="quantity[{{ $cartItem['id'] }}]" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="10" onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                            <i class="las la-plus"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Total')}}</span>
                                                <span class="fw-600 fs-16 text-primary">{{ single_price(home_base_price1($product) +  $cartItem['tax'] * $cartItem['quantity']) }}</span>
                                            </div>
                                            <div class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                                <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }})" class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="px-3 py-2 mb-4 border-top d-flex justify-content-between">
                            <span class="opacity-60 fs-15">{{translate('Subtotal')}}</span>
                            <span class="fw-600 fs-17">{{ single_price($total) }}</span>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                                <a href="{{ route('home') }}" class="btn btn-link">
                                    <i class="las la-arrow-left"></i>
                                    {{ translate('Return to shop')}}
                                </a>
                            </div>
                            <div class="col-md-6 text-center text-md-right">
                                @if(Auth::check())
                                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary fw-600">
                                        {{ translate('Continue to Shipping')}}
                                    </a>
                                @else
                                    <button class="btn btn-primary fw-600" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="shadow-sm bg-white p-4 rounded">
                        <div class="text-center p-3">
                            <i class="las la-frown la-3x opacity-60 mb-3"></i>
                            <h3 class="h4 fw-700">{{translate('Your Cart is empty')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection

@section('modal')
    <div class="modal fade" id="GuestCheckout">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                            </div>
                        </form>

                    </div>
                    <div class="text-center mb-3">
                        <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                    </div>
                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                        </div>
                        <ul class="list-inline social colored text-center mb-3">
                            @if (get_setting('facebook_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                            @if(get_setting('google_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                        <i class="lab la-google"></i>
                                    </a>
                                </li>
                            @endif
                            @if (get_setting('twitter_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function removeFromCartView(e, key){
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element){
            $.post('{{ route('cart.updateQuantity') }}', { 
                _token   :  '{{ csrf_token() }}', 
                id       :  key, 
                quantity :  element.value
            }, function(data){
                updateNavCart();
                $('#cart-summary').html(data);
            });
        }

        function showCheckoutModal(){
            $('#GuestCheckout').modal();
        }
    </script>
@endsection
