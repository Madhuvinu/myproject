<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutUs = AboutUs::with('images')->first();
        return view('admin.about-us.index', compact('aboutUs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        // Remove images from validated array as we'll handle them separately
        unset($validated['images']);

        $aboutUs = AboutUs::create($validated);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('about-us', 'public');
                AboutUsImage::create([
                    'about_us_id' => $aboutUs->id,
                    'image_path' => $imagePath,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.about-us.index')
            ->with('success', 'About Us content created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs)
    {
        $aboutUs->load('images');
        return view('admin.about-us.show', compact('aboutUs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutUs)
    {
        $aboutUs->load('images');
        return view('admin.about-us.edit', compact('aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $aboutUs)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        // Remove images from validated array as we'll handle them separately
        unset($validated['images']);

        $aboutUs->update($validated);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $existingImagesCount = $aboutUs->images()->count();
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('about-us', 'public');
                AboutUsImage::create([
                    'about_us_id' => $aboutUs->id,
                    'image_path' => $imagePath,
                    'order' => $existingImagesCount + $index,
                ]);
            }
        }

        return redirect()->route('admin.about-us.index')
            ->with('success', 'About Us content updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        // Delete all associated images
        foreach ($aboutUs->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $aboutUs->delete();

        return redirect()->route('admin.about-us.index')
            ->with('success', 'About Us content deleted successfully!');
    }

    /**
     * Delete a single image
     */
    public function deleteImage(AboutUs $aboutUs, AboutUsImage $image)
    {
        if ($image->about_us_id !== $aboutUs->id) {
            abort(403);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->back()
            ->with('success', 'Image deleted successfully!');
    }
}
