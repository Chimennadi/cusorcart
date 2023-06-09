@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Assigned Delivery History') }}</h5>
        </div>

        @if (count($assigned_deliveries) > 0)
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Code')}}</th>
                            <th data-breakpoints="lg">{{ translate('Date')}}</th>
                            <th>{{ translate('Amount')}}</th>
                            <th data-breakpoints="lg">{{ translate('Delivery Status')}}</th>
                            <th data-breakpoints="lg">{{ translate('Payment Status')}}</th>
                            <th data-breakpoints="lg">{{ translate('Payment Type')}}</th>
                            <th data-breakpoints="lg">{{ translate('Mark As Pickup')}}</th>
                            <th class="text-right">{{ translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assigned_deliveries as $key => $delivery)

                            <tr>
                                <td>
                                    <a href="#{{ $delivery->code }}" onclick="show_purchase_history_details({{ $delivery->id }})">
                                        {{ $delivery->code }}
                                    </a>
                                </td>
                                <td>{{ $delivery->delivery_history_date }}</td>
                                <td>
                                    {{ single_price($delivery->grand_total) }}
                                </td>
                                <td>
                                    {{ translate(ucfirst(str_replace('_', ' ', $delivery->delivery_status))) }}
                                    @if($delivery->delivery_viewed == 0)
                                        <span class="ml-2" style="color:green"><strong>*</strong></span>
                                    @endif
                                </td>
                                <td>
                                    @if ($delivery->payment_status == 'paid')
                                        <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                                    @else
                                        <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                                    @endif
                                    @if($delivery->payment_status_viewed == 0)
                                        <span class="ml-2" style="color:green"><strong>*</strong></span>
                                    @endif
                                </td>
                                <td>
                                    {{ translate(ucfirst(str_replace('_', ' ', $delivery->payment_type))) }}
                                </td>
                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_status(this)" value="{{ $delivery->id }}" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="text-right">
                                    <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="confirm_cancel_request('{{route('cancel-request', $delivery->id)}}')" title="{{ translate('Cancel') }}">
                                        <i class="las la-times"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $delivery->id }})" title="{{ translate('Order Details') }}">
                                        <i class="las la-eye"></i>
                                    </a>
                                    <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $delivery->id) }}" title="{{ translate('Download Invoice') }}">
                                        <i class="las la-download"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $assigned_deliveries->appends(request()->input())->links() }}
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


    <!-- Cancel Request Modal -->
    <div class="modal fade" id="cancel-request">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{translate('Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{translate('Do you really want to send request to cancel?')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
                    <a class="btn btn-primary" id="confirmation">{{translate('Request Cancel')}}</a>
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
        
        function confirm_cancel_request(url)
        {
            $('#cancel-request').modal('show', {backdrop: 'static'});
            document.getElementById('confirmation').setAttribute('href' , url);
        }

        function update_status(selectObject) {
            var order_id = selectObject.value;
            var status = "picked_up";

            $.post('{{ route('orders.update_delivery_status') }}', {
                _token      : '{{ @csrf_token() }}',
                order_id    : order_id,
                status      : status
            }, function(data){
                AIZ.plugins.notify('success', '{{ translate('Delivery status has been updated') }}');
                location.reload();
            });
        }
        
    </script>

@endsection
