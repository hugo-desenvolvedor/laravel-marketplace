@extends('layouts.app')

@section('content')
    <h1>{{ __('Edit Category') }}</h1>
    <form action="{{action('Admin\\CategoryController@update', ['category' => $category->id])}}" method="POST">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') ?? $category->name }}">

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Description') }}</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') ?? $category->description }}">
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Slug') }}</label>
            <input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">{{ __('Edit Category') }}</button>
        </div>
    </form>
@endsection
