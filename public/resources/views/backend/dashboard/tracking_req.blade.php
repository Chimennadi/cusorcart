@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('Tracking Order')}}</h1>
        </div>
       
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">{{ translate('Tracking Order') }}</h5>
        <form class="" id="sort_categories" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Delivery Status')}}</th>
                    <th data-breakpoints="lg">{{translate('Code')}}</th>
                    <th data-breakpoints="lg">{{ translate('Payment Type') }}</th>
                    <th data-breakpoints="lg">{{ translate('Payment Status') }}</th>
                    <th data-breakpoints="lg">{{ translate('Service Charge') }}</th>
                    <th data-breakpoints="lg">{{translate('Grand Total')}}</th>
                    <th data-breakpoints="lg">{{translate('Date')}}</th>
                    
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td>#</td>

			<td>{{ $orders->delivery_status }}</td>
				<td>{{ $orders->code }}</td>
			<td>{{ $orders->payment_type }}</td>
			<td>{{ $orders->payment_status }}</td>
			<td>{{ $orders->service_charge }}</td>
			<td>{{ $orders->grand_total }}</td>
		
			<td>{{ $orders->date }}</td>
		
	
                    </tr>
               
            </tbody>
        </table>
        
    </div>
</div>
@endsection
]

@section('script')
    <script type="text/javascript">
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('categories.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Featured categories updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
