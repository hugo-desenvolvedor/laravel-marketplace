@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-6">
            @php
                $image = $product->photos->count() ? 'storage/' . $product->photos->first()->image : '/assets/img/no-photo.jpg';
            @endphp
            <img src="{{ $image }}" alt="{{ $product->slug }}" style="margin-bottom: 10px" class="img-fluid">

            @foreach($product->photos as $photo)
                <div class="col-4">
                    <img src="{{ 'storage/' . $photo->image }}" alt="" class="img-fluid">
                </div>
            @endforeach
        </div>
        <div class="col-6">
            <div>
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <h3>{{ $product->price }}</h3>

                <span>
                    {{ __('Store') }} <a href="{{ route('admin.stores.index') }}">{{ $product->name }}</a>
                </span>
            </div>
            <div class="product-add col-md-12">
                <hr>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{ $product->name }}">
                    <input type="hidden" name="product[price]" value="{{ $product->price }}">
                    <input type="hidden" name="product[slug]" value="{{ $product->slug }}">

                    <div class="form-group">
                        <label for="amount">{{ _('Amount') }}</label>
                        <input name="product[amount]" type="number" id="amount" class="form-control col-md-2" value="1">
                    </div>
                        <input type="submit" class="btn btn-lg btn-danger" value="{{ __('Buy') }}">
                </form>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{ $product->body }}
        </div>
    </div>
@endsection
