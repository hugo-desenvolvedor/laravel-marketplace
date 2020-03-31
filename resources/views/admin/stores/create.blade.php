@extends('layouts.app')

@section('content')
<h1>{{ __('Add Store') }}</h1>
<form action="{{ action('Admin\\StoreController@store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name">
            {{__('Name')}}
        </label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">
            {{__('Description')}}
        </label>
        <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">
            {{__('Phone')}}
        </label>
        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
        @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="mobile_phone">
            {{__('Mobile Phone')}}
        </label>
        <input type="text" id="mobile_phone" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{ old('mobile_phone') }}">
        @error('mobile_phone')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>{{ __('Logo') }}</label>
        <input type="file" name="logo" class="form-control">
    </div>

    <div class="form-group">
        <label for="slug">
            {{__('Slug')}}
        </label>
        <input type="text" id="slug" name="slug" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">{{ __('Save') }}</button>
    </div>
</form>
@endsection
