@extends('layouts.front')

@section('content')


    {{--            <tr>--}}
    {{--                <td colspan="4"></td>--}}
    {{--                <td>{{ $total }}</td>--}}
    {{--            </tr>--}}
    {{--   --}}
    <div class="row">
        <div class="col-12">
            <h2>{{ __('Shop Cart') }}</h2>
            <hr>
        </div>
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{ __('Product') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Subtotal') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($cart as $item)
                    @php
                        $subtotal = $item['price'] * $item['amount'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>{{ $item['amount'] }}</td>
                        <td>{{ $subtotal }}</td>
                        <td>
                            <a href="{{ route('cart.remove', [ 'slug' => $item['slug']]) }}"
                               class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">{{ _('Total') }}</td>
                    <td colspan="1" class="text-right"> {{ $total }}</td>
                </tr>
                </tbody>
            </table>
            <hr>
            <a href="#" class="btn btn-lg btn-success float-right">{{ __('Confirm') }}</a>
            <a href="{{ route('cart.cancel') }}" class="btn btn-lg btn-danger float-left">{{ __('Cancel') }}</a>
        </div>
    </div>

@endsection
