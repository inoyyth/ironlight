<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class BannerService
{
    /**
     * Get the first banner for display.
     *
     * @return \App\Models\Banner|null
     */
    public function getBanner()
    {
        return Banner::select('id', 'title', 'description', 'image')->first();
    }

    /**
     * Get banner for admin editing.
     *
     * @return \App\Models\Banner
     */
    public function getBannerForEdit()
    {
        return Banner::select('title', 'description', 'image')->first() ?: new Banner();
    }

    /**
     * Update or create banner with validation.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $adminId
     * @return array
     */
    public function updateBanner(Request $request, ?int $adminId = null)
    {
        $validated = $this->validateBannerData($request);

        try {
            $banner = $this->createOrUpdateBanner($validated, $request, $adminId);
            
            return [
                'success' => true,
                'message' => 'Banner updated successfully!',
                'banner' => $banner
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update banner: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Validate banner request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function validateBannerData(Request $request)
    {
        return $request->validate([
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
    }

    /**
     * Create or update banner with data.
     *
     * @param array $validated
     * @param \Illuminate\Http\Request $request
     * @param int|null $adminId
     * @return \App\Models\Banner
     */
    private function createOrUpdateBanner(array $validated, Request $request, ?int $adminId)
    {
        $banner = Banner::first() ?: new Banner();
        
        // Update banner fields
        $banner->title = $validated['title'];
        $banner->description = $validated['description'];
        
        // Handle image upload
        $this->handleImageUpload($request, $banner);
        
        // Set audit fields
        $banner->updated_by = $adminId;
        
        // If this is a new banner, set created_by
        if (!$banner->exists) {
            $banner->created_by = $adminId;
        }
        
        $banner->save();
        
        return $banner;
    }

    /**
     * Handle image upload and deletion.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Banner $banner
     * @return void
     */
    private function handleImageUpload(Request $request, Banner $banner)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete old image if exists
            $this->deleteOldImage($banner);
            
            // Upload new image
            $imagePath = $request->file('image')->store('banners', 'public');
            $banner->image = $imagePath;
        }
    }

    /**
     * Delete old banner image.
     *
     * @param \App\Models\Banner $banner
     * @return void
     */
    private function deleteOldImage(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }
    }

    /**
     * Get banner image URL.
     *
     * @param \App\Models\Banner|null $banner
     * @return string|null
     */
    public function getBannerImageUrl(?Banner $banner = null)
    {
        if (!$banner) {
            $banner = $this->getBanner();
        }
        
        return $banner && $banner->image 
            ? Storage::disk('public')->url($banner->image) 
            : null;
    }

    /**
     * Check if banner exists.
     *
     * @return bool
     */
    public function bannerExists()
    {
        return Banner::exists();
    }

    /**
     * Get banner data as array for API responses.
     *
     * @return array|null
     */
    public function getBannerArray()
    {
        $banner = $this->getBanner();
        
        if (!$banner) {
            return null;
        }
        
        return [
            'id' => $banner->id,
            'title' => $banner->title,
            'description' => $banner->description,
            'image_url' => $this->getBannerImageUrl($banner)
        ];
    }
}
