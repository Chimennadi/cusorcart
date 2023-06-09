<script src="//voguepay.com/js/voguepay.js"></script>

<script>
    closedFunction=function() {
        alert('window closed');
        location.href = '{{ env('APP_URL') }}'
    }

    successFunction=function(transaction_id) {
        location.href = '{{ env('APP_URL') }}'+'/vogue-pay/success/'+transaction_id
    }
    failedFunction=function(transaction_id) {
         location.href = '{{ env('APP_URL') }}'+'/vogue-pay/success/'+transaction_id
    }
</script>
@if (get_setting('voguepay_sandbox') == 1)
    <input type="hidden" id="merchant_id" name="v_merchant_id" value="demo">
@else
    <input type="hidden" id="merchant_id" name="v_merchant_id" value="{{ env('VOGUE_MERCHANT_ID') }}">
@endif

<script>

        window.onload = function(){
            pay3();
        }

        function pay3() {
         Voguepay.init({
             v_merchant_id: document.getElementById("merchant_id").value,
             total: '{{ Session::get('payment_data')['amount'] }}',
             cur: '{{\App\Currency::findOrFail(get_setting('system_default_currency'))->code}}',
             merchant_ref: 'ref123',
             loadText:'Custom load text',
             customer: {
                name: '{{ Auth::user()->name }}',

                email: '{{ Auth::user()->email }}',
                phone: '{{ Auth::user()->phone }}'
            },
             closed:closedFunction,
             success:successFunction,
             failed:failedFunction
         });
        }
</script>
