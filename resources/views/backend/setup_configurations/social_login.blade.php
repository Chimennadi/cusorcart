@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Google Login Credential')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="col-from-label">{{translate('Client ID')}}</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="GOOGLE_CLIENT_ID" value="{{  env('GOOGLE_CLIENT_ID') }}" placeholder="{{ translate('Google Client ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="col-from-label">{{translate('Client Secret')}}</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET" value="{{  env('GOOGLE_CLIENT_SECRET') }}" placeholder="{{ translate('Google Client Secret') }}" required>
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
                <h5 class="mb-0 h6">{{translate('Facebook Login Credential')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="col-from-label">{{translate('App ID')}}</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="FACEBOOK_CLIENT_ID" value="{{ env('FACEBOOK_CLIENT_ID') }}" placeholder="{{ translate('Facebook Client ID') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="col-from-label">{{translate('App Secret')}}</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="FACEBOOK_CLIENT_SECRET" value="{{ env('FACEBOOK_CLIENT_SECRET') }}" placeholder="{{ translate('Facebook Client Secret') }}" required>
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

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Twitter Login Credential')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="TWITTER_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="col-from-label">{{translate('Client ID')}}</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="TWITTER_CLIENT_ID" value="{{ env('TWITTER_CLIENT_ID') }}" placeholder="{{ translate('Twitter Client ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="TWITTER_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="col-from-label">{{translate('Client Secret')}}</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="TWITTER_CLIENT_SECRET" value="{{ env('TWITTER_CLIENT_SECRET') }}" placeholder="{{ translate('Twitter Client Secret') }}" required>
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
