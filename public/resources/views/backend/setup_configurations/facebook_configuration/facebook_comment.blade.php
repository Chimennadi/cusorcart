@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Facebook Comment Setting')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('facebook-comment.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="col-from-label">{{translate('Facebook Comment')}}</label>
                            </div>
                            <div class="col-md-7">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    @php
                                        $facebook_comment_data = \App\BusinessSetting::where('type', 'facebook_comment')->first();
                                    @endphp
                                    <input value="1" name="facebook_comment" type="checkbox" @if ($facebook_comment_data && $facebook_comment_data->value == 1) checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="FACEBOOK_APP_ID">
                            <div class="col-md-5">
                                <label class="col-from-label">{{translate('Facebook App ID')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="FACEBOOK_APP_ID" value="{{  env('FACEBOOK_APP_ID') }}" placeholder="{{ translate('Facebook App ID') }}" required>
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
            <div class="card bg-gray-light">
              <div class="card-header">
                  <h5 class="mb-0 h6">{{ translate('Please be carefull when you are configuring Facebook Comment. For incorrect configuration you will not get comment section on your user-end site.') }}</h5>
              </div>
                <div class="card-body">
                    <ul class="list-group mar-no">
                        <li class="list-group-item text-dark">
                            1. {{ translate('Login into your facebook page') }}
                        </li>
                        <li class="list-group-item text-dark">
                            2. {{ translate('After then go to this URL https://developers.facebook.com/apps/') }}.
                        </li>
                        <li class="list-group-item text-dark">
                            3. {{ translate('Create Your App') }}.
                        </li>
                        <li class="list-group-item text-dark">
                            4. {{ translate('In Dashboard page you will get your App ID') }}.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
