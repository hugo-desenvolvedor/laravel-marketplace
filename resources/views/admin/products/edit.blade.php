@extends('layouts.app')
@section('content')
    <h1>{{ __('Edit Product') }}</h1>
    <form action="{{ action('Admin\\ProductController@update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">
                {{__('Name')}}
            </label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $product->name }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">
                {{__('Description')}}
            </label>
            <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') ?? $product->description }}">
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="body">
                {{__('Content')}}
            </label>
            <textarea type="text" id="body" name="body" class="form-control @error('body') is-invalid @enderror">{{ old('body') ?? $product->body }}</textarea>
            @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">
                {{__('Price')}}
            </label>
            <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') ?? $product->price }}">
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">
                {{__('Slug')}}
            </label>
            <input type="text" id="slug" name="slug" class="form-control"value="{{ $product->slug }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">{{ __('Save') }}</button>
        </div>
    </form>
@endsection
