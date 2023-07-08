@extends('frontend.layouts.app')

@section('content')

<section style="background-color:white" class="pt-5 mb-4"></section>


@endsection

@section('script')
    <script type="text/javascript">
        function removeFromCartView(e, key){
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element){
            $.post('{{ route('cart.updateQuantity') }}', { 
                _token   :  '{{ csrf_token() }}', 
                id       :  key, 
                quantity :  element.value
            }, function(data){
                updateNavCart();
                $('#cart-summary').html(data);
            });
        }

        function showCheckoutModal(){
            $('#GuestCheckout').modal();
        }
    </script>
@endsection
