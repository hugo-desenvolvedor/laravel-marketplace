@extends('layouts.app')

@section('content')
<h1>{{ __('Add Product') }}</h1>
<form action="{{ action('Admin\\ProductController@store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">
            {{__('Name')}}
        </label>
        <input type="text" id="name" name="name" class="form-control">
    </div>

    <div class="form-group">
        <label for="description">
            {{__('Description')}}
        </label>
        <input type="text" id="description" name="description" class="form-control">
    </div>

    <div class="form-group">
        <label for="body">
            {{__('Content')}}
        </label>
        <textarea type="text" id="body" name="body" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="price">
            {{__('Price')}}
        </label>
        <input type="text" id="price" name="price" class="form-control">
    </div>

    <div class="form-group">
        <label for="slug">
            {{__('Slug')}}
        </label>
        <input type="text" id="slug" name="slug" class="form-control">
    </div>

    <div class="form-group">
        <label for="user">
            {{__('Stores')}}
        </label>
        <select name="store" id="store" class="form-control">
            @foreach($stores as $store)
                <option value="{{$store->id}}">{{$store->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">{{ __('Save') }}</button>
    </div>
</form>
@endsection
