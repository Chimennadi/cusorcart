@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('All Cancel Request') }}</h5>
        </div>
        @if (count($cancel_requests) > 0)
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('Code')}}</th>
                            <th>{{translate('Request By')}}</th>
                            <th>{{translate('Request At')}}</th>
                            <th class="text-right">{{translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cancel_requests as $key => $cancel_request)

                        <tr>
                            <td>{{ ($key+1) + ($cancel_requests->currentPage() - 1) * $cancel_requests->perPage() }}</td>
                            <td>
                                {{ $cancel_request->code }}
                            </td>
                            <td>
                                {{ $cancel_request->delivery_boy->name }}
                            </td>
                            <td>
                                {{$cancel_request->cancel_request_at}}
                            </td>

                            <td class="text-right">
                                <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $cancel_request->id }})" title="{{ translate('Order Details') }}">
                                    <i class="las la-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $cancel_requests->appends(request()->input())->links() }}
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
            })
        })(jQuery);

    </script>

@endsection
