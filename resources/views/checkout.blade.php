@extends('layouts.front')

@section('content')
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ __('Payment Data') }}</h2>
                <hr>
            </div>
        </div>
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="card-number">
                        {{ __('Credit Card Number') }}
                        <span class="brand"></span>
                    </label>
                    <input id="card-number" type="text" class="form-control" name="card_number">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="card-month">{{ __('Due Month') }}</label>
                    <input id="card-month" type="text" class="form-control" name="card_month">
                </div>
                <div class="col-md-4 form-group">
                    <label for="card-year">{{ __('Due Year') }}</label>
                    <input id="card-year'" type="text" class="form-control" name="card_year">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="card-cvv">{{ __('Verification Code') }}</label>
                    <input id="card-cvv" type="text" class="form-control" name="card_cvv">
                </div>
            </div>

            <input type="submit" class="btn btn-success btn-lg" value="{{ __('Pay') }}">
        </form>
    </div>

@endsection
@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script>
        const sessionId = '{{ session()->get('pagseguro_session_code') }}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        const cardNumber = document.querySelector('input[name=card_number]');
        const brand = document.querySelector('span.brand');

        cardNumber.addEventListener('keyup', function (e) {
            if (cardNumber.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function (response) {
                        console.log('success', response);

                        const brandImg = `<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${response.brand.name}.png'>`;
                        brand.innerHTML = brandImg;
                    },
                    error: function (err) {
                        console.log('err', err);
                    },
                    complete: function (response) {
                        console.log('complete', response);
                    }
                });
            }
        });
    </script>
@endsection
