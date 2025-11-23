@extends('admin.layout')

@section('title', 'Edit About Us')
@section('page-title', 'Edit About Us Content')

@section('content')
<div class="content-card">
    <form action="{{ route('admin.about-us.update', $aboutUs) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $aboutUs->title) }}">
            @error('title')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="content">Main Content</label>
            <textarea id="content" name="content" rows="6">{{ old('content', $aboutUs->content) }}</textarea>
            @error('content')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <!-- Existing Images -->
        <div class="form-group">
            <label>Existing Images</label>
            <div id="existingImages" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                @foreach($aboutUs->images as $image)
                    <div style="position: relative; border: 1px solid #ddd; border-radius: 8px; padding: 10px; background: #f8f9fa;">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image" style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                        <form action="{{ route('admin.about-us.deleteImage', ['aboutUs' => $aboutUs->id, 'image' => $image->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="width: 100%; font-size: 0.9rem; padding: 5px;">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- New Images Upload -->
        <div class="form-group">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <label>Add New Images</label>
                <button type="button" onclick="addImageField()" class="btn btn-success" style="padding: 8px 15px; font-size: 0.9rem;">+ Add Image</button>
            </div>
            <div id="imageFields" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
                <!-- Image fields will be added here dynamically -->
            </div>
        </div>
        
        <div class="form-group">
            <label for="mission">Mission</label>
            <textarea id="mission" name="mission" rows="4">{{ old('mission', $aboutUs->mission) }}</textarea>
            @error('mission')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="vision">Vision</label>
            <textarea id="vision" name="vision" rows="4">{{ old('vision', $aboutUs->vision) }}</textarea>
            @error('vision')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="values">Values</label>
            <textarea id="values" name="values" rows="4">{{ old('values', $aboutUs->values) }}</textarea>
            @error('values')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $aboutUs->is_active) ? 'checked' : '' }}>
                Active
            </label>
        </div>
        
        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit" class="btn btn-success">Update About Us Content</button>
            <a href="{{ route('admin.about-us.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</div>

<script>
    let imageFieldCount = 0;
    
    function addImageField() {
        const container = document.getElementById('imageFields');
        const fieldId = 'image_' + imageFieldCount++;
        
        const fieldDiv = document.createElement('div');
        fieldDiv.id = fieldId;
        fieldDiv.style.cssText = 'position: relative; border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #f8f9fa;';
        fieldDiv.innerHTML = `
            <label style="display: block; margin-bottom: 10px; font-weight: 600;">Image</label>
            <input type="file" name="images[]" accept="image/*" style="width: 100%; margin-bottom: 10px;">
            <button type="button" onclick="removeImageField('${fieldId}')" class="btn btn-danger" style="width: 100%; font-size: 0.9rem; padding: 5px;">Remove</button>
        `;
        
        container.appendChild(fieldDiv);
    }
    
    function removeImageField(fieldId) {
        const field = document.getElementById(fieldId);
        if (field) {
            field.remove();
        }
    }
</script>
@endsection
