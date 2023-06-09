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
                    <th>{{__('Admin Approval')}}</th>
                    <th>{{__('Refund Status')}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($refunds as $key => $refund)
                    <tr>
                        <td>{{ ($key+1) + ($refunds->currentPage() - 1)*$refunds->perPage() }}</td>
                        <td>
                            @if ($refund->order != null)
                            {{ $refund->order->code }}
                            @endif
                        </td>
                        <td>
                            @if ($refund->seller != null)
                                {{ $refund->seller->name }}
                            @endif
                        </td>
                        <td>
                            @if ($refund->orderDetail != null && $refund->orderDetail->product != null)
                                <a href="{{ route('product', $refund->orderDetail->product->slug) }}" target="_blank" class="media-block">
                                    <div class="media-left">
                                        <img loading="lazy" width="40"  class="img-md" src="{{ uploaded_asset($refund->orderDetail->product->thumbnail_img)}}"   alt="Image">
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
                            @if ($refund->seller_approval == 1)
                                <div class="label label-table label-success">
                                    {{__('Approved')}}
                                </div>
                            @else
                                <div class="label label-table label-warning">
                                    {{__('Pending')}}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($refund->admin_approval == 1)
                                <div class="label label-table label-success">
                                    {{__('Approved')}}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($refund->refund_status == 1)
                                <div class="label label-table label-success">
                                    {{__('Paid')}}
                                </div>
                            @else
                                <div class="label label-table label-warning">
                                    {{__('Non-Paid')}}
                                </div>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{route('refund_request.delete', $refund->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm " title="Delete">
                                <i class="las la-trash"></i>
                            </a>
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
