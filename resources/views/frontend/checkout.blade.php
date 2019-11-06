@extends('layouts.app')
@section('title', 'Potted Pan - Checkout')
@section('content')

<style>
    .StripeElement {
        box-sizing: border-box !important;

        height: 40px !important;

        padding: 10px 12px !important;

        border: 1px solid transparent !important;
        border-radius: 4px !important;
        background-color: white !important;

        box-shadow: 0 1px 3px 0 #e6ebf1 !important;
        -webkit-transition: box-shadow 150ms ease !important;
        transition: box-shadow 150ms ease !important;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df !important;
    }

    .StripeElement--invalid {
        border-color: #fa755a !important;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    .form-row {
        display: block !important;
    }

    .md-form label {
        position: relative;
        top: 0;
        left: 0;
        font-size: 1rem;
        color: #757575;
        cursor: text;
        transition: transform .2s ease-out, color .2s ease-out;
        transform: translateY(12px);
        transform-origin: 0 100%;
    }
</style>
<section>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ session()->get('success') }}
    </div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Fail!</h4>
        {{session()->get('error')}}
    </div>
    @endif
</section>
<main class="mt-5 pt-4">
    <div class="container wow fadeIn">

        <!-- Heading -->
        <h2 class="my-5 h2 text-center">Checkout form</h2>

        <!--Grid row-->
        <div class="row">

            <!--Grid column-->
            <div class="col-md-8 mb-4">

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                <form class="card-body" action="{{route('checkout.store')}}" method="post" id="payment-form">
                        @csrf
                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--firstName-->
                                <div class="md-form ">
                                    <input type="text" id="firstName" class="form-control">
                                    <label for="firstName" class="">First name</label>
                                </div>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--lastName-->
                                <div class="md-form">
                                    <input type="text" id="lastName" class="form-control">
                                    <label for="lastName" class="">Last name</label>
                                </div>

                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Username-->
                        <div class="md-form input-group pl-0 mb-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control py-0" placeholder="Username"
                                aria-describedby="basic-addon1">
                        </div>

                        <!--email-->
                        <div class="md-form mb-5">
                            <input name="email" type="text" id="email" class="form-control" placeholder="youremail@example.com">
                            <label for="email" class="">Email (optional)</label>
                        </div>

                        <!--address-->
                        <div class="md-form mb-5">
                            <input id="address_line1" type="text" id="address" class="form-control" placeholder="1234 Main St">
                            <label for="address" class="">Address</label>
                        </div>

                        <!--address-2-->
                        <div class="md-form mb-5">
                            <input type="text" id="address-2" class="form-control" placeholder="Apartment or suite">
                            <label for="address-2" class="">Address 2 (optional)</label>
                        </div>

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-lg-4 col-md-12 mb-4">

                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100" id="country">
                                    <option value="">Choose...</option>
                                    <option>United States</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-lg-4 col-md-6 mb-4">

                                <label for="state">State</label>
                                <select id="state" class="custom-select d-block w-100" id="state">
                                    <option value="">Choose...</option>
                                    <option>California</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-lg-4 col-md-6 mb-4">

                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" placeholder="">
                                <div class="invalid-feedback">
                                    Zip code.
                                </div>

                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <hr>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my
                                billing address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next
                                time</label>
                        </div>

                        <hr>

                        <div class="form-row">
                            <label for="cc-name">Name on card</label>
                            <input id="name_on_card" type="text" class="form-control" id="cc-name" placeholder="">
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>

                        {{-- <script src="https://js.stripe.com/v3/"></script> --}}

                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        {{-- <button>Submit Payment</button> --}}



                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

                    </form>

                </div>
                <!--/.Card-->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-4">

                <!-- Heading -->
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{Cart::content()->count()}}</span>
                </h4>

                <!-- Cart -->
                <ul class="list-group mb-3 z-depth-1">
                    @php
                    $total = 0;
                    @endphp
                    @foreach (Cart::content() as $item)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$item->name}}</h6>
                            <small class="text-muted">Qty: {{$item->qty}}</small>
                        </div>
                        <span class="text-muted">${{$item->price}}</span>
                        @php
                        $total = $total + (number_format($item->price) * number_format($item->qty));
                        @endphp
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{$total}}</strong>
                    </li>

                </ul>
                <!-- Cart -->

                <!-- Promo code -->
                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-secondary btn-md waves-effect m-0" type="button">Redeem</button>
                        </div>
                    </div>
                </form>
                <!-- Promo code -->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </div>
</main>
<!--Main layout-->
<script>
    var stripe = Stripe('pk_test_CI7bEhvxvpxaqFvrqQQaCb3Z00khoFEZcE');
    var elements = stripe.elements();

    // Create a Stripe client.
    var stripe = Stripe('pk_test_CI7bEhvxvpxaqFvrqQQaCb3Z00khoFEZcE');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
        color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style,
        hidePostalCode: true
        });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    var options = {
        name: document.getElementById('name_on_card').value,
        address_line1: document.getElementById('address_line1').value,
        address_country: document.getElementById('country').value,
        address_state: document.getElementById('state').value,
        address_zip: document.getElementById('zip').value,

    }

    stripe.createToken(card, options).then(function(result) {
        if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
        }
    });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
    }

</script>
@endsection
