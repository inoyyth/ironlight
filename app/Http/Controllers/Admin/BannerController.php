<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BannerService;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }
    /**
     * Display banner management form.
     */
    public function index()
    {
        $banner = $this->bannerService->getBannerForEdit();
        
        return view('admin.pages.banner', [
            'title' => 'Admin Banner - IronLight',
            'user' => Auth::guard('admin')->user(),
            'data' => $banner
        ]);
    }

    /**
     * Update banner information.
     */
    public function update(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $result = $this->bannerService->updateBanner($request, $adminId);

        if ($result['success']) {
            return redirect()
                ->route('admin.banners.index')
                ->with('success', $result['message']);
        }

        return back()
            ->withInput()
            ->with('error', $result['message']);
    }
}
