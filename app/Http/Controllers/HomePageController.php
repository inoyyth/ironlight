<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $banner = \App\Models\Banner::first();
        return view('web.home', [
            'banner' => $banner
        ]);
        // return view('welcome');
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
