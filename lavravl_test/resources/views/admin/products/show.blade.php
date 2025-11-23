@extends('admin.layout')

@section('title', 'Product Details')
@section('page-title', 'Product Details')

@section('content')
<div class="content-card">
    <div style="display: flex; gap: 30px; margin-bottom: 30px;">
        <div>
            @if($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 300px; border-radius: 8px;">
            @else
                <div style="width: 300px; height: 300px; background: #ddd; border-radius: 8px; display: flex; align-items: center; justify-content: center;">No Image</div>
            @endif
        </div>
        <div style="flex: 1;">
            <h2>{{ $product->name }}</h2>
            <p style="color: #666; margin: 10px 0;">{{ $product->description ?? 'No description' }}</p>
            <div style="margin: 20px 0;">
                <strong>Price:</strong> ${{ number_format($product->price, 2) }}<br>
                <strong>Stock:</strong> {{ $product->stock_quantity }}<br>
                <strong>Category:</strong> {{ $product->category ?? 'Uncategorized' }}<br>
                <strong>Status:</strong> 
                <span class="badge badge-{{ $product->is_active ? 'success' : 'danger' }}">
                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div style="margin-top: 20px;">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit Product</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection

