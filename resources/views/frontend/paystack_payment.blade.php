{{-- @php
    dd(Session::get('payment_details'));
@endphp --}}
@extends('frontend.layouts.app')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0
        }

        html {
            height: 100%
        }


        .card0 {
            margin: 50px 12px 40px 12px;
            border: 0
        }

        .card1 {
            margin: 0;
            padding: 0;
            object-fit: contain;
            height: 100%
        }

        #heading {
            font-size: 33px;
            color: #000000;
            padding-bottom: 20px;
        }

        .placeicon {
            font-family: fontawesome !important
        }

        .card2 {
            padding: 25px;
            padding-left: 35px;
            padding-right: 35px;
            margin: 0;
            height: 100%
        }

        .form-card .pay {
            font-weight: bold;
            color: lightgrey;
            text-transform: uppercase;
            font-size: 15px;
            letter-spacing: 2px;
        }

        .form-card input,
        .form-card textarea {
            padding: 5px 1px 10px 1px;
            border: none;
            border-bottom: 1px solid lightgrey;
            border-radius: 0px;
            margin-bottom: 35px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 20px;
            letter-spacing: 1px
        }

        .form-card input:focus,
        .form-card textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none;
            font-weight: bold;
            border-bottom: 1.5px solid lightgreen;
            padding-bottom: 9.5px;
            outline-width: 0
        }

        select.list-dt {
            border: none;
            outline: 0;
            border-bottom: 1px solid #ccc;
            padding: 12px 1px 10px 1px;
            margin: 2px 0px 30px 0px;
        }

        select#month {
            width: 50%;
        }

        select.list-dt:focus {
            border-bottom: 1.5px solid lightgreen;
        }

        .btn-success {
            color: #ffffff !important;
            margin-bottom: 25px !important;
        }
    </style>
    </head>

    <body>


        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-12 col-lg-10">
                    <div class="card card0 rounded-0">
                        <div class="row">
                            <div class="col-md-12 d-block p-0 box">
                                <div
                                    class="card rounded-0 border-0 card1 pr-xl-4 pr-lg-3 d-flex justify-content-center align-items-center">
                                    <img src="/assets/img/cards/paystack.png" width="340px">
                                </div>
                                <div class="form-card">
                                    <div style="display: none">
                                        <h2 id="heading" class="">Your payment details</h2>
                                        <label class="pay">Name</label> <input type="text"
                                            value="{{ $paymentDetails['name'] }}" readonly>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="pay">Email</label>
                                                <input type="email" id="email-address"
                                                    value="{{ $paymentDetails['email'] }}"readonly>
                                            </div>
                                            <div class="col-12">
                                                <label class="pay">Amount</label>
                                                <input id="amount" value="{{ $paymentDetails['amount'] }}" readonly>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" onclick="payWithPaystack()" class="btn btn-success"
                                                style="width:100%">PAY
                                                NOW</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>


        <script src="https://js.paystack.co/v1/inline.js"></script>

        <script>
            const paymentDetails = {!! json_encode($paymentDetails) !!};
            console.log(paymentDetails);

            function payWithPaystack() {
                let handler = PaystackPop.setup({

                    key: paymentDetails.public_key, // Replace with your public key

                    email: paymentDetails.email,

                    amount: paymentDetails.amount,

                    ref: `TRX-${new Date().getTime().toString()}`, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

                    // label: "Optional string that replaces customer email"

                    onClose: (e) => {
                        // handle response here
                        console.log(e);
                    },

                    callback: (res) => {
                        window.location.href = `/paystack/payment/callback${res.redirecturl}`
                        // console.log(res);
                    }

                });


                handler.openIframe();

            }
        </script>
    @endsection
