@extends('backend.layouts.app')

@section('content')

<div class="card">
    <form class="" action="" method="GET">
      <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
          <h5 class="mb-md-0 h6">{{ translate('Pickup Point Orders') }}</h5>
        </div>
        <div class="col-lg-2">
            <div class="form-group mb-0">
                <input type="text" class="aiz-date-range form-control" value="{{ $date }}" name="date" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
            </div>
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
  </form>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Order Code')}}</th>
                    <th data-breakpoints="lg">{{translate('Num. of Products')}}</th>
                    <th data-breakpoints="lg">{{translate('Customer')}}</th>
                    <th data-breakpoints="lg">{{translate('Amount')}}</th>
                    <th data-breakpoints="lg">{{translate('Delivery Status')}}</th>
                    <th data-breakpoints="lg">{{translate('Payment Method')}}</th>
                    <th data-breakpoints="lg">{{translate('Payment Status')}}</th>
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
                                {{ $order->code }} @if($order->viewed == 0) <span class="badge badge-inline badge-info">{{translate('New')}}</span> @endif
                            </td>
                            <td>
                                {{ count($order->orderDetails) }}
                            </td>
                            <td>
                                @if ($order->user_id != null)
                                    {{ $order->user->name }}
                                @else
                                    Guest ({{ $order->guest_id }})
                                @endif
                            </td>
                            <td>
                                {{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}
                            </td>
                            <td>
                                @php
                                    $status = $order->orderDetails->first()->delivery_status;
                                @endphp
                                {{ translate(ucfirst(str_replace('_', ' ', $status))) }}
                            </td>
                            <td>
                                {{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}
                            </td>
                            <td>
                                <span class="badge badge--2 mr-4">
                                    @if ($order->orderDetails->first()->payment_status == 'paid')
                                        <i class="bg-green"></i> {{ translate('Paid') }}
                                    @else
                                        <i class="bg-red"></i> {{ translate('Unpaid') }}
                                    @endif
                                </span>
                            </td>
                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('pick_up_point.order_show', encrypt($order->id)) }}" title="{{ translate('View') }}">
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
            {{ $orders->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">

    </script>
@endsection
