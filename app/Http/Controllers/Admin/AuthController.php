<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        // If admin is already logged in, redirect to dashboard
        if ($this->authService->isAdminAuthenticated()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login', [
            'title' => 'Admin Login - IronLight',
            'description' => 'Secure admin login portal'
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $validation = $this->authService->validateLogin($request);
        
        if (!$validation['success']) {
            return back()
                ->withErrors($validation['errors'])
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $result = $this->authService->attemptLogin($credentials);

        if ($result['success']) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', $result['message']);
        }

        return back()
            ->withErrors($result['errors'])
            ->withInput();
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $result = $this->authService->logout($request);

        return redirect()->route('admin.login')
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }
}
