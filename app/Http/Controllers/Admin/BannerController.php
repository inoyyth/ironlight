<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display banner management form.
     */
    public function index()
    {
        // Get first banner or create new instance
        $banner = Banner::first() ?: new Banner();
        
        return view('admin.banner', [
            'title' => 'Admin Banner - IronLight',
            'user' => Auth::guard('admin')->user(),
            'data' => $banner
        ]);
    }

    /**
     * Update banner information.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Banner title is required',
            'title.max' => 'Banner title may not exceed 255 characters',
            'description.required' => 'Banner description is required',
            'description.max' => 'Banner description may not exceed 1000 characters',
            'image.image' => 'Uploaded file must be an image',
            'image.mimes' => 'Image must be a JPEG, PNG, JPG, or GIF file',
            'image.max' => 'Image size may not exceed 2MB',
        ]);

        try {
            // Get or create banner
            $banner = Banner::first() ?: new Banner();
            
            // Update banner fields
            $banner->title = $validated['title'];
            $banner->description = $validated['description'];
            
            // Handle image upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete old image if exists
                if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                    Storage::disk('public')->delete($banner->image);
                }
                
                // Upload new image
                $imagePath = $request->file('image')->store('banners', 'public');
                $banner->image = $imagePath;
            }
            
            // Set audit fields
            $banner->updated_by = Auth::guard('admin')->id();
            
            // If this is a new banner, set created_by
            if (!$banner->exists) {
                $banner->created_by = Auth::guard('admin')->id();
            }
            
            // Save banner
            $banner->save();
            
            return redirect()
                ->route('admin.banner.index')
                ->with('success', 'Banner updated successfully!');
                
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update banner: ' . $e->getMessage());
        }
    }
}
