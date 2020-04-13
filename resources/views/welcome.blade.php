@extends('layouts.front')

@section('content')
    <div class="front row">
        @foreach($products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 98%; height: 100%">
                    @if($product->photos->count())
                        <img src="{{ 'storage/' . $product->photos->first()->image }}" alt="" class="card-img-top">
                    @else
                        <img src="{{ 'assets/img/no-photo.jpg' }}" alt="" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{ $product->name }}</h2>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">{{ $product->price }}</p>
                        <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success">
                            {{ __('Details') }}
                        </a>
                    </div>
                </div>
            </div>
            @if(($key + 1) % 3 == 0)
    </div>
    <div class="front row">
        @endif
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <h2>
                {{ __('Featured Stores') }}
            </h2>
        </div>
        @foreach($stores as $store)
            <div class="col-4">
                @if($store->logo)
                    <img class="img-fluid" src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}">
                @else
                    <img class="img-fluid" src="https://via.placeholder.com/640x480.png?text={{ $store->name }}" alt="{{ $store->name }}">
                @endif

                <h3>{{ $store->name }}</h3>
                <p>{{ $store->description }}</p>
                    <a href="{{ route('store.single', ['slug' => $store->slug]) }}" class="btn btn-sm btn-success">{{ __('Go to Store') }}</a>
            </div>
        @endforeach
    </div>
@endsection
