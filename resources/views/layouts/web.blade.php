<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ seo('meta_title') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Meta Tags -->
    <meta name="description" content="{{ seo('meta_description') }}">
    <meta name="keywords" content="{{ seo('meta_keywords') }}">
    <meta name="og:title" content="{{ seo('og_title') }}">
    <meta name="og:description" content="{{ seo('og_description') }}">
    <meta name="og:image" content="{{ seo('og_image') }}">
    <meta name="robots" content="{{ seo('meta_robots') ?? 'index,follow' }}">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <div class="relative">
        <!-- Navigation Header -->
        @include('layouts.includes.header')

        <!-- Main Content -->
        <main class="h-[calc(100vh-60px)] ">
            @yield('content')
            <!-- Footer -->
            @include('layouts.includes.footer')
        </main>

      
    </div>

    <!-- Scripts -->
    <script>
        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Close menus when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userMenu');
            const userMenuButton = event.target.closest('button[onclick="toggleUserMenu()"]');
            
            if (!userMenuButton && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
