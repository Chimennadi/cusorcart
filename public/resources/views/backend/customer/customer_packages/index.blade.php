@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Classifies Packages')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('customer_packages.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Package')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="row">
    @foreach ($customer_packages as $key => $customer_package)
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body text-center">
                    <img alt="{{ translate('Package Logo')}}" src="{{ uploaded_asset($customer_package->logo) }}" class="mw-100 mx-auto mb-4" height="150px">
                    <p class="mb-3 h6 fw-600">{{$customer_package->getTranslation('name')}}</p>
                    <p class="h4">{{single_price($customer_package->amount)}}</p>
                    <p class="fs-15">{{translate('Product Upload') }}:
                        <span class="text-bold">{{$customer_package->product_upload}}</span>
                    </p>
                    <div class="mar-top">
                        <a href="{{route('customer_packages.edit', ['id'=>$customer_package->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" class="btn btn-sm btn-info">{{translate('Edit')}}</a>
                        <a href="#" data-href="{{route('customer_packages.destroy', $customer_package->id)}}" class="btn btn-sm btn-danger confirm-delete" >{{translate('Delete')}}</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
