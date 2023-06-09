@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Seller Based Selling Report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('seller_sale_report.index') }}" method="GET">
                    <div class="form-group row offset-lg-2">
                        <label class="col-md-3 col-form-label">{{translate('Sort by verificarion status')}} :</label>
                        <div class="col-md-5">
                            <select class="from-control aiz-selectpicker" name="verification_status" required>
                               <option value="1" @if($sort_by == '1') selected @endif>{{ translate('Approved') }}</option>
                               <option value="0" @if($sort_by == '0') selected @endif>{{ translate('Non Approved') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Seller Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Shop Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Number of Product Sale') }}</th>
                            <th>{{ translate('Order Amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $key => $seller)
                            @if($seller->user != null)
                                <tr>
                                    <td>{{ $seller->user->name }}</td>
                                    @if($seller->user->shop != null)
                                        <td>{{ $seller->user->shop->name }}</td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>
                                        @php
                                            $num_of_sale = 0;
                                            foreach ($seller->user->products as $key => $product) {
                                                $num_of_sale += $product->num_of_sale;
                                            }
                                        @endphp
                                        {{ $num_of_sale }}
                                    </td>
                                    <td>
                                        {{ single_price(\App\OrderDetail::where('seller_id', $seller->user->id)->sum('price')) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination mt-4">
                    {{ $sellers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
