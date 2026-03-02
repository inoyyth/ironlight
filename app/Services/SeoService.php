<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class SeoService
{
    private const REDIS_KEY = 'seo_settings';

    /**
     * Get SEO settings from Redis.
     *
     * @return array
     */
    public function getSeoSettings()
    {
        $seoSettings = Redis::get(self::REDIS_KEY);
        return $seoSettings ? json_decode($seoSettings, true) : [];
    }

    /**
     * Update SEO settings in Redis.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function updateSeoSettings($request)
    {
        $validated = $this->validateSeoData($request);

        try {
            Redis::select(0);
            Redis::set(self::REDIS_KEY, json_encode($validated));

            return [
                'success' => true,
                'message' => 'SEO settings updated successfully!',
                'data' => $validated
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update SEO settings: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Validate SEO request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function validateSeoData($request)
    {
        return $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_robots' => 'nullable|string',
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
    }

    /**
     * Get specific SEO field.
     *
     * @param string $field
     * @param mixed $default
     * @return mixed
     */
    public function getSeoField($field, $default = null)
    {
        $settings = $this->getSeoSettings();
        return $settings[$field] ?? $default;
    }

    /**
     * Get SEO data as array for API responses.
     *
     * @return array
     */
    public function getSeoArray()
    {
        return $this->getSeoSettings();
    }

    /**
     * Check if SEO settings exist.
     *
     * @return bool
     */
    public function seoSettingsExist()
    {
        return Redis::exists(self::REDIS_KEY);
    }

    /**
     * Clear SEO settings from Redis.
     *
     * @return bool
     */
    public function clearSeoSettings()
    {
        try {
            Redis::del(self::REDIS_KEY);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get meta tags for HTML head.
     *
     * @return array
     */
    public function getMetaTags()
    {
        $settings = $this->getSeoSettings();
        
        return [
            'title' => $settings['meta_title'] ?? '',
            'description' => $settings['meta_description'] ?? '',
            'keywords' => $settings['meta_keywords'] ?? '',
            'robots' => $settings['meta_robots'] ?? 'index, follow',
            'og_title' => $settings['og_title'] ?? $settings['meta_title'] ?? '',
            'og_description' => $settings['og_description'] ?? $settings['meta_description'] ?? '',
            'og_image' => $settings['og_image'] ?? '',
            'canonical_url' => $settings['canonical_url'] ?? '',
        ];
    }
}
