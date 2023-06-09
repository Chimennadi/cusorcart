@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="mb-0 h6">{{translate('Overall Sales')}}</h3>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                @if(Auth::user()->user_type == "staff")
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th data-breakpoints="lg">{{translate('Date')}}</th>
                    <th data-breakpoints="lg">{{translate('Order Code')}}</th>
                    <th>{{translate('Amount')}}</th>
                </tr>
                @else
                 <tr>
                    <th data-breakpoints="lg">#</th>
                    <th data-breakpoints="lg">{{translate('Date')}}</th>
                    <th>{{translate('Seller')}}</th>
                    <th>{{translate('Amount')}}</th>
                    <th data-breakpoints="lg">{{ translate('Payment Details') }}</th>
                </tr>
                @endif
            </thead>
            <tbody>
                @if(Auth::user()->user_type == "staff")
                    <?php
                        $logistic = App\LogisticSale::join('orders','orders.id','=','logistic_sales.order_id')
                        ->select('orders.code','logistic_sales.*')
                        ->orderBy('created_at', 'desc')->paginate(15);
                    ?>
                    @foreach($logistic as $key => $logistics)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $logistics->created_at }}</td>
                                <td>{{ $logistics->code }}</td>
                                <td>
                                    {{ $logistics->service_charge}}
                                </td>
                                
                            </tr>
                    @endforeach
                @else
                    @foreach($payments as $key => $payment)
                        @if (\App\Seller::find($payment->seller_id) != null && \App\Seller::find($payment->seller_id)->user != null)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $payment->created_at }}</td>
                                <td>
                                    @if (\App\Seller::find($payment->seller_id) != null)
                                        {{ \App\Seller::find($payment->seller_id)->user->name }} ({{ \App\Seller::find($payment->seller_id)->user->shop->name }})
                                    @endif
                                </td>
                                <td>
                                    {{ single_price($payment->amount) }}
                                </td>
                                <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null) (TRX ID : {{ $payment->txn_code }}) @endif</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="aiz-pagination">
              {{ $payments->links() }}
        </div>
    </div>
</div>

@endsection
