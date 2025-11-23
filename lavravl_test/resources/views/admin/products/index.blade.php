@extends('admin.layout')

@section('title', 'Products')
@section('page-title', 'Product Management')

@section('content')
<div class="content-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>All Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Add New Product</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        @else
                            <div style="width: 50px; height: 50px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">No Image</div>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category ?? 'Uncategorized' }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $product->stock_quantity < 10 ? 'danger' : 'success' }}">
                            {{ $product->stock_quantity }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $product->is_active ? 'success' : 'danger' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No products found. <a href="{{ route('admin.products.create') }}">Create one</a></td></tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
</div>
@endsection

