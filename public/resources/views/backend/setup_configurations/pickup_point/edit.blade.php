@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Update Pickup Point Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <ul class="nav nav-tabs nav-fill border-light">
      				@foreach (\App\Language::all() as $key => $language)
      					<li class="nav-item">
      						<a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('pick_up_points.edit', ['id'=>$pickup_point->id, 'lang'=> $language->code] ) }}">
      							<img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
      							<span>{{$language->name}}</span>
      						</a>
      					</li>
  		            @endforeach
      			</ul>

                <form class="p-4" action="{{ route('pick_up_points.update',$pickup_point->id) }}" method="POST">
                	<input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" value="{{ $pickup_point->getTranslation('name', $lang) }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="address">{{translate('Location')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <div class="col-sm-9">
                            <textarea name="address" rows="8" class="form-control" required>{{ $pickup_point->getTranslation('address', $lang) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="phone">{{translate('Phone')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Phone')}}" id="phone" name="phone" value="{{ $pickup_point->phone }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">{{translate('Pickup Point Status')}}</label>
                        <div class="col-sm-3">
                            <label class="aiz-switch aiz-switch-success mb-0" style="margin-top:5px;">
                        		<input value="1" type="checkbox" name="pick_up_status"@if ($pickup_point->pick_up_status == 1) checked @endif>
                        		<span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Pick-up Point Manager')}}</label>
                        <div class="col-sm-9">
                            <select name="staff_id" required class="form-control aiz-selectpicker">
                                @foreach(\App\User::where('user_type','seller')->get()  as $staff)
                                   
                                        <option value="{{$staff->id}}" @if ($pickup_point->staff_id == $staff->id) selected @endif>{{$staff->name}}</option>
                                 
                                @endforeach
                            </select>
                        </div>
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
