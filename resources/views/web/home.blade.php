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
                                {{ $solution[0]->title }}
                            </div>
                            <div class="text-sm">
                                {{ $solution[0]->description }}
                            </div>
                        </div>
                    </x-card>
                    <div class="text-white py-4">
                        <ul class="list-none text-2xl flex flex-col gap-2">
                            @foreach($solution as $sol)
                            @if($sol->id > 1)
                                <li class="border-b border-white py-8">{{ $sol->title }}</li>
                            @endif
                            @endforeach
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

<!-- Insights Section -->
<section id="insights" class="relative pt-10 pb-0 lg:pt-20 lg:pb-0 bg-white bg-repeat-y lg:bg-no-repeat lg:bg-cover bg-fixed" style="background-image:url('{{ asset('images/bg_parallax.png') }}')">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-black flex flex-col justify-start gap-4 lg:flex-row">
            <div class="p-6 flex-1 flex flex-col gap-6">
                <h3 class="text-2xl lg:text-base font-bold text-[#F9B236]">
                    Who this is for?
                </h3>
                <div class="flex flex-col gap-2 text-white text-2xl">
                    <p>Clear scope</p>
                    <p>Calm communication</p>
                    <p>Decisions made once, not daily</p>
                </div>
            </div>
            <div class="flex-1 flex flex-col gap-6">
                <h3 class="text-2xl lg:text-base font-bold text-white p-6">
                    Not for!
                </h3>
                <div class="flex flex-col gap-1 bg-white text-lg p-6">
                    <p>Unclear scope</p>
                    <p>Chaotic communication</p>
                    <p>Constant decision-making</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tech Stack Section -->
<section id="features" class="relative pt-10 pb-10 lg:pt-20 lg:pb-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-center items-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 text-center">
                What we are good at
            </h2>
            <div class="pt-10 grid grid-cols-2 gap-4 lg:flex lg:flex-wrap lg:justify-center lg:items-center lg:gap-4 lg:max-w-120">
                @foreach($tech as $tech)
                <a href="" class="bg-black border border-white text-white px-4 py-2 text-center">{{ $tech->title }}</a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="relative pt-10 pb-10 lg:pt-[40px] lg:pb-20 bg-black bg-no-repeat bg-contain bg-bottom lg:bg-no-repeat lg:bg-contain" style="background-image:url('{{ asset('images/contact_bg.png') }}')">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="pt-20 flex flex-col gap-6">
            <div class="text-white text-5xl font-bold text-center">
                Contact
            </div>
            <div class="text-white text-lg text-center">
                {{ $contactData['subtitle'] ?? '' }}
            </div>
            <div class="text-white text-lg text-center pt-5 border-b border-[#F9B236] w-auto mx-auto pl-6 pr-6 pb-2">
                {{ $contactData['email'] ?? 'hello@ironlight.ee' }}
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="relative pt-10 pb-10 lg:pt-20 lg:pb-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 items-start justify-start lg:items-center lg:flex-row">
            <div class="flex-1 lg:flex-[1.5] flex flex-col justify-start items-start gap-4">
                <img src="{{ asset('images/logo_2.png') }}" alt="ironlight" width="158" height="52"/>
                <p>{{ $contactData['job_title'] ?? '' }}</p>
                <div class="flex items-center gap-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_4038_3604" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                        <path d="M24 0H0V24H24V0Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_4038_3604)">
                        <path d="M17 21.25H7C3.35 21.25 1.25 19.15 1.25 15.5V8.5C1.25 4.85 3.35 2.75 7 2.75H17C20.65 2.75 22.75 4.85 22.75 8.5V15.5C22.75 19.15 20.65 21.25 17 21.25ZM7 4.25C4.14 4.25 2.75 5.64 2.75 8.5V15.5C2.75 18.36 4.14 19.75 7 19.75H17C19.86 19.75 21.25 18.36 21.25 15.5V8.5C21.25 5.64 19.86 4.25 17 4.25H7Z" fill="black"/>
                        <path d="M11.9998 12.87C11.1598 12.87 10.3098 12.61 9.65978 12.08L6.52978 9.57997C6.20978 9.31997 6.14978 8.84997 6.40978 8.52997C6.66978 8.20997 7.13978 8.14997 7.45978 8.40997L10.5898 10.91C11.3498 11.52 12.6398 11.52 13.3998 10.91L16.5298 8.40997C16.8498 8.14997 17.3298 8.19997 17.5798 8.52997C17.8398 8.84997 17.7898 9.32997 17.4598 9.57997L14.3298 12.08C13.6898 12.61 12.8398 12.87 11.9998 12.87Z" fill="black"/>
                        </g>
                    </svg>
                    <span>
                        {{ $contactData['email'] ?? 'hello@ironlight.ee' }}
                    </span>
                </div>
            </div>
            <div class="flex-1 flex flex-col gap-4">
                <p>{{ $contactData['description'] ?? '' }}</p>
                <a href="{{ $contactData['linkedin'] ?? '' }}" class="max-w-fit">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_4005_874)">
                        <path d="M25.9273 0H2.06719C0.924219 0 0 0.902344 0 2.01797V25.9766C0 27.0922 0.924219 28 2.06719 28H25.9273C27.0703 28 28 27.0922 28 25.982V2.01797C28 0.902344 27.0703 0 25.9273 0ZM8.30703 23.8602H4.15078V10.4945H8.30703V23.8602ZM6.22891 8.67344C4.89453 8.67344 3.81719 7.59609 3.81719 6.26719C3.81719 4.93828 4.89453 3.86094 6.22891 3.86094C7.55781 3.86094 8.63516 4.93828 8.63516 6.26719C8.63516 7.59062 7.55781 8.67344 6.22891 8.67344ZM23.8602 23.8602H19.7094V17.3633C19.7094 15.8156 19.682 13.8195 17.5492 13.8195C15.3891 13.8195 15.0609 15.5094 15.0609 17.2539V23.8602H10.9156V10.4945H14.8969V12.3211H14.9516C15.5039 11.2711 16.8602 10.1609 18.8781 10.1609C23.0836 10.1609 23.8602 12.9281 23.8602 16.5266V23.8602Z" fill="black"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_4005_874">
                        <rect width="28" height="28" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
