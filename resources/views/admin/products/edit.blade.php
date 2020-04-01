@extends('layouts.app')
@section('content')
    <h1>{{ __('Edit Product') }}</h1>
    <form action="{{ action('Admin\\ProductController@update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
            <label for="category">
                {{__('Categories')}}
            </label>
            <select name="categories[]" id="category" class="form-control @error('categories') is-invalid @enderror" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"  {{ $product->categories->contains($category) ? ' selected' : '' }}>{{$category->name}}</option>
                @endforeach
            </select>
            @error('categories')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Photos') }}</label>
            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
            @error('photos.*')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">{{ __('Save') }}</button>
        </div>
    </form>
    <div class="row">
        @foreach($product->photos as $photo)
            <div class="col-4 text-center">
                <img src="{{ asset('storage/' . $photo->image) }}" alt="" class="img-fluid">
                <form action="{{ route('admin.photo.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="photoName" value="{{ $photo->image }}">
                    <button type="submit" class="btn btn-lg btn-danger">
                        {{__('Delete')}}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
