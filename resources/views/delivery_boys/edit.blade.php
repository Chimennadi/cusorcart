@extends('backend.layouts.app')

@section('content')

<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Delivery Boy Information')}}</h5>
        </div>

        <form action="{{ route('delivery-boys.update', $delivery_boy->id) }}" method="POST">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="card-body">
				
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{translate('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$delivery_boy->name}}" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="email">{{translate('Email')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{$delivery_boy->email}}" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="phone">{{translate('Phone')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" value="{{$delivery_boy->phone}}" placeholder="Phone" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="password">{{translate('Password')}}</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="country">
                        {{translate('Country')}}
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control aiz-selectpicker" name="country_id" id="country_id" required>
                            <option value="">{{translate('Select Country')}}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->name }}" @if($delivery_boy->country == $country->name) selected @endif>
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
                                <option value="{{$delivery_boy->state}}">{{ $delivery_boy->state }}</option>
                        </select>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('City')}}</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id" required>
                              <option value="{{$delivery_boy->city}}">{{ $delivery_boy->city }}</option>                                
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="avatar_original">
                        {{translate('Image')}}
                    </label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="avatar_original" value="{{ $delivery_boy->avatar_original }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label">{{translate('Address')}}</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="address">{{ $delivery_boy->address }}</textarea>
                    </div>
                </div>

            </div>
               <center><h2>Bank Details</h2></center>
            <div class="card-body">
			
				@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
			  
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
                            @foreach ($countries as $country)
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
                

                
              

                <div class="form-group mb-3 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">

        (function($) {
			"use strict";
            
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

