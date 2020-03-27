@extends('layouts.app')
@section('content')
<table class="table table-striped">
    <a href="{{{route('admin.products.create')}}}" class="btn btn-success">{{ __('Add Product') }}</a>
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Product') }}</th>
        <th>{{ __('Price') }}</th>
        <th>{{ __('Store') }}</th>
        <th>{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ isset($product->store) ? $product->store->name : '' }}</td>
            <td class="btn-group">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                &nbsp;<form action="{{{ route('admin.products.destroy', $product->id) }}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $products->links() }}
@endsection
