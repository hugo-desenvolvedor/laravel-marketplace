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
                    <label for="card-number">{{ __('Credit Card Number') }}</label>
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
