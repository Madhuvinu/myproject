@extends('admin.layout')

@section('title', 'About Us')
@section('page-title', 'About Us Management')

@section('content')
<div class="content-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>About Us Content</h2>
        @if($aboutUs)
            <a href="{{ route('admin.about-us.edit', $aboutUs) }}" class="btn btn-warning">Edit Content</a>
        @else
            <a href="{{ route('admin.about-us.create') }}" class="btn btn-success">Create About Us Content</a>
        @endif
    </div>
    
    @if($aboutUs)
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin-bottom: 15px;">{{ $aboutUs->title ?? 'About Us' }}</h3>
            
            @if($aboutUs->content)
                <div style="margin-bottom: 15px;">
                    <strong>Content:</strong>
                    <p style="margin-top: 5px;">{{ Str::limit($aboutUs->content, 200) }}</p>
                </div>
            @endif
            
            @if($aboutUs->images->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; margin-bottom: 15px;">
                    @foreach($aboutUs->images as $image)
                        <div>
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image" style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px; margin-top: 5px;">
                        </div>
                    @endforeach
                </div>
                <p style="margin-bottom: 15px;"><strong>Total Images:</strong> {{ $aboutUs->images->count() }}</p>
            @endif
            
            <div style="margin-top: 15px;">
                <span class="badge {{ $aboutUs->is_active ? 'badge-success' : 'badge-warning' }}">
                    {{ $aboutUs->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>
        
        <div>
            <a href="{{ route('admin.about-us.show', $aboutUs) }}" class="btn btn-primary">View Details</a>
            <form action="{{ route('admin.about-us.destroy', $aboutUs) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this content?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <p>No About Us content has been created yet.</p>
            <a href="{{ route('admin.about-us.create') }}" class="btn btn-success" style="margin-top: 20px;">Create About Us Content</a>
        </div>
    @endif
</div>
@endsection
