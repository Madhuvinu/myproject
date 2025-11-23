@extends('admin.layout')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="content-card">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Product Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
            @error('description')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="price">Price *</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                @error('price')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity *</label>
                <input type="number" id="stock_quantity" name="stock_quantity" min="0" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                @error('stock_quantity')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" value="{{ old('category', $product->category) }}">
            @error('category')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label>Current Image</label>
            @if($product->image)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; border-radius: 5px;">
                </div>
            @else
                <div style="color: #666;">No image uploaded</div>
            @endif
            <label for="image">Upload New Image (leave empty to keep current)</label>
            <input type="file" id="image" name="image" accept="image/*">
            @error('image')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                Active (Product will be visible to customers)
            </label>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-success">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</div>
@endsection

