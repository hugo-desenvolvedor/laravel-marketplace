@extends('layouts.app')
@section('content')
    <table class="table table-striped">
        @if(!$store)
            <a href="{{{route('admin.stores.create')}}}" class="btn btn-success">{{ __('Add Store') }}</a>
        @else
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Store') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $store->id }}</td>
            <td>{{ $store->name }}</td>
            <td class="btn-group">
                <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                &nbsp;
                <form action="{{{ route('admin.stores.destroy', $store->id) }}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>
    @endif
@endsection
