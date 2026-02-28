@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">SEO Management</h1>
        <p class="text-gray-600">Manage your website's SEO settings and metadata</p>
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

    <!-- SEO Update Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.seos.update') }}" class="space-y-6">
            @csrf
            
            <!-- Basic SEO Settings -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic SEO Settings</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Title*
                            </label>
                            <input
                                type="text"
                                id="meta_title"
                                name="meta_title"
                                value="{{ old('meta_title', $seoData['meta_title'] ?? config('app.name', 'IronLight')) }}"
                                class="form-input w-full @error('meta_title') border-red-500 @enderror"
                                placeholder="Enter meta title"
                                maxlength="255"
                                required
                            >
                            @error('meta_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Description*
                            </label>
                            <textarea
                                id="meta_description"
                                name="meta_description"
                                rows="4"
                                class="form-input w-full @error('meta_description') border-red-500 @enderror"
                                placeholder="Enter meta description"
                                maxlength="500"
                                required
                            >{{ old('meta_description', $seoData['meta_description'] ?? '') }}</textarea>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Keywords*
                            </label>
                            <input
                                type="text"
                                id="meta_keywords"
                                name="meta_keywords"
                                value="{{ old('meta_keywords', $seoData['meta_keywords'] ?? '') }}"
                                class="form-input w-full @error('meta_keywords') border-red-500 @enderror"
                                placeholder="Enter keywords separated by commas"
                                maxlength="255"
                                required
                            >
                            @error('meta_keywords')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Open Graph Settings</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="og_title" class="block text-sm font-medium text-gray-700 mb-2">
                                OG Title
                            </label>
                            <input
                                type="text"
                                id="og_title"
                                name="og_title"
                                value="{{ old('og_title', $seoData['og_title'] ?? '') }}"
                                class="form-input w-full @error('og_title') border-red-500 @enderror"
                                placeholder="Enter Open Graph title"
                                maxlength="255"
                            >
                            @error('og_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="og_description" class="block text-sm font-medium text-gray-700 mb-2">
                                OG Description
                            </label>
                            <textarea
                                id="og_description"
                                name="og_description"
                                rows="4"
                                class="form-input w-full @error('og_description') border-red-500 @enderror"
                                placeholder="Enter Open Graph description"
                                maxlength="500"
                            >{{ old('og_description', $seoData['og_description'] ?? '') }}</textarea>
                            @error('og_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="og_image" class="block text-sm font-medium text-gray-700 mb-2">
                                OG Image URL
                            </label>
                            <input
                                type="url"
                                id="og_image"
                                name="og_image"
                                value="{{ old('og_image', $seoData['og_image'] ?? '') }}"
                                class="form-input w-full @error('og_image') border-red-500 @enderror"
                                placeholder="https://example.com/image.jpg"
                            >
                            @error('og_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Technical SEO</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="canonical_url" class="block text-sm font-medium text-gray-700 mb-2">
                                Canonical URL
                            </label>
                            <input
                                type="url"
                                id="canonical_url"
                                name="canonical_url"
                                value="{{ old('canonical_url', $seoData['canonical_url'] ?? '') }}"
                                class="form-input w-full @error('canonical_url') border-red-500 @enderror"
                                placeholder="https://example.com/canonical-url"
                            >
                            @error('canonical_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="robots_txt" class="block text-sm font-medium text-gray-700 mb-2">
                                Robots.txt Content
                            </label>
                            <textarea
                                id="robots_txt"
                                name="robots_txt"
                                rows="6"
                                class="form-input w-full font-mono text-sm @error('robots_txt') border-red-500 @enderror"
                                placeholder="User-agent: *
Disallow: /admin/
Allow: /"
                            >{{ old('robots_txt', $seoData['robots_txt'] ?? '') }}</textarea>
                            @error('robots_txt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Analytics & Tools</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="sitemap_enabled" class="block text-sm font-medium text-gray-700 mb-2">
                                <input
                                    type="checkbox"
                                    id="sitemap_enabled"
                                    name="sitemap_enabled"
                                    value="1"
                                    {{ old('sitemap_enabled', $seoData['sitemap_enabled'] ?? false) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                >
                                Enable XML Sitemap
                            </label>
                            @error('sitemap_enabled')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="google_analytics" class="block text-sm font-medium text-gray-700 mb-2">
                                Google Analytics ID
                            </label>
                            <input
                                type="text"
                                id="google_analytics"
                                name="google_analytics"
                                value="{{ old('google_analytics', $seoData['google_analytics'] ?? '') }}"
                                class="form-input w-full @error('google_analytics') border-red-500 @enderror"
                                placeholder="G-XXXXXXXXXX"
                            >
                            @error('google_analytics')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="google_search_console" class="block text-sm font-medium text-gray-700 mb-2">
                                Google Search Console URL
                            </label>
                            <input
                                type="url"
                                id="google_search_console"
                                name="google_search_console"
                                value="{{ old('google_search_console', $seoData['google_search_console'] ?? '') }}"
                                class="form-input w-full @error('google_search_console') border-red-500 @enderror"
                                placeholder="https://search.google.com/search-console"
                            >
                            @error('google_search_console')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bing_webmaster_tools" class="block text-sm font-medium text-gray-700 mb-2">
                                Bing Webmaster Tools URL
                            </label>
                            <input
                                type="url"
                                id="bing_webmaster_tools"
                                name="bing_webmaster_tools"
                                value="{{ old('bing_webmaster_tools', $seoData['bing_webmaster_tools'] ?? '') }}"
                                class="form-input w-full @error('bing_webmaster_tools') border-red-500 @enderror"
                                placeholder="https://www.bing.com/webmaster"
                            >
                            @error('bing_webmaster_tools')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="btn btn-primary px-6 py-3 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors"
                    >
                        Update SEO Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
