@extends('backend.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Withdraw Request')}}</h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th data-breakpoints="lg">#</th>
                        <th data-breakpoints="lg">{{translate('Date')}}</th>
                        <th>{{translate('Service')}}</th>
                        <th data-breakpoints="lg">{{translate('Service Charge')}}</th>
                        <th>{{translate('Order Number')}}</th>
                        <th data-breakpoints="lg">{{ translate('Total') }}</th>
                        <th data-breakpoints="lg">{{ translate('Delivery Status') }}</th>
                                                <th data-breakpoints="lg">{{ translate('Payment Status') }}</th>
                        <th data-breakpoints="lg" width="15%">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                             
                             @foreach($logics as $logic)
                              <?php $charge = App\ShippingDetail::where('id',$logic->service_id)->where('user_id',Auth::User()->id)->first() ?>
                              @if($charge || Auth::User()->user_type == 'admin')
                            <tr>
                                <td>#</td>
                                <td> @foreach(App\ShippingDetail::where('id',$logic->service_id)->get() as $service) {{$service->pickup_date}}  @endforeach</td>
                                <td>
                                    @foreach(App\ShippingDetail::where('id',$logic->service_id)->get() as $service) {{$service->service}}  @endforeach
                                </td>
                                <td>{{ $logic->service_charge }}</td>
                                <td>  @foreach(App\Order::where('id',$logic->order_id)->get() as $service) {{$service->code}}  @endforeach</td>
                                <td>
                                    @foreach(App\Order::where('id',$logic->order_id)->get() as $service) {{$service->grand_total}}  @endforeach
                                </td>
                                <td>
                                    @foreach(App\Order::where('id',$logic->order_id)->get() as $service) <span class="badge badge-inline badge-success">{{$service->delivery_status}}</span>  @endforeach
                                   
                                </td>
                                <td>
                                    @foreach(App\Order::where('id',$logic->order_id)->get() as $service) 
                                    
                                    @if($service->payment_status == 'rejected')
                                    <span class="badge badge-inline badge-danger">{{$service->payment_status}}</span>
                                    @elseif($service->payment_status == 'unpaid')
                                    <span class="badge badge-inline badge-primary">{{$service->payment_status}}</span>
                                    @else
                                     <span class="badge badge-inline badge-success">{{$service->payment_status}}</span>
                                     @endif
                                    
                                    @endforeach
                                   
                                </td>
                                <td class="">
                                 
    		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="#" onclick="document.getElementById('pay{{$logic->id}}').submit()"  title="{{ translate('Send Request') }}">
    		                                <i class="las la-money-bill"></i>
    		                            </a>
    		                            <form method="POST" action="{{URL::to('send_withdraw',$logic->id)}}" id="pay{{$logic->id}}">@csrf</form>
    		                           
                                  <!--  <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"   title="{{ translate('Message View') }}">-->
    		                            <!--    <i class="las la-eye"></i>-->
    		                            <!--</a>-->
    		                            
    		                            <!--<a href="#" class="btn btn-soft-primary btn-icon btn-circle btn-sm"  title="{{ translate('Payment History') }}">-->
    		                            <!--    <i class="las la-history"></i>-->
    		                            <!--</a>-->
    		                        </td>
                            </tr>
                      @endif
                  @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
              @if(!empty($charge))
                @if($charge || Auth::User()->user_type == 'admin')
                {{ $logics->links() }}
                @endif
              @endif
            </div>
        </div>
    </div>

@endsection

@section('modal')
<!-- payment Modal -->
<div class="modal fade" id="payment_modal">
  <div class="modal-dialog">
    <div class="modal-content" id="payment-modal-content">

    </div>
  </div>
</div>


<!-- Message View Modal -->
<div class="modal fade" id="message_modal">
  <div class="modal-dialog">
    <div class="modal-content" id="message-modal-content">

    </div>
  </div>
</div>


@endsection



@section('script')
  <script type="text/javascript">
      function show_seller_payment_modal(id, seller_withdraw_request_id){
          $.post('{{ route('withdraw_request.payment_modal') }}',{_token:'{{ @csrf_token() }}', id:id, seller_withdraw_request_id:seller_withdraw_request_id}, function(data){
              $('#payment-modal-content').html(data);
              $('#payment_modal').modal('show', {backdrop: 'static'});
              $('.demo-select2-placeholder').select2();
          });
      }

      function show_message_modal(id){
          $.post('{{ route('withdraw_request.message_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
              $('#message-modal-content').html(data);
              $('#message_modal').modal('show', {backdrop: 'static'});
          });
      }
  </script>

@endsection
