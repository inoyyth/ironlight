<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    /**
     * Handle CKEditor image upload
     */
    public function upload(Request $request)
    {
        // Validate the request
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'upload.required' => 'No file uploaded',
            'upload.image' => 'Uploaded file must be an image',
            'upload.mimes' => 'Image must be JPEG, PNG, JPG, or GIF',
            'upload.max' => 'Image size may not exceed 2MB'
        ]);

        try {
            // Handle the upload
            if ($request->hasFile('upload') && $request->file('upload')->isValid()) {
                $file = $request->file('upload');
                
                // Generate unique filename
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                
                // Store the file
                $path = $file->store('ckeditor-images', 'public');
                
                // Return CKEditor response
                return response()->json([
                    'url' => asset('storage/' . $path),
                    'uploaded' => 1,
                    'fileName' => basename($path)
                ]);
            }
            
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Upload failed'
                ]
            ], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Upload failed: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}
