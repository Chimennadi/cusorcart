@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Manage Profile') }}</h1>
        </div>
      </div>
    </div>
    <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Basic Info-->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Basic Info')}}</h5>
            </div>
            <div class="card-body">
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

            </div>
        </div>

        <!-- Address -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Address')}}</h5>
            </div>
            <div class="card-body">
                <div class="row gutters-10">
                    @foreach (Auth::user()->addresses as $key => $address)
                        <div class="col-lg-6">
                            <div class="border p-3 pr-5 rounded mb-3 position-relative">
                                <div>
                                    <span class="w-50 fw-600">{{ translate('Address') }}:</span>
                                    <span class="ml-2">{{ $address->address }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('Postal Code') }}:</span>
                                    <span class="ml-2">{{ $address->postal_code }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('City') }}:</span>
                                    <span class="ml-2">{{ $address->city }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('Country') }}:</span>
                                    <span class="ml-2">{{ $address->country }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('Phone') }}:</span>
                                    <span class="ml-2">{{ $address->phone }}</span>
                                </div>
                                @if ($address->set_default)
                                    <div class="position-absolute right-0 bottom-0 pr-2 pb-3">
                                        <span class="badge badge-inline badge-primary">{{ translate('Default') }}</span>
                                    </div>
                                @endif
                                <div class="dropdown position-absolute right-0 top-0">
                                    <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                        <i class="la la-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                            {{ translate('Edit') }}
                                        </a>
                                        @if (!$address->set_default)
                                            <a class="dropdown-item" href="{{ route('addresses.set_default', $address->id) }}">{{ translate('Make This Default') }}</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('addresses.destroy', $address->id) }}">{{ translate('Delete') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-6 mx-auto" onclick="add_new_address()">
                        <div class="border p-3 rounded mb-3 c-pointer text-center bg-light">
                            <i class="la la-plus la-2x"></i>
                            <div class="alpha-7">{{ translate('Add New Address') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment System -->
        <div class="card">
          <div class="card-header">
              <h5 class="mb-0 h6">{{ translate('Payment Setting')}}</h5>
          </div>
          <div class="card-body">
            <div class="row">
                <label class="col-md-3 col-form-label">{{ translate('Cash Payment') }}</label>
                <div class="col-md-9">
                    <label class="aiz-switch aiz-switch-success mb-3">
                        <input value="1" name="cash_on_delivery_status" type="checkbox" @if (Auth::user()->seller->cash_on_delivery_status == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <label class="col-md-3 col-form-label">{{ translate('Bank Payment') }}</label>
                <div class="col-md-9">
                    <label class="aiz-switch aiz-switch-success mb-3">
                        <input value="1" name="bank_payment_status" type="checkbox" @if (Auth::user()->seller->bank_payment_status == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <label class="col-md-3 col-form-label">{{ translate('Bank Name') }}</label>
                <div class="col-md-9">
                    <input type="text" class="form-control mb-3" placeholder="{{ translate('Bank Name')}}" value="{{ Auth::user()->seller->bank_name }}" name="bank_name">
                </div>
            </div>
            <div class="row">
                <label class="col-md-3 col-form-label">{{ translate('Bank Account Name') }}</label>
                <div class="col-md-9">
                    <input type="text" class="form-control mb-3" placeholder="{{ translate('Bank Account Name')}}" value="{{ Auth::user()->seller->bank_acc_name }}" name="bank_acc_name">
                </div>
            </div>
            <div class="row">
                <label class="col-md-3 col-form-label">{{ translate('Bank Account Number') }}</label>
                <div class="col-md-9">
                    <input type="text" class="form-control mb-3" placeholder="{{ translate('Bank Account Number')}}" value="{{ Auth::user()->seller->bank_acc_no }}" name="bank_acc_no">
                </div>
            </div>
            <div class="row">
                <label class="col-md-3 col-form-label">{{ translate('Bank Routing Number') }}</label>
                <div class="col-md-9">
                    <input type="number" lang="en" class="form-control mb-3" placeholder="{{ translate('Bank Routing Number')}}" value="{{ Auth::user()->seller->bank_routing_no }}" name="bank_routing_no">
                </div>
            </div>
          </div>
      </div>
      <div class="form-group mb-0 text-right">
          <button type="submit" class="btn btn-primary">{{translate('Update Profile')}}</button>
      </div>
    </form>
    <br>

    <!-- Change Email -->
    <form action="{{ route('user.change.email') }}" method="POST">
        @csrf
        <div class="card">
          <div class="card-header">
              <h5 class="mb-0 h6">{{ translate('Change my email')}}</h5>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-2">
                      <label>{{ translate('My Email') }}</label>
                  </div>
                  <div class="col-md-10">
                      <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="{{ translate('Your Email')}}" name="email" value="{{ Auth::user()->email }}" />
                        <div class="input-group-append">
                           <button type="button" class="btn btn-outline-secondary new-email-verification">
                               <span class="d-none loading">
                                   <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>{{ translate('Sending Email...') }}
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
          </div>
        </div>
    </form>

@endsection

@section('modal')
<div class="modal fade" id="new-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Address')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control mb-3" placeholder="{{ translate('Your Address')}}" rows="2" name="address" required></textarea>
                            </div>
                        </div>
                           <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Country')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="country" required>
                                    <option value="">Select Country</option>
                                    @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('State')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state" required>

                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('City')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city" required>

                                </select>
                            </div>
                        </div>
       
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Postal code')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Phone')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('+880')}}" name="phone" value="" required>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id="edit_modal_body">

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function add_new_address(){
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
        
        get_state(country);
        
    });
    
    $(document).on('change', '[name=state]', function() {
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
                    $('[name="state"]').html(obj);
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
                    $('[name="city"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
    
    function add_new_address(){
        $('#new-address-modal').modal('show');
    }
    
        
    </script>
    
@endsection

