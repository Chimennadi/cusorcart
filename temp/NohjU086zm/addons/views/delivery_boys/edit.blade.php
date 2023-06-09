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
                                <option value="{{ $country->id }}" @if($delivery_boy->country == $country->name) selected @endif>
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
                            @foreach ($states as $key => $state)
                                <option value="{{ $state->id }}" @if($delivery_boy->state == $state->name) selected @endif>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('City')}}</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id" required>
                            @foreach ($cities as $key => $city)
                                <option value="{{ $city->id }}" @if($delivery_boy->city == $city->name) selected @endif>
                                    {{ $city->name }}
                                </option>
                            @endforeach
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
                get_states(country_id);
            });

            $(document).on('change', '[name=state_id]', function() {
                var state_id = $(this).val();
                get_city(state_id);
            });
            
            function get_states(country_id) {
                $('[name="state_id"]').html("");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('get-state')}}",
                    type: 'POST',
                    data: {
                        country_id  : country_id
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

            function get_city(state_id) {
                $('[name="city_id"]').html("");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('get-city')}}",
                    type: 'POST',
                    data: {
                        state_id: state_id
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
		})(jQuery);
	
    </script>
@endsection
