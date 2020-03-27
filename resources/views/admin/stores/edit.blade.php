@extends('layouts.app')
@section('content')
    <h1>{{ __('Edit Store') }}</h1>
    <form action="{{ action('Admin\\StoreController@update', $store->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">
                {{__('Name')}}
            </label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $store->name }}">
        </div>

        <div class="form-group">
            <label for="description">
                {{__('Description')}}
            </label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $store->description }}">
        </div>

        <div class="form-group">
            <label for="phone">
                {{__('Phone')}}
            </label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $store->phone }}">
        </div>

        <div class="form-group">
            <label for="mobile_phone">
                {{__('Mobile Phone')}}
            </label>
            <input type="text" id="mobile_phone" name="mobile_phone" class="form-control"  value="{{ $store->mobile_phone }}">
        </div>

        <div class="form-group">
            <label for="slug">
                {{__('Slug')}}
            </label>
            <input type="text" id="slug" name="slug" class="form-control" value="{{ $store->slug }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">{{ __('Save') }}</button>
        </div>
    </form>
@endsection
