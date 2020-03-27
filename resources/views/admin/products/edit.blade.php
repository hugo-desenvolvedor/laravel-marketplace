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
            <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label for="description">
                {{__('Description')}}
            </label>
            <input type="text" id="description" name="description" class="form-control"value="{{ $product->description }}">
        </div>

        <div class="form-group">
            <label for="body">
                {{__('Content')}}
            </label>
            <textarea type="text" id="body" name="body" class="form-control">{{ $product->body }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">
                {{__('Price')}}
            </label>
            <input type="text" id="price" name="price" class="form-control"value="{{ $product->price }}">
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
