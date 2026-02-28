@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('admin.stats.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">
                {{ $data ? 'Edit Stat' : 'Add New Stat' }}
            </h1>
        </div>
        <p class="text-gray-600">
            {{ $data ? 'Update the statistics information below.' : 'Fill in the information below to create a new statistic.' }}
        </p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $data ? 'Edit Stat Details' : 'Stat Information' }}
            </h3>
            <p class="text-sm text-gray-500">
                {{ $data ? 'Modify the stat details and save your changes.' : 'Enter the stat details to create a new entry.' }}
            </p>
        </div>
        
        <form action="{{ route('admin.stats.store') }}" method="POST" class="p-6">
            @csrf
            @if($data)
                <input type="hidden" name="id" value="{{ $data->id }}">
            @endif
            
            <!-- General Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                There were {{ $errors->count() }} error(s) with your submission:
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="form-label @error('name') text-red-600 @enderror">
                    Stat Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $data->name ?? '') }}"
                    class="form-input @error('name') border-red-500 ring-red-500 @enderror"
                    placeholder="e.g., Projects, Users, Rating"
                    required
                    @error('name')
                    aria-describedby="name-error"
                    @enderror
                >
                @error('name')
                    <p id="name-error" class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    The name of the statistic (e.g., Projects, Users, Rating)
                </p>
            </div>

            <!-- Value Field -->
            <div class="mb-6">
                <label for="value" class="form-label @error('value') text-red-600 @enderror">
                    Stat Value <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="value" 
                    name="value" 
                    value="{{ old('value', $data->value ?? '') }}"
                    class="form-input @error('value') border-red-500 ring-red-500 @enderror"
                    placeholder="e.g., 100+, 50,000+, 4.9/5"
                    required
                    @error('value')
                    aria-describedby="value-error"
                    @enderror
                >
                @error('value')
                    <p id="value-error" class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    The value to display for this statistic
                </p>
            </div>

            <!-- Description Field -->
            <div class="mb-6">
                <label for="description" class="form-label @error('description') text-red-600 @enderror">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3"
                    class="form-input @error('description') border-red-500 ring-red-500 @enderror"
                    placeholder="e.g., Global coverage, Trusted daily, Loved by customers"
                    required
                    @error('description')
                    aria-describedby="description-error"
                    @enderror
                >{{ old('description', $data->description ?? '') }}</textarea>
                @error('description')
                    <p id="description-error" class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    A brief description of what this statistic represents
                </p>
            </div>

            <!-- Form Actions -->
            <div class="py-4 flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.stats.index') }}" class="btn btn-light">
                    Cancel
                </a>
                
                <div class="flex space-x-3">
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $data ? 'Update Stat' : 'Create Stat' }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Additional Information -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Tips for Statistics</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <ul class="list-disc list-inside space-y-1">
                        <li>Keep stat names short and descriptive</li>
                        <li>Use compelling values that build trust</li>
                        <li>Write clear, concise descriptions</li>
                        <li>Statistics appear on the homepage and build credibility</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection