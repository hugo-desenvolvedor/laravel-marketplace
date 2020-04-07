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
            <input type="hidden" name="card_brand">

            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="card-name">
                        {{ __('Name') }}
                    </label>
                    <input id="card-name" type="text" class="form-control" name="card_name" value="John Doe">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="card-number">
                        {{ __('Credit Card Number') }}
                        <span class="brand"></span>
                    </label>
                    <input id="card-number" type="text" class="form-control" name="card_number" value="4111111111111111">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="card-month">{{ __('Due Month') }}</label>
                    <input id="card-month" type="text" class="form-control" name="card_month" value="12">
                </div>
                <div class="col-md-4 form-group">
                    <label for="card-year">{{ __('Due Year') }}</label>
                    <input id="card-year'" type="text" class="form-control" name="card_year" value="2030">
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 form-group">
                    <label for="card-cvv">{{ __('Verification Code') }}</label>
                    <input id="card-cvv" type="text" class="form-control" name="card_cvv" value="123">
                </div>

                <div class="col-md-12 installments form-group"></div>
            </div>

            <input type="submit" class="btn btn-success btn-lg processCheckout" value="{{ __('Pay') }}">
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
        const cardNumber = $('input[name=card_number]');
        const brand = $('span.brand');
        const submitButton = $('input[type=submit].processCheckout');
        const amountTransaction = '{{ $total }}';

        cardNumber.on('keyup', function (e) {
            if (cardNumber.val().length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.val().substr(0, 6),
                    success: function (response) {
                        const brandName = response.brand.name;
                        const amount = amountTransaction;
                        const brandImageUrl = `https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${brandName}.png`;

                        $('input[name=card_brand]').val(brandName);
                        brand.html(`<img src='${brandImageUrl}'>`);

                        getInstallments(amount, brandName);
                    },
                    error: function (err) {
                        console.log('getBrand err', err);
                    }
                });
            }
        });

        submitButton.on('click', function (event) {
            event.preventDefault();
            console.log('submitButton click');

            PagSeguroDirectPayment.createCardToken({
                cardNumber: $('input[name=card_number]').val(),
                brand: $('input[name=card_brand]').val(),
                cvv: $('input[name=card_cvv]').val(),
                expirationMonth: $('input[name=card_month]').val(),
                expirationYear: $('input[name=card_year]').val(),
                success: function (response) {
                    console.log('createCardToken success', response);

                    processPayment(response.card.token);
                },
                error: function (error) {
                    console.log('createCardToken error', error.errors);
                }
            });
        });

        /**
         * Get data about installments: individual and total amount, quantity, taxes, etc.
         **/
        function getInstallments(amount, brand) {
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                brand: brand,
                maxInstallmentNoInterest: 0,
                success: function (response) {
                    console.log('getInstallments success', response);

                    const selectInstallments = drawSelectInstallments(response.installments['visa']);
                    $('div.installments').html(selectInstallments);

                },
                error: function (error) {
                    console.log('getInstallments error', error);
                }
            });
        }

        /**
         * Make installments drop down element
         *
         * @param installments
         * @returns {string}
         */
        function drawSelectInstallments(installments) {
            let select = '<label>{{ __('Installment Options') }}:</label>';
            select += '<select name="installments" class="form-control">';

            for (let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - {{ __('Total') . ":" }} ${l.totalAmount}</option>`;
            }
            select += '</select>';

            return select;
        }

        /**
         * Process the PagSeguro payment
         *
         * @param token
         */
        function processPayment(token) {
            console.log('$(\'select[name=installments]\').val()', $('select[name=installments]').val());

            let data = {
                card_token: token,
                card_name: $('input[name=card_name]').val(),
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: $('select[name=installments]').val(),
                '_token': '{{ csrf_token() }}'
            };

            $.ajax({
                type: 'POST',
                url: '{{ route('checkout.process') }}',
                data: data,
                dataType: 'json',
                success: function (response) {
                    console.log('processPayment success', response);
                    console.log('response.data.message', response.data.message);
                },
                error: function (error) {
                    console.log('processPayment error', error);
                }
            });
        }
    </script>
@endsection
