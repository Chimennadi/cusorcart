@extends('backend.layouts.app')

@section('content')
    <h4 class="text-center text-muted">{{translate('Activate OTP')}}</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('Nexmo OTP')}}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'nexmo')" @if(\App\OtpConfiguration::where('type', 'nexmo')->first()->value == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('Twillo OTP')}}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'twillo')" @if(\App\OtpConfiguration::where('type', 'twillo')->first()->value == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('SSL Wireless OTP')}}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'ssl_wireless')" @if(\App\OtpConfiguration::where('type', 'ssl_wireless')->first()->value == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('Fast2SMS OTP')}}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'fast2sms')" @if(App\OtpConfiguration::where('type', 'fast2sms')->first() != null && \App\OtpConfiguration::where('type', 'fast2sms')->first()->value == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('MIMO OTP')}}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'mimo')" @if(App\OtpConfiguration::where('type', 'mimo')->first() != null && \App\OtpConfiguration::where('type', 'mimo')->first()->value == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-center text-muted mt-4">{{translate('OTP will be Used For')}}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('Order Placement')}}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'otp_for_order')" @if(\App\OtpConfiguration::where('type', 'otp_for_order')->first()->value == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('Delivery Status Changing Time')}}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'otp_for_delivery_status')" @if(\App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('Paid Status Changing Time')}}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'otp_for_paid_status')" @if(\App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type){
            if($(el).is(':checked')){
                var value = 1;
            }
            else{
                var value = 0;
            }
            $.post('{{ route('otp_configurations.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == '1'){
                    AIZ.plugins.notify('success', '{{ translate('Settings updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
