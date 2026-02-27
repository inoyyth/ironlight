@extends('layouts.web')

@section('content')
<!-- Banner -->
<section class=" inset-0 w-full h-full">
    <div class="flex items-center justify-center h-screen bg-cover bg-center bg-no-repeat relative" style="background-image:url(https://uus.maagilineruum.ee/app/uploads/2023/09/aurora2-1.jpg)" data-bg="" data-was-processed="true">
        <div class="absolute inset-0 w-full h-full" id="particles-js">
            <canvas class="w-full h-full"></canvas>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full w-full relative">
            <div class="absolute top-[25%] w-full text-center text-white font-bold text-[40px]">Senior technical delivery</div>
            <div class="absolute bottom-[70px] text-left text-white">
                <div class="text-sm md:text-6xl font-bold mb-2 text-[#F9B236]">What we do</div>
                <ul class="list-none flex flex-col gap-1 text-lg">
                    <li>We design and build new systems.</li>
                    <li>We rebuild systems that matter.</li>
                    <li>We integrate things that were never meant to fit.</li>
                    <li>We take over live systems and make them stable.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section id="stats" class="py-20 bg-white relative">
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-normal mb-2">100+ Project</div>
                <div class="text-[#999999]">Global Coverage</div>
            </div>
            <div>
                <div class="text-4xl font-normal mb-2">50,000+ Users</div>
                <div class="text-[#999999]">Trusted Daily</div>
            </div>
            <div>
                <div class="text-4xl font-normal mb-2">4.8 Rating</div>
                <div class="text-[#999999]">Loved by customers</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="relative py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-16">
            <h3 class="sm:text-4xl md:text-base font-bold text-[#F9B236] mb-4">
                From Problem to Solution
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <x-card hover="true">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Lightning Fast</h3>
                    <p class="text-gray-600">Built with performance in mind, delivering blazing-fast experiences for your users.</p>
                </div>
            </x-card>

            <!-- Feature 2 -->
            <x-card hover="true">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Secure & Reliable</h3>
                    <p class="text-gray-600">Enterprise-grade security and reliability to protect your data and ensure uptime.</p>
                </div>
            </x-card>

            <!-- Feature 3 -->
            <x-card hover="true">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy to Use</h3>
                    <p class="text-gray-600">Intuitive interface and comprehensive documentation for seamless development.</p>
                </div>
            </x-card>

            <!-- Feature 4 -->
            <x-card hover="true">
                <div class="text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Customizable</h3>
                    <p class="text-gray-600">Flexible architecture that adapts to your unique business requirements.</p>
                </div>
            </x-card>

            <!-- Feature 5 -->
            <x-card hover="true">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">User Friendly</h3>
                    <p class="text-gray-600">Designed with users in mind, providing exceptional experiences at every touchpoint.</p>
                </div>
            </x-card>

            <!-- Feature 6 -->
            <x-card hover="true">
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Analytics</h3>
                    <p class="text-gray-600">Comprehensive analytics and insights to help you make data-driven decisions.</p>
                </div>
            </x-card>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-700 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Ready to Get Started?
        </h2>
        <p class="text-xl mb-8 text-blue-100">
            Join thousands of satisfied users who have transformed their business with IronLight.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-button variant="light" size="lg" href="{{ route('register') }}">
                Start Free Trial
            </x-button>
            <x-button variant="primary" size="lg" href="{{ route('contact') }}">
                Contact Sales
            </x-button>
        </div>
    </div>
</section>
@endsection
