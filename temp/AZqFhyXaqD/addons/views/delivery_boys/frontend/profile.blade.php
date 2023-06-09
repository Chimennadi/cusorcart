@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Manage Profile') }}</h1>
        </div>
      </div>
    </div>

    <!-- Basic Info-->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Basic Info')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ translate('Your Name') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="{{ translate('Your Name') }}" name="name" value="{{ Auth::user()->name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ translate('Your Phone') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="{{ translate('Your Phone')}}" name="phone" value="{{ Auth::user()->phone }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ translate('Photo') }}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photo" value="{{ Auth::user()->avatar_original }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ translate('Your Password') }}</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" placeholder="{{ translate('New Password') }}" name="new_password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ translate('Confirm Password') }}</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" placeholder="{{ translate('Confirm Password') }}" name="confirm_password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ translate('Your Address') }}</label>
                    <div class="col-md-10">
                        <textarea class="form-control  mb-3" placeholder="{{ translate('Your Address') }}" rows="1" name="address" required>{{ Auth::user()->address }}</textarea>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Update Profile')}}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Email Change -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Change your email')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.change.email') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('Your Email') }}</label>
                    </div>
                    <div class="col-md-10">
                        <div class="input-group mb-3">
                          <input type="email" class="form-control" placeholder="{{ translate('Your Email')}}" name="email" value="{{ Auth::user()->email }}" />
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary new-email-verification">
                                    <span class="d-none loading">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{ translate('Sending Email...') }}
                                    </span>
                                    <span class="default">{{ translate('Verify') }}</span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{translate('Update Email')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('modal')

@endsection

@section('script')
<script type="text/javascript">

    (function($) {
        "use strict";
        function add_new_address() {
            $('#new-address-modal').modal('show');
        }
    
        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();
    
            $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
                data = JSON.parse(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if(data.status == 2)
                    AIZ.plugins.notify('warning', data.message);
                else if(data.status == 1)
                    AIZ.plugins.notify('success', data.message);
                else
                    AIZ.plugins.notify('danger', data.message);
            });
        });
    
        function edit_address(address) {
            var url = '{{ route("addresses.edit", ":id") }}';
            url = url.replace(':id', address);
    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#edit_modal_body').html(response);
                    $('#edit-address-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');
                    var country = $("#edit_country").val();
                    get_city(country);
                }
            });
        }
    
        $(document).on('change', '[name=country]', function() {
            var country = $(this).val();
            get_city(country);
        });
    
        function get_city(country) {
            $('[name="city"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-city')}}",
                type: 'POST',
                data: {
                    country_name: country
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="city"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }
    })(jQuery);

</script>
@endsection
