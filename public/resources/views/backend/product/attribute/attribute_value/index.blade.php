@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('Attribute Detail')}}</h1>
	</div>
</div>

<div class="row">
    <!-- Small table -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">
                    {{ $attribute->getTranslation('name') }}
                </strong>
            </div>

            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ translate('Value') }}</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_attribute_values as $key => $attribute_value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                {{ $attribute_value->value }}
                            </td>

                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('edit-attribute-value', ['id'=>$attribute_value->id] )}}" title="{{ translate('Edit') }}">
									<i class="las la-edit"></i>
								</a>
								<a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('destroy-attribute-value', $attribute_value->id)}}" title="{{ translate('Delete') }}">
									<i class="las la-trash"></i>
								</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-5">
		<div class="card">
			<div class="card-header">
					<h5 class="mb-0 h6">{{ translate('Add New Attribute Value') }}</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('store-attribute-value') }}" method="POST">
				 	@csrf
				 	<div class="form-group mb-3">
				 		<label for="name">{{translate('Attribute Name')}}</label>
				 		<input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
				 		<input type="text" placeholder="{{ translate('Name')}}" name="name" value="{{ $attribute->name }}"class="form-control" readonly>
				 	</div>
				 	<div class="form-group mb-3">
				 		<label for="name">{{translate('Attribute Value')}}</label>
				 		<input type="text" placeholder="{{ translate('Name')}}" id="value" name="value" class="form-control" required>
				 	</div>
				 	<div class="form-group mb-3 text-right">
				 		<button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
				 	</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
