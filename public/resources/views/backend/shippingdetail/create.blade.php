@extends('backend.layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Shipping Detail')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{URL::to('shipping-detail')}}" method="POST" enctype="multipart/form-data">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Service')}}</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="{{translate('Service')}}" id="name" name="service" class="form-control" required>
                        </div>
                    </div>
                  
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-md-3 col-form-label">-->
                    <!--        {{translate('Service Charges')}}-->
                    <!--    </label>-->
                    <!--    <div class="col-md-9">-->
                    <!--        <input type="number" required  name="service_charges" class="form-control" id="order_level" placeholder="{{translate('Service Charges')}}">-->
                            
                    <!--    </div>-->
                    <!--</div>-->
                    <div style="display:none" class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{translate('Gst Rate')}}
                        </label>
                        <div class="col-md-9">
                            <input type="hidden" value="0" required  name="gst_rate" class="form-control" id="order_level" placeholder="{{translate('Gst Rate')}}">
                            
                        </div>
                    </div>
                 <!--<div class="form-group row">-->
                 <!--       <label class="col-md-3 col-form-label">-->
                 <!--           {{translate('Amount')}}-->
                 <!--       </label>-->
                 <!--       <div class="col-md-9">-->
                 <!--           <input type="number"   name="amount" class="form-control" id="order_level" placeholder="{{translate('Amount')}}">-->
                           
                 <!--       </div>-->
                 <!--   </div>-->
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{translate('Per Kg Price')}}
                        </label>
                        <div class="col-md-9">
                            <input type="number"   name="kg" class="form-control" id="order_level" placeholder="{{translate('Per Kg Price')}}">
                           
                        </div>
                    </div>
                    
                    
                      <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('Unit Price Currency')}} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                            <select class="form-control" name="price_currecny" required>
                            <option>Price Upload Currency:</option>
                            @foreach(App\Currency::where('status','1')->get() as $itemcurrency)
                            <option
                             value="{{$itemcurrency->id}}"
                            >{{$itemcurrency->name}}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>
                    
                    
                   <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{translate('Transit Days')}}
                        </label>
                        <div class="col-md-9">
                            <input type="number" required  name="transit_day" class="form-control" id="order_level" placeholder="{{translate('Transit Days')}}">
                            
                        </div>
                    </div>
                    
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-md-3 col-form-label">-->
                    <!--        {{translate('Shipping Tax')}}-->
                    <!--    </label>-->
                    <!--    <div class="col-md-9">-->
                    <!--        <input type="number" required  name="shipping_tax" class="form-control"  placeholder="{{translate('Shipping Tax')}}">-->
                            
                    <!--    </div>-->
                    <!--</div>-->
                    
                     
                    
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

                <div class="row">
                    <div class="col-md-3">
                        <label>{{ translate('Pickup City')}}</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id" required>
                      
                        </select>
                    </div>
                </div>

                    
                    
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

                <div class="row">
                    <div class="col-md-3">
                        <label>{{ translate('Arrival City')}}</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id__arrival" required>
                      
                        </select>
                    </div>
                </div>

                    
                    
                    
                    
                    
                    
                    
                        @if(Auth::user()->user_type == "admin")
                  
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Status')}}</label>
                        <div class="col-md-9">
                            <select required class="form-control" name="status">
                            <option value="">Select Status</option>
                             <option value="Pending">Pending</option>
                              <option value="Approved">Approved</option>
                            </select>
                        </div>
                    </div>
                @endif    
                
                
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
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

