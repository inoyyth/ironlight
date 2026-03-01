 <!-- Navigation Header -->
    <header class="bg-black shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <!-- <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center"> -->
                           <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                        <!-- </div> -->
                        <!-- <span class="text-xl font-semibold text-gray-900">IronLight</span> -->
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <!-- <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Home</a>
                   
                </div> -->

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    @guest
                        <!-- <a href="" class="text-gray-700 hover:text-blue-600 px-4 py-2 text-sm font-medium transition-colors">Sign In</a> -->
                        <a href="#contact" class="bg-white text-black px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">Contact Us</a>
                    @else
                        <div class="relative">
                            <button onclick="toggleUserMenu()" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 text-sm font-medium">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1">
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <form method="POST" action="">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign Out</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-blue-600 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-2">
                    <a href="#contact" class="text-white hover:text-blue-600 px-3 py-2 text-sm font-medium">Contact Us</a>
                    @guest
                        <div class="pt-2 border-t border-gray-200">
                            <a href="" class="block text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Sign In</a>
                            <a href="" class="block bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 text-center mt-2">Get Started</a>
                        </div>
                    @else
                        <div class="pt-2 border-t border-gray-200">
                            <a href="" class="block text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Dashboard</a>
                            <a href="" class="block text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Profile</a>
                            <form method="POST" action="">
                                @csrf
                                <button type="submit" class="block w-full text-left text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Sign Out</button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </header>