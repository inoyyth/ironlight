<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\SeoService;

class SeoController extends Controller
{
    protected $seoService;

    public function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * Display SEO management dashboard.
     */
    public function index()
    {
        $seoData = $this->seoService->getSeoSettings();
        
        return view('admin.pages.seo', [
            'title' => 'Admin SEO - IronLight',
            'user' => Auth::guard('admin')->user(),
            'seoData' => $seoData
        ]);
    }

    /**
     * Update SEO settings.
     */
    public function update(Request $request)
    {
        $result = $this->seoService->updateSeoSettings($request);

        if ($result['success']) {
            return back()
                ->with('success', $result['message'])
                ->with('data', $result['data']);
        }

        return back()
            ->withInput()
            ->with('error', $result['message']);
    }
}
