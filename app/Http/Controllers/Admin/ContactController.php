<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ContactService;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display Contact management dashboard.
     */
    public function index()
    {
        $contactData = $this->contactService->getContactSettings();
        
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
        $result = $this->contactService->updateContactSettings($request);

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()
            ->withInput()
            ->with('error', $result['message']);
    }
}
