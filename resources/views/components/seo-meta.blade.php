{{-- Global SEO Meta Tags Component --}}
@if($globalSeo['meta_title'] ?? false)
    <title>{{ $globalSeo['meta_title'] }}</title>
@endif

@if($globalSeo['meta_description'] ?? false)
    <meta name="description" content="{{ $globalSeo['meta_description'] }}">
@endif

@if($globalSeo['meta_keywords'] ?? false)
    <meta name="keywords" content="{{ $globalSeo['meta_keywords'] }}">
@endif

@if($globalSeo['canonical_url'] ?? false)
    <link rel="canonical" href="{{ $globalSeo['canonical_url'] }}">
@endif

{{-- Open Graph Meta Tags --}}
@if($globalSeo['og_title'] ?? false)
    <meta property="og:title" content="{{ $globalSeo['og_title'] }}">
@endif

@if($globalSeo['og_description'] ?? false)
    <meta property="og:description" content="{{ $globalSeo['og_description'] }}">
@endif

@if($globalSeo['og_image'] ?? false)
    <meta property="og:image" content="{{ $globalSeo['og_image'] }}">
@endif

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">

{{-- Twitter Card Meta Tags --}}
@if($globalSeo['og_title'] ?? false)
    <meta name="twitter:title" content="{{ $globalSeo['og_title'] }}">
@endif

@if($globalSeo['og_description'] ?? false)
    <meta name="twitter:description" content="{{ $globalSeo['og_description'] }}">
@endif

@if($globalSeo['og_image'] ?? false)
    <meta name="twitter:image" content="{{ $globalSeo['og_image'] }}">
@endif

<meta name="twitter:card" content="summary_large_image">

{{-- Google Analytics --}}
@if($globalSeo['google_analytics'] ?? false)
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $globalSeo['google_analytics'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $globalSeo['google_analytics'] }}');
    </script>
@endif

{{-- Google Search Console --}}
@if($globalSeo['google_search_console'] ?? false)
    <meta name="google-site-verification" content="{{ $globalSeo['google_search_console'] }}">
@endif

{{-- Bing Webmaster Tools --}}
@if($globalSeo['bing_webmaster_tools'] ?? false)
    <meta name="msvalidate.01" content="{{ $globalSeo['bing_webmaster_tools'] }}">
@endif
