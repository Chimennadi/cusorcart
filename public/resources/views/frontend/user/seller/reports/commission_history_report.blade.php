@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        @include('backend.reports.partials.commission_history_section')
    </div>
@endsection