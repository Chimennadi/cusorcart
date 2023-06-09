@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="fs-18 mb-0 text-center">{{translate('S3 File System Credentials')}}</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                        <input type="hidden" name="payment_method" value="paypal">
                        @csrf
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="AWS_ACCESS_KEY_ID">
                            <div class="col-lg-4">
                                <label class="control-label">{{translate('AWS_ACCESS_KEY_ID')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="AWS_ACCESS_KEY_ID" value="{{  env('AWS_ACCESS_KEY_ID') }}" placeholder="{{ translate('AWS_ACCESS_KEY_ID') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="AWS_SECRET_ACCESS_KEY">
                            <div class="col-lg-4">
                                <label class="control-label">{{translate('AWS_SECRET_ACCESS_KEY')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="AWS_SECRET_ACCESS_KEY" value="{{  env('AWS_SECRET_ACCESS_KEY') }}" placeholder="{{ translate('AWS_SECRET_ACCESS_KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="AWS_DEFAULT_REGION">
                            <div class="col-lg-4">
                                <label class="control-label">{{translate('AWS_DEFAULT_REGION')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="AWS_DEFAULT_REGION" value="{{  env('AWS_DEFAULT_REGION') }}" placeholder="{{ translate('AWS_DEFAULT_REGION') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="AWS_BUCKET">
                            <div class="col-lg-4">
                                <label class="control-label">{{translate('AWS_BUCKET')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="AWS_BUCKET" value="{{  env('AWS_BUCKET') }}" placeholder="{{ translate('AWS_BUCKET') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="AWS_URL">
                            <div class="col-lg-4">
                                <label class="control-label">{{translate('AWS_URL')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="AWS_URL" value="{{  env('AWS_URL') }}" placeholder="{{ translate('AWS_URL') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-primary" type="submit">{{translate('Save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="fs-18 mb-0 text-center">{{translate('S3 File System Activation')}}</h3>
                </div>
                <div class="card-body">
                    <label class="aiz-switch mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'FILESYSTEM_DRIVER')" <?php if(env('FILESYSTEM_DRIVER') == 's3') echo "checked";?>>
                        <span></span>
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
            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
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
