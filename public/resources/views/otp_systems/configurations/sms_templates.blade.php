@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('SMS Templates')}}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                @foreach ($sms_templates as $key => $sms_template)
                                    <a class="nav-link @if($sms_template->id == 1) active @endif" id="v-pills-tab-2" data-toggle="pill" href="#v-pills-{{ $sms_template->id }}" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{ translate(ucwords(str_replace('_', ' ', $sms_template->identifier)))  }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                @foreach ($sms_templates as $key => $sms_template)
                                    <div class="tab-pane fade show @if($sms_template->id == 1) active @endif" id="v-pills-{{ $sms_template->id }}" role="tabpanel" aria-labelledby="v-pills-tab-1">
                                        <form action="{{ route('sms-templates.update', $sms_template->id) }}" method="POST">
                                            <input name="_method" type="hidden" value="PATCH">
                                            @csrf
                                            @if($sms_template->identifier != 'phone_number_verification' && $sms_template->identifier != 'password_reset')
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label class="col-from-label">{{translate('Activation')}}</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <label class="aiz-switch aiz-switch-success mb-0">
                                                            <input value="1" name="status" type="checkbox" @if ($sms_template->status == 1)
                                                                checked
                                                            @endif>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">{{translate('SMS Body')}}</label>
                                                <div class="col-md-10">
                                                    <textarea name="body" class="form-control" placeholder="Type.." rows="6" required>{{ $sms_template->sms_body }}</textarea>
                                                    <small class="form-text text-danger">{{ ('**N.B : Do Not Change The Variables Like [[ ____ ]].**') }}</small>
                                                    @error('body')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">{{translate('Template ID')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="template_id" value="{{ $sms_template->template_id }}" class="form-control" placeholder="{{translate('Template Id')}}">
                                                    <small class="form-text text-danger">{{ ('**N.B : Template ID is Required Only for Fast2SMS DLT Manual**') }}</small>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 text-right">
                                                <button type="submit" class="btn btn-primary">{{translate('Update Settings')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
