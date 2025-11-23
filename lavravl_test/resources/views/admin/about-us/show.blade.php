@extends('admin.layout')

@section('title', 'View About Us')
@section('page-title', 'About Us Details')

@section('content')
<div class="content-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>About Us Content</h2>
        <div>
            <a href="{{ route('admin.about-us.edit', $aboutUs) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.about-us.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    
    <div style="background: #f8f9fa; padding: 30px; border-radius: 8px;">
        @if($aboutUs->title)
            <h3 style="margin-bottom: 20px; color: #333;">{{ $aboutUs->title }}</h3>
        @endif
        
        @if($aboutUs->content)
            <div style="margin-bottom: 30px;">
                <h4 style="margin-bottom: 10px; color: #666;">Content</h4>
                <p style="line-height: 1.8; color: #333;">{{ $aboutUs->content }}</p>
            </div>
        @endif
        
        @if($aboutUs->images->count() > 0)
            <div style="margin-bottom: 30px;">
                <h4 style="margin-bottom: 15px; color: #666;">Images ({{ $aboutUs->images->count() }})</h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
                    @foreach($aboutUs->images as $image)
                        <div>
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image" style="width: 100%; border-radius: 8px;">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        
        @if($aboutUs->mission)
            <div style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px; color: #666;">Mission</h4>
                <p style="line-height: 1.8; color: #333;">{{ $aboutUs->mission }}</p>
            </div>
        @endif
        
        @if($aboutUs->vision)
            <div style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px; color: #666;">Vision</h4>
                <p style="line-height: 1.8; color: #333;">{{ $aboutUs->vision }}</p>
            </div>
        @endif
        
        @if($aboutUs->values)
            <div style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px; color: #666;">Values</h4>
                <p style="line-height: 1.8; color: #333;">{{ $aboutUs->values }}</p>
            </div>
        @endif
        
        <div style="margin-top: 20px;">
            <span class="badge {{ $aboutUs->is_active ? 'badge-success' : 'badge-warning' }}">
                {{ $aboutUs->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
    </div>
</div>
@endsection
