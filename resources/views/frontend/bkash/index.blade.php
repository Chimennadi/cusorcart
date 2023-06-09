@extends('frontend.layouts.app')

@section('content')

    <button id="bKash_button" class="d-none">Pay With bKash</button>

@endsection

@section('script')
    @if (get_setting('bkash_sandbox', 1))
        <script src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
    @else
        <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
    @endif

    <script type="text/javascript">

        $(document).ready(function(){
            $('#bKash_button').trigger('click');
        });

        var paymentID = '';
        bKash.init({
        paymentMode: 'checkout', //fixed value ‘checkout’
        //paymentRequest format: {amount: AMOUNT, intent: INTENT}
        //intent options
        //1) ‘sale’ – immediate transaction (2 API calls)
        //2) ‘authorization’ – deferred transaction (3 API calls)
        paymentRequest: {
            amount: '{{ Session::get('payment_amount') }}', //max two decimal points allowed
            intent: 'sale'
        },
        createRequest: function(request) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method
        $.ajax({
          url: '{{ route('bkash.checkout') }}',
          type: 'POST',
          contentType: 'application/json',
          success: function(data) {
            //console.log(data);
            data = JSON.parse(data);
            if (data && data.paymentID != null) {
                paymentID = data.paymentID;
                bKash.create().onSuccess(data); //pass the whole response data in bKash.create().onSucess() method as a parameter
            } else {
                AIZ.plugins.notify('warning', result.errorMessage);
                bKash.create().onError();
            }
          },
          error: function() {
            bKash.create().onError();
          }
        });
        },
        executeRequestOnAuthorization: function() {
        $.ajax({
          url: '{{ route('bkash.excecute') }}',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            "paymentID": paymentID
          }),
          success: function(data) {
            //console.log(data);
            result = JSON.parse(data);
            if (result && result.paymentID != null) {
                window.location.href = "{{ route('bkash.success') }}?payment_details="+data; //Merchant’s success page
            } else {
                AIZ.plugins.notify('warning', result.errorMessage);
                bKash.execute().onError();
            }
          },
          error: function() {
            bKash.execute().onError();
          }
        });
        }
        });
    </script>
@endsection
