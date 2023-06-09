@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ translate('Affiliate payments of ').$affiliate_user->user->name }}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('Date')}}</th>
                    <th>{{ translate('Amount')}}</th>
                    <th>{{ translate('Payment Method') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($affiliate_payments as $key => $payment)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $payment->created_at }}</td>
                        <td>
                            {{ single_price($payment->amount) }}
                        </td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
