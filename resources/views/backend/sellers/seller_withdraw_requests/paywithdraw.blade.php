@extends('backend.layouts.app')
@section('content')
<style>
    
.aiz-sidebar.left {
    z-index:1050 !important;
}
</style>

    <div class="modal fade show" id="payment_modal" style="z-index: 1040; display: block; padding-left: 17px;    background-color: #0000006b;" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content" id="payment-modal-content">
       
    <form class="form-horizontal" action="{{URL::to('paid_withdraw',$order->id)}}" method="POST" enctype="multipart/form-data">
        <input name="payment_status" type="hidden" value="paid">
        
         <?php
                               
                              
                               $seller = App\User::where('id', $order->seller_id)->first();
                              
                               
                               ?>
                           <input name="reqemail" type="hidden" value="{{$seller->email}}">
    @csrf
    <div class="modal-header">
    	<h5 class="modal-title h6">Pay to Logistic Partner</h5>
    	 <a href="/dashboard_withdraw" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
    </div>
    
    <div class="modal-body">
      <table class="table table-striped table-bordered">
          <tbody>
              @foreach(App\BankDetail::where('user_id',$order->user_id)->paginate(1) as $bank)
                <tr>
                                            <td>Bank Name</td>
                        <td>{{$bank->bankname}}</td>
                                    </tr>
                <tr>
                                    </tr>
                                    <tr>
                        <td>Account Number</td>
                        <td>{{$bank->acount_no}}</td>
                    </tr>
                    <tr>
                        <td>Account Title</td>
                        <td>{{$bank->acount_title}}</td>
                    </tr>
                    <tr>
                        <td>Branch Code</td>
                        <td>{{$bank->branch_code}}</td>
                    </tr>
                    <tr>
                        <td>Branch Address</td>
                        <td>{{$bank->branch_address}}</td>
                    </tr>
                    
                    @endforeach
                            </tbody>
        </table>
        

                    <input type="hidden" name="seller_id" value="2">
            <input type="hidden" name="payment_withdraw" value="withdraw_request">
            <input type="hidden" name="withdraw_request_id" value="1">
            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="amount">Service Charge</label>
                <div class="col-sm-9">
                  
                                            <input type="number" lang="en" min="0" step="0.01" name="amount" id="amount" value="{{$service = App\LogisticSale::where('order_id',$order->id)->first()->service_charge}}" class="form-control" required="">
                                            
                                    </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="payment_option">Payment method</label>
                <div class="col-sm-9">
                    <select name="payment_option" id="payment_option" class="form-control demo-select2-placeholder" required="">
                        <option value="">Select Payment Method</option>
                                                    <option value="cash">Cash</option>
                                                                            <option value="bank_payment">Bank Payment</option>
                                            </select>
                </div>
            </div>
        
    </div>
    <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Pay</button>
            
    </div>
</form>

<script>
$(document).ready(function(){
    $('#payment_option').on('change', function() {
      if ( this.value == 'bank_payment')
      {
        $("#txn_div").show();
      }
      else
      {
        $("#txn_div").hide();
      }
    });
    $("#txn_div").hide();
    AIZ.plugins.bootstrapSelect('refresh');
});
</script>
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
