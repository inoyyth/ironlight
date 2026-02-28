<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;


class SeoController extends Controller
{
    /**
     * Display SEO management dashboard.
     */
    public function index()
    {
        // Get SEO settings from Redis
        $seoSettings = Redis::get('seo_settings');
        $seoData = $seoSettings ? json_decode($seoSettings, true) : [];
        
        return view('admin.seo', [
            'title' => 'Admin SEO - IronLight',
            'user' => Auth::guard('admin')->user(),
            'seoData' => $seoData
        ]);
    }

    /**
     * Update SEO settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|url',
            'canonical_url' => 'nullable|url',
            'robots_txt' => 'nullable|string',
            'sitemap_enabled' => 'boolean',
            'google_analytics' => 'nullable|string',
            'google_search_console' => 'nullable|string',
            'bing_webmaster_tools' => 'nullable|string',
        ], [
            'meta_title.required' => 'Meta title is required',
            'meta_title.max' => 'Meta title may not exceed 255 characters',
            'meta_description.required' => 'Meta description is required',
            'meta_description.max' => 'Meta description may not exceed 500 characters',
            'meta_keywords.max' => 'Meta keywords may not exceed 255 characters',
            'og_title.max' => 'OG title may not exceed 255 characters',
            'og_description.max' => 'OG description may not exceed 500 characters',
            'og_image.url' => 'OG image must be a valid URL',
            'canonical_url.url' => 'Canonical URL must be a valid URL',
            'robots_txt.string' => 'Robots.txt content must be a string',
            'sitemap_enabled.boolean' => 'Sitemap setting must be true or false',
            'google_analytics.string' => 'Google Analytics must be a string',
            'google_search_console.string' => 'Google Search Console must be a string',
            'bing_webmaster_tools.string' => 'Bing Webmaster Tools must be a string',
        ]);

        // Save to redis to db 0 and key seo_settings
        Redis::select(0);
        Redis::set('seo_settings', json_encode($validated));
        
        // For now, just return success response with data from redis
        $data = Redis::get('seo_settings');
        // convert data to array
        $data = json_decode($data, true);

        return back()
            ->with('success', 'SEO settings updated successfully!')
            ->with('data', $data);
    }
}
