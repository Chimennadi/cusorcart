@extends('backend.layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="card">
    <form class="" id="sort_orders" action="" method="GET">
      <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
          <h5 class="mb-md-0 h6">{{ translate('Inhouse Orders') }}</h5>
        </div>
        <div class="col-lg-2">
            <div class="form-group mb-0">
                <input type="text" class="aiz-date-range form-control" value="{{ $date }}" name="date" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
            </div>
        </div>
          <div class="col-lg-2 ml-auto">
            <select class="form-control aiz-selectpicker" name="payment_type" id="payment_type" onchange="sort_orders()">
                <option value="">{{translate('Filter by Payment Status')}}</option>
                <option value="paid"  @isset($payment_status) @if($payment_status == 'paid') selected @endif @endisset>{{translate('Paid')}}</option>
                <option value="unpaid"  @isset($payment_status) @if($payment_status == 'unpaid') selected @endif @endisset>{{translate('Un-Paid')}}</option>
            </select>
          </div>

          <div class="col-lg-2 ml-auto">
            <select class="form-control aiz-selectpicker" name="delivery_status" id="delivery_status" onchange="sort_orders()">
                <option value="">{{translate('Filter by Deliver Status')}}</option>
                <option value="pending" @isset($delivery_status) @if($delivery_status == 'pending') selected @endif @endisset>{{translate('Pending')}}</option>
                <option value="confirmed"   @isset($delivery_status) @if($delivery_status == 'confirmed') selected @endif @endisset>{{translate('Confirmed')}}</option>
                <option value="on_delivery"   @isset($delivery_status) @if($delivery_status == 'on_delivery') selected @endif @endisset>{{translate('On delivery')}}</option>
                <option value="delivered"   @isset($delivery_status) @if($delivery_status == 'delivered') selected @endif @endisset>{{translate('Delivered')}}</option>
            </select>
          </div>
          <div class="col-lg-2">
            <div class="form-group mb-0">
              <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Order code & hit Enter') }}">
            </div>
          </div>
          <div class="col-auto">
            <div class="form-group mb-0">
              <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
            </div>
          </div>
      </div>
    </from>

    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Order Code')}}</th>
                    <th data-breakpoints="md">{{translate('Num. of Products')}}</th>
                    <th data-breakpoints="md">{{translate('Customer')}}</th>
                    <th data-breakpoints="md">{{translate('Amount')}}</th>
                    <th data-breakpoints="md">{{translate('Delivery Status')}}</th>
                    <th data-breakpoints="md">{{translate('Payment Method')}}</th>
                    <th data-breakpoints="md">{{translate('Payment Status')}}</th>
                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                        <th>{{translate('Refund')}}</th>
                    @endif
                    <th class="text-right" width="15%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order_id)
                    @php
                        $order = \App\Order::find($order_id->id);
                    @endphp
                    @if($order != null)
                        <tr>
                            <td>
                                {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}
                            </td>
                            <td>
                                {{ $order->code }}@if($order->viewed == 0) <span class="badge badge-inline badge-info">{{translate('New')}}</span>@endif
                            </td>
                            <td>
                                {{ count($order->orderDetails->where('seller_id', $admin_user_id)) }}
                            </td>
                            <td>
                                @if ($order->user != null)
                                    {{ $order->user->name }}
                                @else
                                    Guest ({{ $order->guest_id }})
                                @endif
                            </td>
                            <td>
                                {{ single_price($order->orderDetails->where('seller_id', $admin_user_id)->sum('price') + $order->orderDetails->where('seller_id', $admin_user_id)->sum('tax')) }}
                            </td>
                            <td>
                                @php
                                    $status = $order->delivery_status;
                                @endphp
                                {{ translate(ucfirst(str_replace('_', ' ', $status))) }}
                            </td>
                            <td>
                                {{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}
                            </td>
                            <td>
                                @if ($order->payment_status == 'paid')
                                  <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                                @else
                                  <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                                @endif
                            </td>
                            @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                <td>
                                    @if (count($order->refund_requests) > 0)
                                        {{ count($order->refund_requests) }} {{ translate('Refund') }}
                                    @else
                                        {{ translate('No Refund') }}
                                    @endif
                                </td>
                            @endif

                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('inhouse_orders.show', encrypt($order->id))}}" title="{{ translate('View') }}">
                                    <i class="las la-eye"></i>
                                </a>
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">
                                    <i class="las la-download"></i>
                                </a>
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('orders.destroy', $order->id)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $orders->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
@endsection
