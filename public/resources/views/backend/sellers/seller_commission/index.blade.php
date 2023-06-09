@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                  <h5 class="mb-0 h6">{{translate('Seller Commission')}}</h5>
              </div>
              <div class="card-body">
                  <form class="form-horizontal" action="{{ route('business_settings.vendor_commission.update') }}" method="POST" enctype="multipart/form-data">
                  	@csrf
                    @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{ translate('Seller Commission Activation') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="vendor_commission_activation">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="vendor_commission_activation" type="checkbox" @if (get_setting('vendor_commission_activation') == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label class="col-md-4 col-from-label">{{translate('Seller Commission')}}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="vendor_commission">
                            <div class="input-group">
                                <input type="number" lang="en" min="0" step="0.01" value="{{ get_setting('vendor_commission') }}" placeholder="{{translate('Seller Commission')}}" name="vendor_commission" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                  </form>
              </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Note')}}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item text-muted">
                            1. {{ get_setting('vendor_commission') }}% {{translate('of seller product price will be deducted from seller earnings') }}.
                        </li>
                        <li class="list-group-item text-muted">
                            2. {{translate('This commission only works when Category Based Commission is turned off from Business Settings') }}.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
