@extends('admin.layout')

@section('title', 'Create Product')
@section('page-title', 'Create New Product')

@section('content')
<div class="content-card">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Product Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            @error('description')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="price">Price *</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                @error('price')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity *</label>
                <input type="number" id="stock_quantity" name="stock_quantity" min="0" value="{{ old('stock_quantity', 0) }}" required>
                @error('stock_quantity')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" value="{{ old('category') }}">
            @error('category')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            @error('image')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Active (Product will be visible to customers)
            </label>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-success">Create Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</div>
@endsection

