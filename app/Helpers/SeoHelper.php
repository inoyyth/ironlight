<?php

if (!function_exists('seo')) {
    /**
     * Get SEO data globally from Redis
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    function seo($key = null, $default = null)
    {
        static $seoData = null;
        
        // Cache SEO data for this request
        if ($seoData === null) {
            $seoSettings = \Illuminate\Support\Facades\Redis::get('seo_settings');
            $seoData = $seoSettings ? json_decode($seoSettings, true) : [];
        }
        
        // Return specific key or all data
        if ($key === null) {
            return $seoData;
        }
        
        return $seoData[$key] ?? $default;
    }
}

if (!function_exists('meta_title')) {
    /**
     * Get meta title from SEO settings
     *
     * @param string $default
     * @return string
     */
    function meta_title($default = null)
    {
        return seo('meta_title', $default ?? config('app.name', 'IronLight'));
    }
}

if (!function_exists('meta_description')) {
    /**
     * Get meta description from SEO settings
     *
     * @param string $default
     * @return string
     */
    function meta_description($default = '')
    {
        return seo('meta_description', $default);
    }
}

if (!function_exists('meta_keywords')) {
    /**
     * Get meta keywords from SEO settings
     *
     * @param string $default
     * @return string
     */
    function meta_keywords($default = '')
    {
        return seo('meta_keywords', $default);
    }
}

if (!function_exists('og_title')) {
    /**
     * Get OG title from SEO settings
     *
     * @param string $default
     * @return string
     */
    function og_title($default = null)
    {
        return seo('og_title', $default ?? meta_title());
    }
}

if (!function_exists('og_description')) {
    /**
     * Get OG description from SEO settings
     *
     * @param string $default
     * @return string
     */
    function og_description($default = null)
    {
        return seo('og_description', $default ?? meta_description());
    }
}

if (!function_exists('og_image')) {
    /**
     * Get OG image from SEO settings
     *
     * @param string $default
     * @return string
     */
    function og_image($default = '')
    {
        return seo('og_image', $default);
    }
}

if (!function_exists('canonical_url')) {
    /**
     * Get canonical URL from SEO settings
     *
     * @param string $default
     * @return string
     */
    function canonical_url($default = '')
    {
        return seo('canonical_url', $default);
    }
}

if (!function_exists('google_analytics')) {
    /**
     * Get Google Analytics ID from SEO settings
     *
     * @param string $default
     * @return string
     */
    function google_analytics($default = '')
    {
        return seo('google_analytics', $default);
    }
}
