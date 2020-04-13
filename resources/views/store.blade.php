@extends('layouts.front')

@section('content')
    <div class="front row">
        <div class="col-4">
            @if($store->logo)
                <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/450x140?text=logo" alt="{{ $store->name }}" class="img-fluid">
            @endif
        </div>
        <div class="col-8">
            <h2>{{ __($store->name) }}</h2>
            <p>{{ __($store->description) }}</p>
            <p>
                <strong>{{ sprintf('%s:', __('Contact')) }}</strong>
                <span>{{ $store->phone }}</span>
                &nbsp;|&nbsp;
                <span>{{ $store->mobile_phone }}</span>
            </p>
        </div>

        <div class="col-12">
            <hr>
            <h3>{{ __('Products') }}</h3>
            <hr>
        </div>
        @empty($store->products->count())
            <div class="col-12">
                <h3 class="alert alert-warning">{{ __('Has no product in this category') }}</h3>
            </div>
        @endempty

        @foreach($store->products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 98%; height: 100%">
                    @if($product->photos->count())
                        <img src="{{ 'storage/' . $product->photos->first()->image }}" alt="" class="card-img-top">
                    @else
                        <img src="{{ '/assets/img/no-photo.jpg' }}" alt="" class="card-img-top">
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
@endsection
