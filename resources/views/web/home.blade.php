@extends('layouts.web')

@section('content')
<!-- Banner -->
<section class=" inset-0 w-full h-full">
    <div class="flex items-center justify-center h-screen bg-cover bg-center bg-no-repeat relative" style="background-image:url(https://uus.maagilineruum.ee/app/uploads/2023/09/aurora2-1.jpg)" data-bg="" data-was-processed="true">
        <div class="absolute inset-0 w-full h-full" id="particles-js">
            <canvas class="w-full h-full"></canvas>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full w-full relative">
            <div class="absolute top-[25%] left-0 w-full text-center text-white font-bold sm:text-[10px] md:text-[40px]">{{ $banner->title }}</div>
            <div class="absolute bottom-[70px] text-left text-white">
                <div class="mb-4 banner-description">{!! $banner->description !!}</div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section id="stats" class="pt-5 pb-5 bg-white relative lg:pt-20 lg:pb-20">
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-center items-center justify-center">
            @foreach($stats as $stat)
           <div class="border-b last:border-b-0 border-gray-300 h-[100px] flex flex-col items-center justify-center lg:border-b-0 lg:border-r lg:last:border-r-0 ">
                <div class="text-2xl lg:text-4xl font-normal mb-2">{{ $stat->value }} {{ $stat->name }}</div>
                <div class="text-sm lg:text-base text-[#999999]">{{ $stat->description }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="relative pt-10 pb-10 lg:pt-20 lg:pb-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h3 class="text-2xl lg:text-base font-bold text-[#F9B236] mb-4">
                From Problem to Solution
            </h3>
        </div>

        <div class="flex flex-col-reverse lg:flex-row gap-8">
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

        <div class="flex flex-col justify-between gap-6 pt-10 lg:pt-20 lg:flex-row">
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
                    <div class="flex flex-row gap-2 font-bold text-base lg:text-5xl lg:flex-col">
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
