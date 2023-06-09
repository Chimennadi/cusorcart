@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ \App\Seller::find($payments->first()->seller_id)->user->name }} ({{ \App\Seller::find($payments->first()->seller_id)->user->shop->name }})</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Date')}}</th>
                    <th>{{translate('Amount')}}</th>
                    <th data-breakpoints="lg">{{ translate('Payment Details') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $key => $payment)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $payment->created_at }}</td>
                        <td>
                            {{ single_price($payment->amount) }}
                        </td>
                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null) (TRX ID : {{ $payment->txn_code }}) @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
