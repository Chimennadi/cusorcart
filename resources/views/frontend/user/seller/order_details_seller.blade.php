<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{ translate('Order id')}}: {{ $order->code }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@php
    $status = $order->orderDetails->where('seller_id', Auth::user()->id)->first()->delivery_status;
    $payment_status = $order->orderDetails->where('seller_id', Auth::user()->id)->first()->payment_status;
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="modal-body gry-bg px-3 pt-0">
    <div class="py-4">
        <div class="row gutters-5 text-center aiz-steps">
            <div class="col @if($status == 'pending') active @else done @endif">
                <div class="icon">
                    <i class="las la-file-invoice"></i>
                </div>
                <div class="title fs-12">{{ translate('Order placed')}}</div>
            </div>
            <div class="col @if($status == 'confirmed') active @elseif($status == 'on_delivery' || $status == 'delivered') done @endif">
                <div class="icon">
                    <i class="las la-newspaper"></i>
                </div>
              <div class="title fs-12">{{ translate('Confirmed')}}</div>
            </div>
            <div class="col @if($status == 'on_delivery') active @elseif($status == 'delivered') done @endif">
                <div class="icon">
                    <i class="las la-truck"></i>
                </div>
                <div class="title fs-12">{{ translate('On delivery')}}</div>
            </div>
            <div class="col @if($status == 'delivered') done @endif">
                <div class="icon">
                    <i class="las la-clipboard-check"></i>
                </div>
                <div class="title fs-12">{{ translate('Delivered')}}</div>
            </div>
        </div>
    </div>
    @if (get_setting('product_manage_by_admin') == 0)
    <div class="row mt-5">
        @if($order->payment_type == 'cash_on_delivery')
            <div class="offset-lg-2 col-lg-4 col-sm-6">
                <div class="form-group">
                    <select class="form-control aiz-selectpicker form-control-sm"  data-minimum-results-for-search="Infinity" id="update_payment_status">
                        <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{ translate('Unpaid')}}</option>
                        <option value="paid" @if ($payment_status == 'paid') selected @endif>{{ translate('Paid')}}</option>
                    </select>
                    <label>{{ translate('Payment Status')}}</label>
                </div>
            </div>
        @endif
        <div class="col-lg-4 col-sm-6">
            <div class="form-group">
                <select class="form-control aiz-selectpicker form-control-sm"  data-minimum-results-for-search="Infinity" id="update_delivery_status">
                    <option value="pending" @if ($status == 'pending') selected @endif>{{ translate('Pending')}}</option>
                    <option value="confirmed" @if ($status == 'confirmed') selected @endif>{{ translate('Confirmed')}}</option>
                    <option value="on_delivery" @if ($status == 'on_delivery') selected @endif>{{ translate('On delivery')}}</option>
                    <option value="delivered" @if ($status == 'delivered') selected @endif>{{ translate('Delivered')}}</option>
                </select>
                <label>{{ translate('Delivery Status')}}</label>
            </div>
        </div>
    </div>
    @endif

    <div class="card mt-4">
        <div class="card-header">
          <b class="fs-15">{{ translate('Order Summary') }}</b>
             <br>
          @php
          $delivey_boy = App\User::find($order->assign_delivery_boy);
          @endphp
          @if($delivey_boy)
          <b class="fs-15">Name = {{ $delivey_boy->name }}</b>
        <b class="fs-15">Address = {{ $delivey_boy->address }}</b>
          @else
           <b class="fs-15">No Delivery Boy</b>
          @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-borderless">
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order Code')}}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Customer')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Email')}}:</td>
                            @if ($order->user_id != null)
                                <td>{{ $order->user->email }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping address')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->postal_code }}, {{ json_decode($order->shipping_address)->country }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table table-borderless">
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order date')}}:</td>
                            <td>{{ date('d-m-Y H:i A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order status')}}:</td>
                            <td>{{ translate($status) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Total order amount')}}:</td>
                            <td>{{ single_price($order->grand_total) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Contact')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->phone }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Payment method')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="card mt-4">
                <div class="card-header">
                  <b class="fs-15">{{ translate('Order Details') }}</b>
                </div>
                <div class="card-body pb-0">
                    <table class="table table-borderless table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="40%">{{ translate('Product')}}</th>
                                <th>{{ translate('Variation')}}</th>
                                <th>{{ translate('Quantity')}}</th>
                                <th>{{ translate('Delivery Type')}}</th>
                                <th>{{ translate('Price')}}</th>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                    <th>{{ translate('Refund')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if ($orderDetail->product != null)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->getTranslation('name') }}</a>
                                        @else
                                            <strong>{{  translate('Product Unavailable') }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $orderDetail->variation }}
                                    </td>
                                    <td>
                                        {{ $orderDetail->quantity }}
                                    </td>
                                    <td>
                                        @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                            {{  translate('Home Delivery') }}
                                        @elseif ($orderDetail->shipping_type == 'pickup_point')
                                            @if ($orderDetail->pickup_point != null)
                                                {{ $orderDetail->pickup_point->getTranslation('name') }} ({{  translate('Pickip Point') }})
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $orderDetail->price }}</td>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        <td>
                                            @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null)
                                                <button type="submit" class="btn btn-primary btn-sm" onclick="send_refund_request('{{ $orderDetail->id }}')">{{  translate('Send') }}</button>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                <b class="text-info">{{  translate('Pending') }}</b>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                <b class="text-success">{{  translate('Paid') }}</b>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header">
                  <b class="fs-15">{{ translate('Order Ammount') }}</b>
                </div>
                <div class="card-body pb-0">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Subtotal')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">{{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Shipping')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('shipping_cost')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Tax')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('tax')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Coupon')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->coupon_discount) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Total')}}</th>
                                <td class="text-right">
                                    <strong>
                                        <span>{{ single_price($order->grand_total) }}
                                        </span>
                                    </strong>
                                </td>
                            </tr>
                                 @if ($orderDetail->neck != null)
                                
                            <!---->
                            <tr>
                                <td class="w-50 fw-600">{{ translate('neck')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('Shoulder')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('Sleeve')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('R-sleeve')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('Length')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('Waist')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('Laps')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('Knee')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('Length')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="w-50 fw-600">{{ translate('R-leg')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">21</span>
                                </td>
                            </tr>
                            @endif
                            
                            <!---->
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#update_delivery_status').on('change', function(){
        var order_id = {{ $order->id }};
        var status = $('#update_delivery_status').val();
        $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
            $('#order_details').modal('hide');
            AIZ.plugins.notify('success', '{{ translate('Order status has been updated') }}');
            location.reload().setTimeOut(500);
        });
    });

    $('#update_payment_status').on('change', function(){
        var order_id = {{ $order->id }};
        var status = $('#update_payment_status').val();
        $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
            $('#order_details').modal('hide');
            //console.log(data);
            AIZ.plugins.notify('success', '{{ translate('Payment status has been updated') }}');
            location.reload().setTimeOut(500);
        });
    });
</script>
