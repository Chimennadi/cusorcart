@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header row gutters-5">
                <h5 class="card-title text-center">{{__('Reason For Refund Request')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{__('Reason')}}</label>
                    <div class="col-lg-8">
                        <p class="bord-all pad-all">{{ $refund->reason }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
