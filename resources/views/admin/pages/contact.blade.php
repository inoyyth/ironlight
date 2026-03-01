
@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Contact Management</h1>
        <p class="text-gray-600">Update the contact information displayed on the website</p>
    </div>
    <!-- Alert Success or Failure -->
    <x-alert />
    
    <!-- Contact Update Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.contacts.update') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Details</h3>

                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email*
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $contactData['email'] ?? '') }}"
                                class="form-input w-full @error('email') border-red-500 @enderror"
                                placeholder="hello@ironlight.ee"
                                maxlength="255"
                                required
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone
                            </label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone', $contactData['phone'] ?? '') }}"
                                class="form-input w-full @error('phone') border-red-500 @enderror"
                                placeholder="+1 555 000 0000"
                                maxlength="50"
                            >
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <input
                                type="text"
                                id="address"
                                name="address"
                                value="{{ old('address', $contactData['address'] ?? '') }}"
                                class="form-input w-full @error('address') border-red-500 @enderror"
                                placeholder="Street, City, Country"
                                maxlength="255"
                            >
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="job_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Job Title
                            </label>
                            <input
                                type="text"
                                id="job_title"
                                name="job_title"
                                value="{{ old('job_title', $contactData['job_title'] ?? '') }}"
                                class="form-input w-full @error('job_title') border-red-500 @enderror"
                                placeholder="Job Title"
                                maxlength="255"
                            >
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Links</h3>

                    <div class="space-y-4">
                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-2">
                                Website
                            </label>
                            <input
                                type="url"
                                id="website"
                                name="website"
                                value="{{ old('website', $contactData['website'] ?? '') }}"
                                class="form-input w-full @error('website') border-red-500 @enderror"
                                placeholder="https://example.com"
                                maxlength="255"
                            >
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                                LinkedIn
                            </label>
                            <input
                                type="url"
                                id="linkedin"
                                name="linkedin"
                                value="{{ old('linkedin', $contactData['linkedin'] ?? '') }}"
                                class="form-input w-full @error('linkedin') border-red-500 @enderror"
                                placeholder="https://www.linkedin.com/company/..."
                                maxlength="255"
                            >
                            @error('linkedin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                                Subtitle
                            </label>
                            <input
                                type="text"
                                id="subtitle"
                                name="subtitle"
                                value="{{ old('subtitle', $contactData['subtitle'] ?? '') }}"
                                class="form-input w-full @error('subtitle') border-red-500 @enderror"
                                placeholder="Enter subtitle"
                                maxlength="255"
                            >
                            @error('subtitle')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea
                                type="text"
                                id="description"
                                name="description"
                                class="form-input w-full @error('description') border-red-500 @enderror"
                                placeholder="Enter description"
                                maxlength="255"
                            >{{ old('description', $contactData['description'] ?? '') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="btn btn-primary px-6 py-3 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors"
                >
                    Update Contact Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
