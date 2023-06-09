    @extends('backend.layouts.app')

    @section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 ">{{translate('Paypal Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        <input type="hidden" name="payment_method" value="paypal">
                        @csrf
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYPAL_CLIENT_ID">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Paypal Client Id')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYPAL_CLIENT_ID" value="{{  env('PAYPAL_CLIENT_ID') }}" placeholder="{{ translate('Paypal Client ID') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYPAL_CLIENT_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Paypal Client Secret')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYPAL_CLIENT_SECRET" value="{{  env('PAYPAL_CLIENT_SECRET') }}" placeholder="{{ translate('Paypal Client Secret') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Paypal Sandbox Mode')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="paypal_sandbox" type="checkbox" @if (get_setting('paypal_sandbox') == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 ">{{translate('Stripe Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="stripe">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="STRIPE_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Stripe Key')}}</label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="STRIPE_KEY" value="{{  env('STRIPE_KEY') }}" placeholder="{{ translate('STRIPE KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="STRIPE_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Stripe Secret')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="STRIPE_SECRET" value="{{  env('STRIPE_SECRET') }}" placeholder="{{ translate('STRIPE SECRET') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header ">
                    <h5 class="mb-0 h6">{{translate('Bkash Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="bkash">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_APP_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('BKASH CHECKOUT APP KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="BKASH_CHECKOUT_APP_KEY" value="{{  env('BKASH_CHECKOUT_APP_KEY') }}" placeholder="{{translate('BKASH CHECKOUT APP KEY')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_APP_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('BKASH CHECKOUT APP SECRET')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="BKASH_CHECKOUT_APP_SECRET" value="{{  env('BKASH_CHECKOUT_APP_SECRET') }}" placeholder="{{translate('BKASH CHECKOUT APP SECRET')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_USER_NAME">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('BKASH CHECKOUT USER NAME')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="BKASH_CHECKOUT_USER_NAME" value="{{  env('BKASH_CHECKOUT_USER_NAME') }}" placeholder="{{translate('BKASH CHECKOUT USER NAME')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_PASSWORD">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('BKASH CHECKOUT PASSWORD')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="BKASH_CHECKOUT_PASSWORD" value="{{  env('BKASH_CHECKOUT_PASSWORD') }}" placeholder="{{translate('BKASH CHECKOUT PASSWORD')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Bkash Sandbox Mode')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="bkash_sandbox" type="checkbox" @if (get_setting('bkash_sandbox') == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 ">{{translate('Nagad Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="nagad">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_MODE">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('NAGAD MODE')}}</label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="NAGAD_MODE" value="{{  env('NAGAD_MODE') }}" placeholder="{{translate('NAGAD MODE')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_ID">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('NAGAD MERCHANT ID')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NAGAD_MERCHANT_ID" value="{{  env('NAGAD_MERCHANT_ID') }}" placeholder="{{translate('NAGAD MERCHANT ID')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_NUMBER">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('NAGAD MERCHANT NUMBER')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NAGAD_MERCHANT_NUMBER" value="{{  env('NAGAD_MERCHANT_NUMBER') }}" placeholder="{{translate('NAGAD MERCHANT NUMBER')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_PG_PUBLIC_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('NAGAD PG PUBLIC KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NAGAD_PG_PUBLIC_KEY" value="{{  env('NAGAD_PG_PUBLIC_KEY') }}" placeholder="{{translate('NAGAD PG PUBLIC KEY')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_PRIVATE_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('NAGAD MERCHANT PRIVATE KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NAGAD_MERCHANT_PRIVATE_KEY" value="{{  env('NAGAD_MERCHANT_PRIVATE_KEY') }}" placeholder="{{translate('NAGAD MERCHANT PRIVATE KEY')}}" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header ">
                    <h5 class="mb-0 h6">{{translate('Sslcommerz Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="sslcommerz">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="SSLCZ_STORE_ID">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Sslcz Store Id')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="SSLCZ_STORE_ID" value="{{  env('SSLCZ_STORE_ID') }}" placeholder="{{translate('Sslcz Store Id')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="SSLCZ_STORE_PASSWD">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Sslcz store password')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="SSLCZ_STORE_PASSWD" value="{{  env('SSLCZ_STORE_PASSWD') }}" placeholder="{{translate('Sslcz store password')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Sslcommerz Sandbox Mode')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="sslcommerz_sandbox" type="checkbox" @if (get_setting('sslcommerz_sandbox') == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 ">{{translate('RazorPay Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="razorpay">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="RAZOR_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('RAZOR KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="RAZOR_KEY" value="{{  env('RAZOR_KEY') }}" placeholder="{{ translate('RAZOR KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="RAZOR_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('RAZOR SECRET')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="RAZOR_SECRET" value="{{  env('RAZOR_SECRET') }}" placeholder="{{ translate('RAZOR SECRET') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 ">{{translate('Instamojo Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="instamojo">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="IM_API_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('API KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="IM_API_KEY" value="{{  env('IM_API_KEY') }}" placeholder="{{ translate('IM API KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="IM_AUTH_TOKEN">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('AUTH TOKEN')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="IM_AUTH_TOKEN" value="{{  env('IM_AUTH_TOKEN') }}" placeholder="{{ translate('IM AUTH TOKEN') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Instamojo Sandbox Mode')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="instamojo_sandbox" type="checkbox" @if (get_setting('instamojo_sandbox') == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 ">{{translate('PayStack Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="paystack">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYSTACK_PUBLIC_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('PUBLIC KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYSTACK_PUBLIC_KEY" value="{{  env('PAYSTACK_PUBLIC_KEY') }}" placeholder="{{ translate('PUBLIC KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYSTACK_SECRET_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('SECRET KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYSTACK_SECRET_KEY" value="{{  env('PAYSTACK_SECRET_KEY') }}" placeholder="{{ translate('SECRET KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MERCHANT_EMAIL">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('MERCHANT EMAIL')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MERCHANT_EMAIL" value="{{  env('MERCHANT_EMAIL') }}" placeholder="{{ translate('MERCHANT EMAIL') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYSTACK_CURRENCY_CODE">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('PAYSTACK CURRENCY CODE')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYSTACK_CURRENCY_CODE" value="{{  env('PAYSTACK_CURRENCY_CODE') }}" placeholder="{{ translate('PAYSTACK CURRENCY CODE') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 ">{{translate('Payhere Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="payhere">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYHERE_MERCHANT_ID">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('PAYHERE MERCHANT ID')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYHERE_MERCHANT_ID" value="{{  env('PAYHERE_MERCHANT_ID') }}" placeholder="{{ translate('PAYHERE MERCHANT ID') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYHERE_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('PAYHERE SECRET')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYHERE_SECRET" value="{{  env('PAYHERE_SECRET') }}" placeholder="{{ translate('PAYHERE SECRET') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYHERE_CURRENCY">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('PAYHERE CURRENCY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYHERE_CURRENCY" value="{{  env('PAYHERE_CURRENCY') }}" placeholder="{{ translate('PAYHERE CURRENCY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Payhere Sandbox Mode')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="payhere_sandbox" type="checkbox" @if (get_setting('payhere_sandbox') == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Ngenius Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="ngenius">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NGENIUS_OUTLET_ID">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('NGENIUS OUTLET ID')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="NGENIUS_OUTLET_ID" value="{{  env('NGENIUS_OUTLET_ID') }}" placeholder="{{ translate('NGENIUS OUTLET ID') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NGENIUS_API_KEY">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('NGENIUS API KEY')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="NGENIUS_API_KEY" value="{{  env('NGENIUS_API_KEY') }}" placeholder="{{ translate('NGENIUS API KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NGENIUS_CURRENCY">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('NGENIUS CURRENCY')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="NGENIUS_CURRENCY" value="{{  env('NGENIUS_CURRENCY') }}" placeholder="{{ translate('NGENIUS CURRENCY') }}" required>
                                <br>
                                <div class="alert alert-primary" role="alert">
                                    Currency must be <b>AED</b> or <b>USD</b> or <b>EUR</b><br>
                                    If kept empty, <b>AED</b> will be used automatically
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 ">{{translate('VoguePay Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="voguepay">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="VOGUE_MERCHANT_ID">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('MERCHANT ID')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="VOGUE_MERCHANT_ID" value="{{  env('VOGUE_MERCHANT_ID') }}" placeholder="{{ translate('MERCHANT ID') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Sandbox Mode')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="voguepay_sandbox" type="checkbox" @if (get_setting('voguepay_sandbox') == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Iyzico Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="iyzico">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="IYZICO_API_KEY">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('IYZICO_API_KEY')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="IYZICO_API_KEY" value="{{  env('IYZICO_API_KEY') }}" placeholder="{{ translate('IYZICO API KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="IYZICO_SECRET_KEY">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('IYZICO_SECRET_KEY')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="IYZICO_SECRET_KEY" value="{{  env('IYZICO_SECRET_KEY') }}" placeholder="{{ translate('IYZICO SECRET KEY') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('IYZICO Sandbox Mode')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="iyzico_sandbox" type="checkbox" @if (get_setting('iyzico_sandbox') == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('ProxyPay Credential')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="proxypay">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PROXYPAY_TOKEN">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('PROXYPAY_TOKEN')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="PROXYPAY_TOKEN" value="{{  env('PROXYPAY_TOKEN') }}" placeholder="{{ translate('PROXYPAY TOKEN') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PROXYPAY_ENTITY">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('PROXYPAY_ENTITY')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="PROXYPAY_ENTITY" value="{{  env('PROXYPAY_ENTITY') }}" placeholder="{{ translate('PROXYPAY_ENTITY') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PROXYPAY_END_TIME">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('PROXYPAY_END_TIME')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="PROXYPAY_END_TIME" value="{{  env('PROXYPAY_END_TIME') }}" placeholder="{{ translate('PROXYPAY_END_TIME') }}" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">
                                            {{translate('Days')}}
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label">{{translate('Sandbox Mode')}}</label>
                            </div>
                            <div class="col-md-8">
                                
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="proxypay_sandbox" type="checkbox" @if (get_setting('proxypay_sandbox') == 1) checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
