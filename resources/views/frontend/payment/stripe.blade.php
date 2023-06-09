<html>
  <head>
    <title>Stripe Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
      margin: auto;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <button id="checkout-button" style="display: none;"></button>
    <div class="loader"></div>
    <br>
    <br>
    <p style="width: 250px; margin: auto;">Don't close the tab. The payment is being processed . . .</p>
    <script type="text/javascript">
      // Create an instance of the Stripe object with your publishable API key
      var stripe = Stripe('{{ env("STRIPE_KEY") }}');
      var checkoutButton = document.getElementById('checkout-button');

      checkoutButton.addEventListener('click', function() {
        // Create a new Checkout Session using the server-side endpoint you
        // created in step 3.
        fetch('{{ route('stripe.get_token') }}', {
          method: 'POST',
        })
        .then(function(response) {
          return response.json();
        })
        .then(function(session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function(result) {
            console.log(result);
          // If `redirectToCheckout` fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using `error.message`.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function(error) {
          console.error('Error:', error);
        });
      });

      document.getElementById("checkout-button").click();
    </script>
  </body>
</html>
