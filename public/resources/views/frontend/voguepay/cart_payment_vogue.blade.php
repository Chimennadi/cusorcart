<script src="//voguepay.com/js/voguepay.js"></script>

<script>
    closedFunction=function() {
        location.href = '{{ env('APP_URL') }}'
    }

    successFunction=function(transaction_id) {
        location.href = '{{ env('APP_URL') }}'+'/vogue-pay/success/'+transaction_id
    }
    failedFunction=function(transaction_id) {
        location.href = '{{ env('APP_URL') }}'+'/vogue-pay/failure/'+transaction_id
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
             total: '{{\App\Order::findOrFail(Session::get('order_id'))->grand_total}}',
             cur: '{{\App\Currency::findOrFail(get_setting('system_default_currency'))->code}}',
             merchant_ref: 'ref123',
             memo: 'Payment for shirt',
             developer_code: '5a61be72ab323',
             store_id: 1,
             loadText:'Custom load text',

             customer: {
                name: '{{ Session::get('shipping_info')['name'] }}',
                address: '{{ Session::get('shipping_info')['address'] }}',
                city: '{{ Session::get('shipping_info')['city'] }}',
                state: 'Customer state',
                zipcode: '{{ Session::get('shipping_info')['postal_code'] }}',
                email: '{{ Session::get('shipping_info')['email'] }}',
                phone: '{{ Session::get('shipping_info')['phone'] }}'
            },
             closed:closedFunction,
             success:successFunction,
             failed:failedFunction
         });
        }
</script>
