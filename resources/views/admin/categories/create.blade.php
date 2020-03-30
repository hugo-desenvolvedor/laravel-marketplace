@extends('layouts.app')

@section('content')
    <h1>{{ __('Add Category') }}</h1>
    <form action="{{ action('Admin\\CategoryController@store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}">

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Description') }}</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                   value="{{ old('description') }}">

            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Slug') }}</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">{{ __('Add Category') }}</button>
        </div>
    </form>
@endsection
