@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Commission History report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            @include('backend.reports.partials.commission_history_section')
        </div>
    </div>
</div>

@endsection