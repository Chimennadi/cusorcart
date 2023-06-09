@extends('backend.layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('View Shipping Details')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{URL::to('shipping-detail')}}" method="GET">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="type">
                            {{translate('Pickup Country')}} 
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control aiz-selectpicker" data-live-search="true" name="country_id" id="country_id" required>
                                <option value="">{{translate('Select Country')}}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}">
    									{{ $country->name }}
    								</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    				<div class="row">
                        <div class="col-md-3">
                            <label>{{ translate('Pickup State')}}</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_id" required>
                             
                            </select>
                        </div>
                    </div>
    
                    <!--<div class="row">-->
                    <!--    <div class="col-md-3">-->
                    <!--        <label>{{ translate('Pickup City')}}</label>-->
                    <!--    </div>-->
                    <!--    <div class="col-md-9">-->
                    <!--        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id">-->
                          
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="type">
                            {{translate('Arrival Country')}} 
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control aiz-selectpicker" data-live-search="true" name="country_id_arrival" id="country_id_arrival" required>
                                <option value="">{{translate('Select Country')}}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}">
    									{{ $country->name }}
    								</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
    				<div class="row">
                        <div class="col-md-3">
                            <label>{{ translate('Arrival State')}}</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_id_arrival" required>
                             
                            </select>
                        </div>
                    </div>
    
                    <!--<div class="row">-->
                    <!--    <div class="col-md-3">-->
                    <!--        <label>{{ translate('Arrival City')}}</label>-->
                    <!--    </div>-->
                    <!--    <div class="col-md-9">-->
                    <!--        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id__arrival">-->
                          
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</div>-->
    
                        
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('View Logistics Services')}}</button>
                    </div>
                </form>
            </div>
        </div>
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
        
        
        
        
        
        
                    $(document).on('change', '[name=country_id_arrival]', function() {
                var country_id = $(this).val();
                     get_state1(country_id);

            });
            
            
                     
            $(document).on('change', '[name=state_id_arrival]', function() {
                var state = $(this).val();
                // alert(state);
                get_city1(state)
                
            });
            
            
            
            
    function get_state1(country) {
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
                    $('[name="state_id_arrival"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
   
   
   
   
   
    function get_city1(country) {
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
                    $('[name="city_id__arrival"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }

            
        })(jQuery);

    </script>
@endsection

