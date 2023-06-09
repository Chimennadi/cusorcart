@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Send Newsletter')}}</h5>
            </div>

            <div class="card-body">
                <form class="form-horizontal" action="{{ route('newsletters.send') }}" method="POST" enctype="multipart/form-data">
                	@csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-from-label" for="name">{{translate('Emails')}} ({{translate('Users')}})</label>
                        <div class="col-sm-10">
                            <select class="form-control aiz-selectpicker" name="user_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                                @foreach($users as $user)
                                    <option value="{{$user->email}}">{{$user->email}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-from-label" for="name">{{translate('Emails')}} ({{translate('Subscribers')}})</label>
                        <div class="col-sm-10">
                            <select class="form-control aiz-selectpicker" name="subscriber_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                                @foreach($subscribers as $subscriber)
                                    <option value="{{$subscriber->email}}">{{$subscriber->email}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-from-label" for="subject">{{translate('Newsletter subject')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 70px;">
                        <label class="col-sm-2 col-from-label" for="name">{{translate('Newsletter content')}}</label>
                        <div class="col-sm-10">
                            <textarea id="quill-slug" style="display:none" name="content"></textarea>
                            <div class="quill-text-editor" name="content"></div>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Send')}}</button>
                    </div>
                  </form>
              </div>
        </div>
    </div>
</div>

@endsection
