@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All Payment List')}}</h1>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header d-block d-lg-flex">
        <h5 class="mb-0 h6">{{translate('Payment List')}}</h5>
        <div class="">
<!--            <form class="" id="sort_delivery_boys" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 250px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type email or name & Enter') }}">
                    </div>
                </div>
            </form>-->
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Delivery Boy')}}</th>
                    <th class="text-center">{{translate('Payment Amount')}}</th>
                    <th class="text-right">{{translate('Created At')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($delivery_boy_payments as $key => $delivery_boy_payment)

                <tr>
                    <td>{{ ($key+1) + ($delivery_boy_payments->currentPage() - 1) * $delivery_boy_payments->perPage() }}</td>
                    <td>
                        {{ $delivery_boy_payment->user->name }}
                    </td>
                    <td class="text-center">
                        {{ $delivery_boy_payment->payment }}
                    </td>
                    <td class="text-right">
                        {{$delivery_boy_payment->created_at}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $delivery_boy_payments->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

