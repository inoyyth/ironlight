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

        <div class="grid justify-between grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-8">
            <!-- Feature 1 -->
             <div class="flex flex-col gap-4">
                <div>
                    <x-card hover="true" theme="warning">
                        <div class="flex flex-col gap-2">
                            <div class="text-2xl font-bold">
                                Workforce Time Tracking App
                            </div>
                            <div class="text-sm">
                                A comprehensive digital solution designed to monitor employee attendance, manage shift schedules, and generate accurate payroll data in real time.
                            </div>
                        </div>
                    </x-card>
                    <div class="text-white py-4">
                        <ul class="list-none text-2xl flex flex-col gap-2">
                            <li class="border-b border-white py-8">Worktime Analytics Dashboard</li>
                            <li class="border-b border-white py-8">HR Operations Automation Platform</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <img src="{{ asset('images/app-screen-shoot.png') }}"  alt="Workforce Time Tracking App">
            </div>
        </div>

        <div class="flex justify-between gap-6 py-20">
            <div class="flex-1">
                <h3 class="sm:text-4xl md:text-base font-bold text-[#F9B236] mb-4">
                    How it feels to work with us 
                </h3>
                <div class="flex flex-col gap-2 text-white text-2xl">
                    <p>Clear scope</p>
                    <p>Calm communication</p>
                    <p>Decisions made once, not daily</p>
                </div>
            </div>
            <div class="flex-1">
                <x-card hover="true" rounded="false" theme="warning">
                    <div class="flex flex-col gap-2 font-bold text-5xl">
                        <p>No chaos</p>
                        <p>No theatre</p>
                    </div>
                </x-card>
            </div>
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
            <x-button variant="light" size="lg" href="">
                Start Free Trial
            </x-button>
            <x-button variant="primary" size="lg" href="">
                Contact Sales
            </x-button>
        </div>
    </div>
</section>
@endsection
