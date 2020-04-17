@extends('layouts.app')

@section('content')
    <row>
        <div class="col-12">
            <h2>{{ __('Orders') }}</h2>
            <hr>
        </div>
        <div class="col-12">
            <div id="accordion">
                @forelse($orders as $key => $order)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    {{ __('Order number') }}: {{ $order->reference }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne{{ $key }}"
                             class="collapse @if($key == 0) show @endif"
                             aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    @php
                                        $items = unserialize($order->items);
                                        $items = filterItemsByStoreId($items, auth()->user()->store->id);
                                    @endphp
                                    @foreach($items as $item)
                                        <li>
                                            {{ $item['name'] }}
                                            &nbsp;&vert;&nbsp;
                                            {{ $item['price'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">{{ __('No orders fulfilled') }}</div>
                @endforelse
            </div>
        </div>
        <div class="col-12">
            {{ $orders->links() }}
        </div>
    </row>
@endsection
