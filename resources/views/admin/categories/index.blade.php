@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-lg btn-success">{{ __('Add Category') }}</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td width="15%">
                    <div class="btn-group">
                        <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                        <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
