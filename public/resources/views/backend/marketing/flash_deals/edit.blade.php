@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Flash Deal Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-body p-0">
              <ul class="nav nav-tabs nav-fill border-light">
                @foreach (\App\Language::all() as $key => $language)
                  <li class="nav-item">
                    <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('flash_deals.edit', ['id'=>$flash_deal->id, 'lang'=> $language->code] ) }}">
                      <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                      <span>{{$language->name}}</span>
                    </a>
                  </li>
                 @endforeach
              </ul>
              <form class="p-4" action="{{ route('flash_deals.update', $flash_deal->id) }}" method="POST">
                @csrf
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="lang" value="{{ $lang }}">

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Title')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Title')}}" id="name" name="title" value="{{ $flash_deal->getTranslation('title', $lang) }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="background_color">{{translate('Background Color')}}<small>(Hexa-code)</small></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('#0000ff')}}" id="background_color" name="background_color" value="{{ $flash_deal->background_color }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label" for="text_color">{{translate('Text Color')}}</label>
                        <div class="col-lg-9">
                            <select name="text_color" id="text_color" class="form-control demo-select2" required>
                                <option value="">Select One</option>
                                <option value="white" @if ($flash_deal->text_color == 'white') selected @endif>{{translate('White')}}</option>
                                <option value="dark" @if ($flash_deal->text_color == 'dark') selected @endif>{{translate('Dark')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Banner')}} <small>(1920x500)</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="banner" value="{{ $flash_deal->banner }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    @php
                      $start_date = date('d-m-Y H:i:s', $flash_deal->start_date);
                      $end_date = date('d-m-Y H:i:s', $flash_deal->end_date);
                    @endphp

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="start_date">{{translate('Date')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control aiz-date-range" value="{{ $start_date.' to '.$end_date }}" name="date_range" placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="products">{{translate('Products')}}</label>
                        <div class="col-sm-9">
                            <select name="products[]" id="products" class="form-control aiz-selectpicker" multiple required data-placeholder="{{ translate('Choose Products') }}" data-live-search="true" data-selected-text-format="count">
                                @foreach(\App\Product::all() as $product)
                                    @php
                                        $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                                    @endphp
                                    <option value="{{$product->id}}" <?php if($flash_deal_product != null) echo "selected";?> >{{ $product->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="alert alert-danger">
                        {{ translate('If any product has discount or exists in another flash deal, the discount will be replaced by this discount & time limit.') }}
                    </div>

                    <br>
                    <div class="form-group" id="discount_table">

                    </div>

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
        $(document).ready(function(){

            get_flash_deal_discount();

            $('#products').on('change', function(){
                get_flash_deal_discount();
            });

            function get_flash_deal_discount(){
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('{{ route('flash_deals.product_discount_edit') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids, flash_deal_id:{{ $flash_deal->id }}}, function(data){
                        $('#discount_table').html(data);
                        AIZ.plugins.fooTable();
                    });
                }
                else{
                    $('#discount_table').html(null);
                }
            }
        });
    </script>
@endsection
