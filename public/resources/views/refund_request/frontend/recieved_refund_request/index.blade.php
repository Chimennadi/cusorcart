@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.user_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Recieved Refund Request')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <!--<ul class="breadcrumb">-->
                                        <!--    <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>-->
                                        <!--    <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>-->
                                        <!--    <li class="active"><a href="{{ route('vendor_refund_request') }}">{{__('Refund Request')}}</a></li>-->
                                        <!--</ul>-->
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">Refund Request</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-md mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{__('Order id')}}</th>
                                            <th>{{__('Product')}}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Reason')}}</th>
                                            <th>{{__('Approval')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($refunds) > 0)
                                            @foreach ($refunds as $key => $refund)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($refund->created_at)) }}</td>
                                                    <td>
                                                        @if ($refund->order != null)
                                                            {{ $refund->order->code }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($refund->orderDetail != null && $refund->orderDetail->product != null)
                                                            {{ $refund->orderDetail->product->name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($refund->orderDetail != null)
                                                            {{single_price($refund->orderDetail->price)}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($refund->refund_status == 1)
                                                            <span class="ml-2" style="color:green"><strong>{{__('Approved')}}</strong></span>
                                                        @else
                                                            <span class="ml-2" style="color:red"><strong>{{__('PENDING')}}</strong></span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('reason_show', $refund->id) }}"><span class="ml-2" style="color:green"><strong>{{__('Show')}}</strong></span></a>
                                                    </td>
                                                    <td>
                                                        @if ($refund->seller_approval == 1)
                                                            <label class="switch">
                                                                <input disabled  onchange="update_refund_unapproval('{{ $refund->id }}')" type="checkbox" @if ($refund->seller_approval == 1) checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        @else
                                                            <label class="switch">
                                                                <input onchange="update_refund_approval('{{ $refund->id }}')" type="checkbox" @if ($refund->seller_approval == 1) checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center pt-5 h4" colspan="100%">
                                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{ __('No history found.') }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $refunds->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script type="text/javascript">

        function update_refund_approval(el){
            $.post('{{ route('vendor_refund_approval') }}',{_token:'{{ @csrf_token() }}', el:el}, function(data){
                if (data == 1) {
                    alert('Approval has been done successfully');
                }
                else {
                    alert('danger', 'Something went wrong');
                }
            });
        }
        
        function update_refund_unapproval(el){
            $.post('{{ route('vendor_refund_unapproval') }}',{_token:'{{ @csrf_token() }}', el:el}, function(data){
                if (data == 1) {
                    alert('UnApproval has been done successfully');
                }
                else {
                    alert('danger', 'Something went wrong');
                }
            });
        }
        
        
    </script>
@endsection
