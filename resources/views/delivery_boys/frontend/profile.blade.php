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
            @php
                 $delivery_boy1 = App\DeliveryBoy::where('user_id',Auth::user()->id)->first();
                @endphp
        <div class="card-body">
            <form action="{{ route('delivery-boys123', $delivery_boy1->user_id) }}"   method="POST" enctype="multipart/form-data">
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
                    <label class="col-sm-2 col-from-label" for="country">
                        {{translate('Country')}}
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control aiz-selectpicker" name="country_id" id="country_id" required>
                            <option value="">{{translate('Select Country')}}</option>
                            @foreach (App\Country::where('status', 1)->get() as $country)
                                <option value="{{ $country->name }}" @if(Auth::user()->country == $country->name) selected @endif>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('State')}}</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control mb-3 aiz-selectpicker" name="state_id" id="edit_state"  data-live-search="true" required>
                                <option value="{{Auth::user()->state}}">{{ Auth::user()->state }}</option>
                        </select>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('City')}}</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id" required>
                              <option value="{{Auth::user()->city}}">{{ Auth::user()->city }}</option>                                
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ translate('Your Address') }}</label>
                    <div class="col-md-10">
                        <textarea class="form-control  mb-3" placeholder="{{ translate('Your Address') }}" rows="1" name="address" required>{{ Auth::user()->address }}</textarea>
                    </div>
                </div>
                               <center><h2>Bank Details</h2></center>
                  <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">
                        {{translate('Payment Type')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="payment_type" value="{{ $delivery_boy1->payment_type }}" placeholder="Payment Type" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="email">
                        {{translate('Currency')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="currency"  value="{{ $delivery_boy1->currency }}"  placeholder="Currency" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="phone">
                        {{translate('Bank Name')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="bank_name"  value="{{ $delivery_boy1->bank_name }}"   placeholder="Bank Name" required>
                    </div>
                </div>
                
                  <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="phone">
                        {{translate('Name on Bank Account')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="account_title"  value="{{ $delivery_boy1->account_title }}"   placeholder="Name on Bank Account" required>
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="phone">
                        {{translate('Account No/ IBAN')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="account_no"   value="{{ $delivery_boy1->account_no }}"   placeholder="Account No/ IBAN" required>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="type">
                        {{translate('Bank Country')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control aiz-selectpicker" data-live-search="true" name="b_country_id" id="b_country_id" required>
                            <option value="">{{translate('Select Country')}}</option>
                            @foreach (App\Country::where('status', 1)->get() as $country)
                                <option 
                                
                                @if($delivery_boy1->bank_country == $country->name) selected @endif
                                value="{{ $country->name }}">
									{{ $country->name }}
								</option>
                            @endforeach
                        </select>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('Bank State')}} <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="b_state_id" required>
                            <option value="{{$delivery_boy1->bank_state}}">{{ $delivery_boy1->bank_state }}</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('Bank City')}} <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="b_city_id" required>
                        <option value="{{$delivery_boy1->bank_city}}">{{ $delivery_boy1->bank_city }}</option>
                        </select>
                    </div>
                </div>
                
                
                   <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="phone">
                        {{translate('Bank Zip Code')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="zip_code" value="{{ $delivery_boy1->bank_zip_code  }}" placeholder="Bank Zip Code" required>
                    </div>
                </div>
                
                   <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="phone">
                        {{translate('Bank Swift Code')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="swift_code" value="{{ $delivery_boy1->bank_swift_code }}" placeholder="Bank Swift Code" required>
                    </div>
                </div>
                   <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="phone">
                        {{translate('Payment Reason')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="payment_reason" value="{{ $delivery_boy1->payment_reason }}" placeholder="Payment Reason" required>
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
    
         $(document).on('change', '[name=country_id]', function() {
                var country_id = $(this).val();
                     get_state(country_id);

            });
            
            
                     
            $(document).on('change', '[name=state_id]', function() {
                var state = $(this).val();
                // alert(state);
                get_city(state)
                
            });
            
            
             $(document).on('change', '[name=b_country_id]', function() {
                var country_id = $(this).val();
                     b_get_state(country_id);

            });
            
            
                     
            $(document).on('change', '[name=b_state_id]', function() {
                var state = $(this).val();
                // alert(state);
                b_get_city(state)
                
            });
            
            
            
            
    function get_state(country) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-state')}}",
            type: 'POST',
            data: {
                country_name: country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="state_id"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
   
   
   
   
   
    function get_city(country) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-city')}}",
            type: 'POST',
            data: {
                state: country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="city_id"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
    
    
               
    function b_get_state(country) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-state')}}",
            type: 'POST',
            data: {
                country_name: country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="b_state_id"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
   
   
   
   
   
    function b_get_city(country) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-city')}}",
            type: 'POST',
            data: {
                state: country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="b_city_id"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
            
            
        
        
        
        
    })(jQuery);

</script>
@endsection
