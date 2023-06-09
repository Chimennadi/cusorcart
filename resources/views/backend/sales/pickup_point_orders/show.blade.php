@extends('backend.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
          <h1 class="h2 fs-16 mb-0">{{ translate('Order Details') }}</h1>
        </div>
        <div class="card-body">
            <div class="row gutters-5">
      			<div class="col text-center text-md-left">
      			</div>
                @php
                    $delivery_status = $order->orderDetails->first()->delivery_status;
                    $payment_status = $order->orderDetails->first()->payment_status;
                @endphp
                <div class="col-md-3 ml-auto">
                    <label for=update_payment_status"">{{translate('Payment Status')}}</label>
                        <select class="form-control aiz-selectpicker"  data-minimum-results-for-search="Infinity" id="update_payment_status">
                        <option value="paid" @if ($payment_status == 'paid') selected @endif>{{translate('Paid')}}</option>
                        <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{translate('Unpaid')}}</option>
                    </select>
                </div>
                <div class="col-md-3 ml-auto">
                    <label for=update_delivery_status"">{{translate('Delivery Status')}}</label>
                    <select class="form-control aiz-selectpicker"  data-minimum-results-for-search="Infinity" id="update_delivery_status">
                        <option value="pending" @if ($delivery_status == 'pending') selected @endif>{{translate('Pending')}}</option>
                        <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>{{translate('Confirmed')}}</option>
                        <option value="on_delivery" @if ($delivery_status == 'on_delivery') selected @endif>{{translate('On delivery')}}</option>
                        <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>{{translate('Delivered')}}</option>
                    </select>
                </div>
      		</div>
            <div class="row gutters-5">
    			<div class="col text-center text-md-left">
                    <address>
                        <strong class="text-main">{{ json_decode($order->shipping_address)->name }}</strong><br>
                         {{ json_decode($order->shipping_address)->email }}<br>
                         {{ json_decode($order->shipping_address)->phone }}<br>
                         {{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}
                    </address>
                    @if ($order->manual_payment && is_array(json_decode($order->manual_payment_data, true)))
                        <br>
                        <strong class="text-main">{{ translate('Payment Information') }}</strong><br>
                        {{ translate('Name') }}: {{ json_decode($order->manual_payment_data)->name }}, {{ translate('Amount') }}: {{ single_price(json_decode($order->manual_payment_data)->amount) }}, {{ translate('TRX ID') }}: {{ json_decode($order->manual_payment_data)->trx_id }}
                        <br>
                        <a href="{{ uploaded_asset(json_decode($order->manual_payment_data)->photo) }}" target="_blank"><img src="{{ uploaded_asset(json_decode($order->manual_payment_data)->photo) }}" alt="" height="100"></a>
                    @endif
    			</div>
    			<div class="col-md-4 ml-auto">
                    <table class="invoice-details table table-bordered aiz-table">
                        <tbody>
                            <tr>
                                <td class="text-main text-bold">
                                    {{translate('Order #')}}
                                </td>
                                <td class="text-right text-info text-bold">
                                    {{ $order->code }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">{{translate('Order Status')}}</td>
                                    @php
                                      $status = $order->orderDetails->first()->delivery_status;
                                    @endphp
                                <td class="text-right">
                                    @if($status == 'delivered')
                                        <span class="badge badge-inline badge-success">{{ translate(ucfirst(str_replace('_', ' ', $status))) }}</span>
                                    @else
                                        <span class="badge badge-inline badge-info">{{ translate(ucfirst(str_replace('_', ' ', $status))) }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">
                                    {{translate('Order Date')}}
                                </td>
                                <td class="text-right">
                                    {{ date('d-m-Y h:i A', $order->date) }} (UTC)
                                </td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">
                                    {{translate('Total amount')}}
                                </td>
                                <td class="text-right">
                                    {{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">
                                    {{translate('Payment method')}}
                                </td>
                                <td class="text-right">
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
    			</div>
    		</div>
    		<div class="">
				<table class="table table-bordered aiz-table invoice-summary">
    				<thead>
        				<tr class="bg-trans-dark">
                            <th data-breakpoints="lg" class="min-col">#</th>
        					<th class="text-uppercase">
        						{{translate('Description')}}
        					</th>
                            <th data-breakpoints="lg" class="text-uppercase">
        						{{translate('Delivery Type')}}
        					</th>
        					<th data-breakpoints="lg" class="min-col text-center text-uppercase">
        						{{translate('Qty')}}
        					</th>
        					<th data-breakpoints="lg" class="min-col text-center text-uppercase">
        						{{translate('Price')}}
        					</th>
        					<th data-breakpoints="lg" class="min-col text-right text-uppercase">
        						{{translate('Total')}}
        					</th>
        				</tr>
    				</thead>
    				<tbody>
                        @foreach ($order->orderDetails as $key => $orderDetail)
                            <tr>
                                <td>{{ $key+1 }}</td>
            					<td>
                                    @if ($orderDetail->product != null)
                						<strong><a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank" class="text-muted" >{{ $orderDetail->product->getTranslation('name') }}</a></strong>
                						<small>{{ $orderDetail->variation }}</small>
                                    @else
                                        <strong>{{ translate('Product Unavailable') }}</strong>
                                    @endif
            					</td>
                                <td>
                                    @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                        {{ translate('Home Delivery') }}
                                    @elseif ($orderDetail->shipping_type == 'pickup_point')
                                        @if ($orderDetail->pickup_point != null)
                                            {{ $orderDetail->pickup_point->getTranslation('name') }} ({{ translate('Pickup Point') }})
                                        @else
                                            {{ translate('Pickup Point') }}
                                        @endif
                                    @endif
                                </td>
            					<td class="text-center">
            						{{ $orderDetail->quantity }}
            					</td>
            					<td class="text-center">
            						{{ single_price($orderDetail->price/$orderDetail->quantity) }}
            					</td>
                                <td class="text-center">
            						{{ single_price($orderDetail->price) }}
            					</td>
            				</tr>
                        @endforeach
    				</tbody>
				</table>
    		</div>
    		<div class="clearfix float-right">
    			<table class="table">
        			<tbody>
        			<tr>
        				<td>
        					<strong class="text-muted">{{translate('Sub Total')}} :</strong>
        				</td>
        				<td>
        					{{ single_price($order->orderDetails->sum('price')) }}
        				</td>
        			</tr>
        			<tr>
        				<td>
        					<strong class="text-muted">{{translate('Tax')}} :</strong>
        				</td>
        				<td>
        					{{ single_price($order->orderDetails->sum('tax')) }}
        				</td>
        			</tr>
                    <tr>
        				<td>
        					<strong class="text-muted">{{translate('Shipping')}} :</strong>
        				</td>
        				<td>
        					{{ single_price($order->orderDetails->sum('shipping_cost')) }}
        				</td>
        			</tr>
                    <tr>
        				<td>
        					<strong class="text-muted">{{translate('Coupon')}} :</strong>
        				</td>
        				<td>
        					{{ single_price($order->coupon_discount) }}
        				</td>
        			</tr>
        			<tr>
        				<td>
        					<strong>{{translate('TOTAL')}} :</strong>
        				</td>
        				<td class="text-bold h5">
        					{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax') + $order->orderDetails->sum('shipping_cost')) }}
        				</td>
        			</tr>
        			</tbody>
    			</table>
                <div class="text-right no-print">
                    <a href="{{ route('invoice.download', $order->id) }}" type="button" class="btn btn-icon btn-light"><i class="las la-print"></i></a>
                </div>
    		</div>
    	</div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#update_delivery_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                AIZ.plugins.notify('success', '{{ translate('Delivery status has been updated') }}');
            });
        });

        $('#update_payment_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                AIZ.plugins.notify('success', '{{ translate('Payment status has been updated') }}');
            });
        });
    </script>
@endsection
