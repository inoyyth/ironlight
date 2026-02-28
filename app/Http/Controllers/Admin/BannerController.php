<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
     public function index()
    {
        // Get SEO settings from Redis
        $seoSettings = Redis::get('seo_settings');
        $seoData = $seoSettings ? json_decode($seoSettings, true) : [];
        
        return view('admin.seo', [
            'title' => 'Admin SEO - IronLight',
            'user' => Auth::guard('admin')->user(),
            'data' => $seoData
        ]);
    }

}
