@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Affiliate Logs')}}</h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th data-breakpoints="lg">{{ translate('Referred By')}}</th>
                    <th>{{ translate('Referral User')}}</th>
                    <th>{{ translate('Amount')}}</th>
                    <th data-breakpoints="lg">{{ translate('Order Id')}}</th>
                    <th data-breakpoints="lg">{{ translate('Referral Type') }}</th>
                    <th data-breakpoints="lg">{{ translate('Product') }}</th>
                    <th data-breakpoints="lg">{{ translate('Date') }}</th>
                </thead>
                <tbody>
                @foreach($affiliate_logs as $key => $affiliate_log)
                    <tr>
                        <td>{{ ($key+1) + ($affiliate_logs->currentPage() - 1)*$affiliate_logs->perPage() }}</td>
                        <td>
                            {{ \App\User::where('id', $affiliate_log->referred_by_user)->first()->name }}
                        </td>
                        <td>
                            @if($affiliate_log->user_id !== null)
                                {{ $affiliate_log->user->name }}
                            @else
                                {{ translate('Guest').' ('. $affiliate_log->guest_id.')' }}
                            @endif
                        </td>
                        <td>{{ single_price($affiliate_log->amount) }}</td>
                        <td>
                            @if($affiliate_log->order_id != null)
                                {{ $affiliate_log->order->code }}
                            @else
                                {{ $affiliate_log->order_detail->order->code }}
                            @endif
                        </td>
                        <td> {{ ucwords(str_replace('_',' ', $affiliate_log->affiliate_type)) }}</td>
                        <td>
                            @if($affiliate_log->order_detail_id != null)
                                {{ $affiliate_log->order_detail->product->name }}
                            @endif
                        </td>
                        <td>{{ $affiliate_log->created_at->format('d, F Y') }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $affiliate_logs->links() }}
            </div>
        </div>
    </div>
@endsection
