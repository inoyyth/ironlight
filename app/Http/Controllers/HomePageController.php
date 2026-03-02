<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tech;
use App\Models\Solution;
use App\Services\BannerService;
use App\Services\ContactService;
use App\Services\StatService;
use App\Services\OtherService;
use Illuminate\Support\Facades\Redis;

class HomePageController extends Controller
{
    protected $bannerService;
    protected $contactService;
    protected $statService;
    protected $otherService;

    public function __construct(
        BannerService $bannerService,
        ContactService $contactService,
        StatService $statService,
        OtherService $otherService
    ) {
        $this->bannerService = $bannerService;
        $this->contactService = $contactService;
        $this->statService = $statService;
        $this->otherService = $otherService;
    }
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $banner = $this->bannerService->getBanner();
        $stats = $this->statService->getHomepageStats();
        $homepageData = $this->otherService->getHomepageData();
        $contactData = $this->contactService->getContactSettings();
        
        return view('web.home', [
            'banner' => $banner,
            'stats' => $stats,
            'contactData' => $contactData,
            'tech' => $homepageData['tech'],
            'solution' => $homepageData['solution'],
        ]);
    }

    /**
     * Display the login page.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('web.login', [
            'title' => 'Login - IronLight',
            'description' => 'Sign in to your IronLight account'
        ]);
    }

    /**
     * Display the register page.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('web.register', [
            'title' => 'Register - IronLight',
            'description' => 'Create your IronLight account'
        ]);
    }

    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('web.about', [
            'title' => 'About Us - IronLight',
            'description' => 'Learn more about IronLight and our mission'
        ]);
    }

    /**
     * Display the services page.
     *
     * @return \Illuminate\View\View
     */
    public function services()
    {
        return view('web.services', [
            'title' => 'Services - IronLight',
            'description' => 'Explore our comprehensive services'
        ]);
    }

    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('web.contact', [
            'title' => 'Contact Us - IronLight',
            'description' => 'Get in touch with the IronLight team'
        ]);
    }

    /**
     * Display the privacy policy page.
     *
     * @return \Illuminate\View\View
     */
    public function privacyPolicy()
    {
        return view('web.privacy', [
            'title' => 'Privacy Policy - IronLight',
            'description' => 'IronLight privacy policy and data protection'
        ]);
    }
}
