<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Home
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Features
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        About
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Contact
                    </a>
                </div>

                <!-- Auth Links -->
                <div class="hidden md:flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Register
                            </a>
                        @endif
                    @else
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Dashboard
                        </a>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white p-2" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                    Home
                </a>
                <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                    Features
                </a>
                <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                    About
                </a>
                <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                    Contact
                </a>
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white block px-3 py-2 rounded-md text-base font-medium">
                            Register
                        </a>
                    @endif
                @else
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white block px-3 py-2 rounded-md text-base font-medium">
                        Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        {{ config('app.name', 'Laravel') }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Building modern web applications with Laravel and modern technologies.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                        Quick Links
                    </h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                Features
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                Pricing
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                Documentation
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                Support
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                        Legal
                    </h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                Cookie Policy
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                <p class="text-center text-gray-500 dark:text-gray-400 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite('resources/js/app.js')
    @endif

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
