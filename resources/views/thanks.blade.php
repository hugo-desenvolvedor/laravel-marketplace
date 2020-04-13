@extends('layouts.front')

@section('content')
    <h2 class="alert alert-success">
        {{ __('Thank you') }}
    </h2>
    <h3>
        {{ __('Your order was processed. Code: :code', [ 'code' => request()->get('order') ]) }}
    </h3>
@endSection
