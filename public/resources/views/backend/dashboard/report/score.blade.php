@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="mb-0 h6">{{translate('Score')}}</h3>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th data-breakpoints="lg">{{translate('Order Number')}}</th>
                    <th>{{translate('Service Charge')}}</th>
                    <th>{{translate('Payment Status')}}</th>
                    <th>{{translate('Delivery Status')}}</th>
                    <th data-breakpoints="lg">{{ translate('Total') }}</th>
                    <th data-breakpoints="lg">{{ translate('Date') }}</th>
                    <th data-breakpoints="lg">{{ translate('Score') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                   
                        <tr>
                            <td>#</td>
                            <td>{{ $order->code }}</td>
                            <td>
                               {{$order->service_charge}}
                            </td>
                            
                            <td>
                               {{ $order->payment_status }}
                            </td>
                            <td>
                                {{ $order->delivery_status }}
                            </td>
                            <td>{{ $order->grand_total }} </td>
                             <td>{{$order->created_at->format('d-m-Y')}} </td>
                             <?php
                             $data=App\LogisticSale::where('order_id',$order->id)->count();
                             $result = 20 * $data;
                             ?>
                             <td>{{$result}}</td>
                        </tr>
                   
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
              {{ $orders->links() }}
        </div>
    </div>
</div>

@endsection
