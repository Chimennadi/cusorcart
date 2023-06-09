@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Attribute Value Information')}}</h5>
</div>

<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-body p-0">
          
          <form class="p-4" action="{{ route('update-attribute-value', $attribute_value->id) }}" method="POST">
              <input name="_method" type="hidden" value="POST">
              <input type="hidden" name="attribute_id" value="{{ $attribute_value->attribute_id }}">
              @csrf
              <div class="form-group row">
                  <label class="col-sm-3 col-from-label" for="Attribute Value">
                      {{ translate('Attribute Value')}} 
                  </label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="{{ translate('Attribute Value')}}" id="value" name="value" class="form-control" required value="{{ $attribute_value->value }}">
                  </div>
              </div>
              {{-- <div class="form-group row">
                  <label class="col-sm-3 col-from-label" for="code">
                      {{ translate('Color Code')}} 
                  </label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="{{ translate('Color Code')}}" id="code" name="code" class="form-control" required value="{{ $attribute_value->code }}">
                  </div>
              </div> --}}
              <div class="form-group mb-0 text-right">
                  <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
              </div>
            </form>
        </div>
    </div>
</div>

@endsection
