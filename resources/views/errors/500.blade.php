@extends('frontend.layouts.app')

@section('content')
<section class="text-center py-6">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<img src="{{ static_asset('assets/img/500.svg') }}" class="img-fluid w-75">
				<h1 class="h2 fw-700 mt-5">{{ translate("Something went wrong!") }}</h1>
		    	<p class="fs-16 opacity-60">{{ translate("Sorry for the inconvenience, but we're working on it.") }} <br> {{ translate("Error code") }}: 500</p>
			</div>
		</div>
	</div>
</section>
@endsection
