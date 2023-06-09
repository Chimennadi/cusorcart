@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Completed Delivery History') }}</h5>
        </div>
        @if (count($completed_deliveries) > 0)
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Code')}}</th>
                            <th>{{ translate('Date')}}</th>
                            <th>{{ translate('Amount')}}</th>
                            <th data-breakpoints="lg">{{ translate('Delivery Status')}}</th>
                            <th data-breakpoints="lg">{{ translate('Payment Status')}}</th>
                            <th class="text-right">{{ translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completed_deliveries as $key => $delivery)
                            @if(optional($delivery->order)->code)
                                <tr>
                                    <td>
                                        <a href="#{{ $delivery->order->code }}" onclick="show_purchase_history_details({{ $delivery->order->id }})">
                                            {{ $delivery->order->code }}
                                        </a>
                                    </td>
                                    <td>{{ $delivery->created_at }}</td>
                                    <td>
                                        {{ single_price($delivery->collection) }}
                                    </td>
                                    <td>
                                        {{ translate(ucfirst(str_replace('_', ' ', $delivery->delivery_status))) }}
                                    </td>
                                    <td>
                                        @if ($delivery->order->payment_status == 'paid')
                                            <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                                        @else
                                            <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $delivery->id }})" title="{{ translate('Order Details') }}">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $delivery->id) }}" title="{{ translate('Download Invoice') }}">
                                            <i class="las la-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $completed_deliveries->appends(request()->input())->links() }}
              	</div>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        (function($) {
            "use strict";
            $('#order_details').on('hidden.bs.modal', function () {
                location.reload();
            });
        })(jQuery);

    </script>

@endsection
