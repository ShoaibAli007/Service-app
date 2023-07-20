@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form id="payment-form" method="post" action="{{ route('payment.process') }}">
            @csrf
            <div class="form-group">
                <label for="cardholder-name">Cardholder Name</label>
                <input type="text" class="form-control" id="cardholder-name" name="cardholder_name" required>
            </div>
            <div class="form-group" id="card-element">
                <!-- Include the Card Element here -->
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
        </form>
    </div>

    <!-- Include the Braintree JavaScript SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
    <script>
        // Initialize the Drop-in UI
        var form = document.getElementById('payment-form');
        var client_token = "{{ Braintree\ClientToken::generate() }}";

        braintree.dropin.create({
            authorization: client_token,
            container: '#card-element'
        }, function (createErr, instance) {
            if (createErr) {
                console.error(createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    // Add the payment_method_nonce to the form and submit
                    var nonce = document.createElement('input');
                    nonce.setAttribute('type', 'hidden');
                    nonce.setAttribute('name', 'payment_method_nonce');
                    nonce.setAttribute('value', payload.nonce);
                    form.appendChild(nonce);

                    form.submit();
                });
            });
        });
    </script>
@endsection
