@extends('layouts.auth')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Forgot Password
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter your email address and we'll send you a link to reset your password
            </p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            @if ($errors->any())
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 0116 0 8 8 0 0116 0zm-3-1a1 1 0 00-1 1H9a1 1 0 000 2v3a1 1 0 002 2h8a1 1 0 002-2V9a1 1 0 00-2-2H9a1 1 0 00-1 1zm0 0a1 1 0 011-1h4a1 1 0 011 1v1a1 1 0 01-1 1H9a1 1 0 01-1-1v-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                There were {{ count($errors) }} error(s) with your submission:
                            </h3>
                            <ul class="mt-2 text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 mb-4">
                    <div class="flex">
                        <div class="shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 0116 0 8 8 0 0116 0zm3.707-9.293a1 1 0 00-1.414 1.414l-5.293 5.293a1 1 0 101.414 1.414l5.293-5.293a1 1 0 001.414-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">
                                {{ session('status') }}
                            </h3>
                        </div>
                    </div>
                </div>
            @endif

            <div class="rounded-md shadow-sm bg-white p-6">
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email Address
                        </label>
                        <div class="mt-1">
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                value="{{ old('email') }}"
                                class="form-input @error('email') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                placeholder="Enter your email"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="btn btn-primary w-full flex justify-center py-2 px-4"
                        >
                            <span class="ml-2">Send Password Reset Link</span>
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Remember your password?
                            <a href="{{ route('admin.login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                Back to login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
