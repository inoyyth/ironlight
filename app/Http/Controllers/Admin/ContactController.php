<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ContactController extends Controller
{
   /**
     * Display Contact management dashboard.
     */
    public function index()
    {
        // Get contact settings from Redis
        $contactSettings = Redis::get('contact_settings');
        $contactData = $contactSettings ? json_decode($contactSettings, true) : [];
        
        return view('admin.pages.contact', [
            'title' => 'Admin Contact - IronLight',
            'user' => Auth::guard('admin')->user(),
            'contactData' => $contactData
        ]);
    }

    /**
     * Update contact settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email may not exceed 255 characters',
            'phone.max' => 'Phone may not exceed 50 characters',
            'address.max' => 'Address may not exceed 255 characters',
            'website.url' => 'Website must be a valid URL',
            'website.max' => 'Website may not exceed 255 characters',
            'linkedin.url' => 'LinkedIn must be a valid URL',
            'linkedin.max' => 'LinkedIn may not exceed 255 characters',
            'description.max' => 'Description may not exceed 255 characters',
            'subtitle.max' => 'Subtitle may not exceed 255 characters',
            'job_title.max' => 'Job title may not exceed 255 characters',
        ]);

        Redis::select(0);
        Redis::set('contact_settings', json_encode($validated));

        return back()->with('success', 'Contact settings updated successfully!');
    }
}
