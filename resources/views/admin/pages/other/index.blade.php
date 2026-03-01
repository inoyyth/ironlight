
@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Other</h1>
        <p class="text-gray-600">Manage Other content</p>
    </div>
    <x-alert />
    <div id="otherSuccess" class="hidden mb-6 bg-green-50 border border-green-200 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p id="otherSuccessMessage" class="text-sm font-medium text-green-800"></p>
            </div>
        </div>
    </div>

    <div id="otherError" class="hidden mb-6 bg-red-50 border border-red-200 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">There were error(s) with your submission:</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul id="otherErrorList" class="list-disc list-inside space-y-1"></ul>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form id="otherForm" method="POST" action="{{ route('admin.others.update') }}" class="space-y-6">
            @csrf

            <div>
                <label for="how_works" class="block text-sm font-medium text-gray-700 mb-2">How Works*</label>
                <textarea
                    id="how_works"
                    name="how_works"
                    rows="5"
                    class="form-input w-full ckeditor @error('how_works') border-red-500 @enderror"
                    required
                >{{ old('how_works', $other->how_works ?? '') }}</textarea>
                @error('how_works')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="this_for" class="block text-sm font-medium text-gray-700 mb-2">This For*</label>
                <textarea
                    id="this_for"
                    name="this_for"
                    rows="5"
                    class="form-input w-full ckeditor @error('this_for') border-red-500 @enderror"
                    required
                >{{ old('this_for', $other->this_for ?? '') }}</textarea>
                @error('this_for')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="this_not_for" class="block text-sm font-medium text-gray-700 mb-2">This Not For*</label>
                <textarea
                    id="this_not_for"
                    name="this_not_for"
                    rows="5"
                    class="form-input w-full ckeditor @error('this_not_for') border-red-500 @enderror"
                    required
                >{{ old('this_not_for', $other->this_not_for ?? '') }}</textarea>
                @error('this_not_for')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    id="otherSubmit"
                    class="btn btn-primary px-6 py-3 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors"
                >
                    Update Other
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        @include('admin.pages.other.tech')
        @include('admin.pages.other.solution')
    </div>
</div>





<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('otherForm');
    const submitBtn = document.getElementById('otherSubmit');

    const successBox = document.getElementById('otherSuccess');
    const successMsg = document.getElementById('otherSuccessMessage');

    const errorBox = document.getElementById('otherError');
    const errorList = document.getElementById('otherErrorList');

    function hideMessages() {
        successBox.classList.add('hidden');
        errorBox.classList.add('hidden');
        successMsg.textContent = '';
        errorList.innerHTML = '';
    }

    function showErrors(errors) {
        errorList.innerHTML = '';
        (errors || []).forEach((msg) => {
            const li = document.createElement('li');
            li.textContent = msg;
            errorList.appendChild(li);
        });
        errorBox.classList.remove('hidden');
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        hideMessages();

        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Saving...';

        try {
            document.querySelectorAll('textarea.ckeditor').forEach((el) => {
                if (el.ckeditorInstance) {
                    el.value = el.ckeditorInstance.getData();
                }
            });
            const formData = new FormData(form);

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const data = await response.json().catch(() => null);

            if (!response.ok) {
                if (response.status === 422 && data && data.errors) {
                    const flattened = Object.values(data.errors).flat();
                    showErrors(flattened);
                    return;
                }

                showErrors([data && data.message ? data.message : 'Failed to update.']);
                return;
            }

            successMsg.textContent = (data && data.message) ? data.message : 'Updated successfully!';
            successBox.classList.remove('hidden');
        } catch (err) {
            showErrors(['Failed to update. Please try again.']);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });

    async function jsonFetch(url, options) {
        const res = await fetch(url, {
            headers: {
                'Accept': 'application/json',
                ...(options && options.headers ? options.headers : {}),
            },
            ...options,
        });

        const data = await res.json().catch(() => null);
        return { res, data };
    }

    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }
});
</script>

@include('admin.components.ckeditor')
@endsection
