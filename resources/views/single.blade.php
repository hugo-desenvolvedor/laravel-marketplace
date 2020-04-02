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
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <h3>{{ $product->price }}</h3>
            <span>
                {{ __('Store') }} <a href="{{ route('admin.stores.index') }}">{{ $product->name }}</a>
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{ $product->body }}
        </div>
    </div>
@endsection
