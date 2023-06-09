@extends('frontend.layouts.user_panel')
@section('panel_content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('Shipping Details')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{route('shipping.create')}}" class="btn btn-primary">
                <span>{{translate('Add New Service')}}</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">{{ translate('Shipping Details') }}</h5>
        <form class="" id="sort_categories" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search1" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Service')}}</th>
                    <th data-breakpoints="lg">{{ translate('Amount') }}</th>
                    <th data-breakpoints="lg">{{translate('Transit Days')}}</th>
                    <!--<th data-breakpoints="lg">{{translate('Shipping Tax')}}</th>-->
                    <th width="10%" class="text-right">{{translate('Approval status')}}</th>
                    <th width="10%" class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($ships as $key => $ship)
                    <tr>
                        <td>#</td>

			<td>{{ $ship->service }}</td>
			<td>{{ $ship->kg }}</td>
			<td>{{ $ship->transit_day }}</td>
			<!--<td>{{ $ship->shipping_tax }}</td>-->
         	<td>{{ $ship->status }}</td>
		
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/shipping-detail/{{$ship->id}}?page={{$page}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm " onclick="document.getElementById('ship_del{{$ship->id}}').submit()" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                            <form method="post" action="/shipping-detail/{{$ship->id}}?page={{$page}}" id="ship_del{{$ship->id}}" >
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $ships->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@section('modal')
    @include('modals.delete_modal')
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#type-select').change(function(){
                console.log("change detected");
                $('#type-form').submit();
            });
             
          $("#search1").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });

</script>        
@endsection
