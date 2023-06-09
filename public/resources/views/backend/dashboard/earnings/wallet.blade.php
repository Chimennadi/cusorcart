@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class=" align-items-center">
        <h1 class="h3">{{translate('Wallet Transaction')}}</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <form action="{{ route('wallet-history.index') }}" method="GET">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ translate('Wallet Transaction') }}</h5>
                    </div>
                   
                  
                </div>
            </form>
            <div class="card-body">

                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            
                            <th data-breakpoints="lg">{{  translate('Date') }}</th>
                            <th>{{ translate('Order Number')}}</th>
                             <th>{{ translate('Service')}}</th>
                            <th>{{ translate('Service Charge')}}</th>
                            <th data-breakpoints="lg">{{ translate('Amount')}}</th>
                            <th data-breakpoints="lg" class="text-right">{{ translate('Payment Method')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logics as $key => $wallet)
                        <?php $orders = App\Order::where('id',$wallet->order_id)->where('payment_status','paid')->where('user_id',Auth::User()->id)->paginate(10) ?>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                <td>{{$order->code}}</td>
                                <td>@foreach(App\ShippingDetail::where('id',$wallet->service_id)->get() as $service)  {{ $service->service }} @endforeach</td>
                                <td>{{$wallet->service_charge}}</td>
                                <td class="">{{$order->grand_total}}</td>
                                <td class="text-right">{{$order->payment_type}}</td>
                            </tr>
                        @endforeach
                         @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination mt-4">
                   {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection