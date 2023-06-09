@extends('backend.layouts.app')

@section('content')

<!DOCTYPE html>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    $(document).ready(function() {
         $('#summernote').summernote({
        height: 300
      });
    });
  </script>


<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Send  Email')}}</h5>
            </div>

            <div class="card-body">
                <form class="form-horizontal" action="{{ route('newsletters.send_custom') }}" method="POST" enctype="multipart/form-data">
                	@csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-from-label" for="name">{{translate('Emails')}} ({{translate('Users')}})</label>

                        <div class="col-sm-10">
                            <input list="emails" class="form-control aiz-selectpicker" name="user_emails[]" multiple
                                   data-selected-text-format="count" data-actions-box="true"/>
                            <datalist id="emails">
                                @foreach($users as $user)
                                    <option value="{{$user->email}}">{{$user->email}}</option>
                                @endforeach
                            </datalist>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-from-label" for="subject">{{translate('subject')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 70px;">
                        <label class="col-sm-2 col-from-label" for="name">{{translate('content')}}</label>
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
