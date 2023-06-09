@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Total Collection History') }}</h5>
        </div>

        @if (count($today_collections) > 0)
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Code')}}</th>
                            <th data-breakpoints="lg">{{ translate('Date')}}</th>
                            <th>{{ translate('Amount')}}</th>
                            <th class="text-right">{{ translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($today_collections as $key => $collection)

                            <tr>
                                <td>
                                    <a href="#{{ $collection->order->code }}" onclick="show_purchase_history_details({{ $collection->order->id }})">
                                        {{ $collection->order->code }}
                                    </a>
                                </td>
                                <td>{{ date('d-m-Y', strtotime($collection->created_at)) }}</td>
                                <td>
                                    {{ single_price($collection->collection) }}
                                </td>

                                <td class="text-right">
                                    <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $collection->order->id }})" title="{{ translate('Order Details') }}">
                                        <i class="las la-eye"></i>
                                    </a>
                                    <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $collection->order->id) }}" title="{{ translate('Download Invoice') }}">
                                        <i class="las la-download"></i>
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $today_collections->appends(request()->input())->links() }}
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
