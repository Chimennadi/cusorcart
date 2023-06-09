@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Color Information')}}</h5>
</div>

<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-body p-0">
          
          <form class="p-4" action="{{ route('colors.update', $color->id) }}" method="POST">
              <input name="_method" type="hidden" value="POST">
              @csrf
              <div class="form-group row">
                  <label class="col-sm-3 col-from-label" for="name">
                      {{ translate('Name')}} 
                  </label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="{{ translate('Name')}}" id="name" name="name" class="form-control" required value="{{ $color->name }}">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-3 col-from-label" for="code">
                      {{ translate('Color Code')}} 
                  </label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="{{ translate('Color Code')}}" id="code" name="code" class="form-control" required value="{{ $color->code }}">
                  </div>
              </div>
              <div class="form-group mb-0 text-right">
                  <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
              </div>
            </form>
        </div>
    </div>
</div>

@endsection
