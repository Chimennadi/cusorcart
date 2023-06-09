@extends('backend.layouts.app')

@section('content')

<style>
    #map{
            width: 100%;
            height: 250px;
        }
</style>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Payment Configuration')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="delivery_boy_payment_type">

                        <label class="col-md-4 col-from-label">
                            {{translate('Monthly Salary')}}
                        </label>
                        <div class="col-md-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="radio" name="delivery_boy_payment_type" value="salary" @if(get_setting('delivery_boy_payment_type') == 'salary') checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row" id="salary_div" style="display: none;">
                        <label class="col-sm-4 col-from-label">{{translate('Salary Amount')}}</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="types[]" value="delivery_boy_salary">
                            <div class="input-group">
                                <input type="number" name="delivery_boy_salary" class="form-control" value="{{ get_setting('delivery_boy_salary') ? get_setting('delivery_boy_salary') : "0" }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        {{ \App\Models\Currency::find(get_setting('system_default_currency'))->code }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-from-label">
                            {{translate('Per Order Commission')}}
                        </label>
                        <div class="col-md-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="radio" name="delivery_boy_payment_type" value="commission" @if(get_setting('delivery_boy_payment_type') == 'commission') checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row" id="commission_div" style="display: none;">
                        <label class="col-sm-4 col-from-label">{{translate('Commission Rate')}}</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="types[]" value="delivery_boy_commission">
                            <div class="input-group">
                                <input type="number" name="delivery_boy_commission" class="form-control" value="{{ get_setting('delivery_boy_commission') ? get_setting('delivery_boy_commission') : "0" }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        {{ \App\Models\Currency::find(get_setting('system_default_currency'))->code }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Notification Configuration')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="delivery_boy_mail_notification">

                        <label class="col-md-4 col-from-label">
                            {{translate('Send Mail')}}
                        </label>
                        <div class="col-md-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="delivery_boy_mail_notification" value="1" @if(get_setting('delivery_boy_mail_notification') == '1') checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="delivery_boy_otp_notification">

                        <label class="col-md-4 col-from-label">
                            {{translate('Send OTP')}}
                        </label>
                        <div class="col-md-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="delivery_boy_otp_notification" value="1" @if(get_setting('delivery_boy_otp_notification') == '1') checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Pickup Location For Delivery Boy')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (get_setting('google_map') == 1)
                        <div class="row">
                            <input id="searchInput" class="controls" type="text" placeholder="{{translate('Enter a location')}}">
                            <div id="map"></div>
                            <ul id="geoData">
                                <li style="display: none;">Full Address: <span id="location"></span></li>
                                <li style="display: none;">Postal Code: <span id="postal_code"></span></li>
                                <li style="display: none;">Country: <span id="country"></span></li>
                                <li style="display: none;">Latitude: <span id="lat"></span></li>
                                <li style="display: none;">Longitude: <span id="lon"></span></li>
                            </ul>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2" id="">
                                <label for="exampleInputuname">Longitude</label>
                            </div>
                            <div class="col-md-10" id="">
                                <input type="hidden" name="types[]" value="delivery_pickup_longitude">
                                <input type="text" class="form-control mb-3" id="longitude" name="delivery_pickup_longitude" readonly="" value="{{ get_setting('delivery_pickup_longitude') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2" id="">
                                <label for="exampleInputuname">Latitude</label>
                            </div>
                            <div class="col-md-10" id="">
                                <input type="hidden" name="types[]" value="delivery_pickup_latitude">
                                <input type="text" class="form-control mb-3" id="latitude" name="delivery_pickup_latitude" readonly="" value="{{ get_setting('delivery_pickup_latitude') }}">
                            </div>
                        </div>
                    @else
                        <div class="form-group row">
                            <div class="col-md-2" id="">
                                <label for="exampleInputuname">Longitude</label>
                            </div>
                            <div class="col-md-10" id="">
                                <input type="hidden" name="types[]" value="delivery_pickup_longitude">
                                <input type="text" class="form-control mb-3" id="longitude" name="delivery_pickup_longitude" value="{{ get_setting('delivery_pickup_longitude') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2" id="">
                                <label for="exampleInputuname">Latitude</label>
                            </div>
                            <div class="col-md-10" id="">
                                <input type="hidden" name="types[]" value="delivery_pickup_latitude">
                                <input type="text" class="form-control mb-3" id="latitude" name="delivery_pickup_latitude" value="{{ get_setting('delivery_pickup_latitude') }}">
                            </div>
                        </div>
                    @endif
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</div>

@endsection

@section('script')
    <script type="text/javascript">

    (function($) {
        "use strict";
        $(document).ready(function (){
            show_hide_div();
        })

        $("[name=delivery_boy_payment_type]").on("change", function (){
            show_hide_div();
        });

        function show_hide_div() {
            $("#salary_div").hide();
            $("#commission_div").hide();
            if($("[name=delivery_boy_payment_type]:checked").val() == 'salary'){
                $("#salary_div").show();
            }
            if($("[name=delivery_boy_payment_type]:checked").val() == 'commission'){
                $("#commission_div").show();
            }
        }
    })(jQuery);

    </script>

    @if (get_setting('google_map') == 1)
        
        {{-- @include('frontend.partials.google_map') --}}
        
    @endif
@endsection
