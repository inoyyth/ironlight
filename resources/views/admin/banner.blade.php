@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Banner Management</h1>
        <p class="text-gray-600">Manage your website's banner content and images</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} error(s) with your submission:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Banner Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.banners.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Banner Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Banner Information</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Banner Title*
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $data->title ?? '') }}"
                                class="form-input w-full @error('title') border-red-500 @enderror"
                                placeholder="Enter banner title"
                                required
                            >
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Banner Description*
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="form-input w-full @error('description') border-red-500 @enderror"
                                placeholder="Enter banner description"
                                required
                            >{{ old('description', $data->description ?? '') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Banner Image</h3>
                    
                    <div class="space-y-4">
                        <!-- Current Image Preview -->
                        @if($data && $data->image)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Image
                                </label>
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $data->image) }}" 
                                         alt="Current Banner Image" 
                                         class="w-full h-48 object-cover rounded-lg border border-gray-300"
                                         onerror="this.src='https://via.placeholder.com/800x400?text=Current+Banner+Image'">
                                    <div class="mt-2">
                                        <span class="text-sm text-gray-500">{{ $data->image }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Image Upload -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload New Image
                            </label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                class="form-input w-full @error('image') border-red-500 @enderror"
                            >
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                Accepted formats: JPG, PNG, GIF. Max size: 2MB.
                            </p>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                New Image Preview
                            </label>
                            <img id="previewImg" src="" alt="New Banner Image" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">
                    Cancel
                </a>
                <button
                    type="submit"
                    class="btn btn-primary px-6 py-3 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors"
                >
                    Update Banner
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Check file size (2MB limit)
            if (file.size > 2 * 1024 * 1024) {
                alert('Image size must be less than 2MB');
                imageInput.value = '';
                imagePreview.classList.add('hidden');
                return;
            }

            // Check file type
            if (!file.type.match('image.*')) {
                alert('Please select an image file');
                imageInput.value = '';
                imagePreview.classList.add('hidden');
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('hidden');
        }
    });
});
</script>
@endsection