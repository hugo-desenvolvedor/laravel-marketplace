@extends('layouts.app')
@section('content')
<table class="table table-striped">
    <a href="{{{route('admin.stores.create')}}}" class="btn btn-success">{{ __('Add Store') }}</a>
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Store') }}</th>
        <th>{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stores as $store)
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
    @endforeach
    </tbody>
</table>
{{ $stores->links() }}
@endsection