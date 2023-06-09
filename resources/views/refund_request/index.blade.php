@extends('backend.layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="card">
    <div class="card-header row gutters-5">
        <h5 class="card-title pull-left pad-no">{{__('Refund Request All')}}</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Order Id')}}</th>
                    <th>{{__('Seller Name')}}</th>
                    <th>{{__('Product')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Seller Approval')}}</th>
                    <th>{{__('Refund Status')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($refunds as $key => $refund)
                    <tr>
                        <td>{{ ($key+1) + ($refunds->currentPage() - 1)*$refunds->perPage() }}</td>
                        <td>{{ $refund->order->code }}</td>
                        <td>
                            @if ($refund->seller != null)
                                {{ $refund->seller->name }}
                            @endif
                        </td>
                        <td>
                            @if ($refund->orderDetail != null && $refund->orderDetail->product != null)
                                <a href="{{ route('product', $refund->orderDetail->product->slug) }}" target="_blank" class="media-block">
                                    <div class="media-left">
                                        <img loading="lazy" width="40"  class="img-md" src="{{ uploaded_asset($refund->orderDetail->product->thumbnail_img)}}" alt="Image">
                                    </div>
                                    <div class="media-body">{{ __($refund->orderDetail->product->name) }}</div>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($refund->orderDetail != null)
                                {{single_price($refund->orderDetail->price)}}
                            @endif
                        </td>
                        <td>
                            @if ($refund->orderDetail->product != null && $refund->orderDetail->product->added_by == 'admin')
                                <div class="label label-mint">
                                    {{__('Own Product')}}
                                </div>
                            @else
                                @if ($refund->seller_approval == 1)
                                    <div class="label label-info">
                                        {{__('Approved')}}
                                    </div>
                                @else
                                    <div class="label label-warning">
                                        {{__('Pending')}}
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($refund->refund_status == 1)
                                <div class="label label-secondary">
                                    {{__('Paid')}}
                                </div>
                            @else
                                <div class="label label-warning">
                                    {{__('Non-Paid')}}
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><Button class="btn btn-primary" onclick="refund_request_money('{{ $refund->id }}')">{{__('Refund Now')}}</Button></li>
                                    <br>
                                    <li><a class="btn btn-primary" href="{{ route('reason_show', $refund->id) }}" target="_blank">{{__('View Reason')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $refunds->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        function update_refund_approval(el){
            $.post('{{ route('vendor_refund_approval') }}',{_token:'{{ @csrf_token() }}', el:el}, function(data){
                if (data == 1) {
                    showAlert('success', 'Approval has been done successfully');
                }
                else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function refund_request_money(el){
            $.post('{{ route('refund_request_money_by_admin') }}',{_token:'{{ @csrf_token() }}', el:el}, function(data){
                if (data == 1) {
                    location.reload();
                    showAlert('success', 'Refund has been sent successfully');
                }
                else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
