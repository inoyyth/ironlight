<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class AuthService
{
    /**
     * Validate login credentials.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function validateLogin($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email address is required',
            'email.email' => 'Please provide a valid email address',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ];
        }

        return ['success' => true];
    }

    /**
     * Attempt admin login.
     *
     * @param array $credentials
     * @return array
     */
    public function attemptLogin($credentials)
    {
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            
            return [
                'success' => true,
                'message' => 'Welcome back, ' . $admin->name . '!',
                'user' => $admin
            ];
        }

        return [
            'success' => false,
            'message' => 'The provided credentials do not match our records.',
            'errors' => ['email' => 'The provided credentials do not match our records.']
        ];
    }

    /**
     * Logout admin user.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function logout($request)
    {
        try {
            Auth::guard('admin')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return [
                'success' => true,
                'message' => 'You have been logged out successfully.'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to logout: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Check if admin is authenticated.
     *
     * @return bool
     */
    public function isAdminAuthenticated()
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get current authenticated admin.
     *
     * @return \App\Models\Admin|null
     */
    public function getCurrentAdmin()
    {
        return Auth::guard('admin')->user();
    }

    /**
     * Get admin ID.
     *
     * @return int|null
     */
    public function getAdminId()
    {
        return Auth::guard('admin')->id();
    }

    /**
     * Validate admin registration data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function validateRegistration($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Name is required',
            'name.max' => 'Name may not exceed 255 characters',
            'email.required' => 'Email address is required',
            'email.email' => 'Please provide a valid email address',
            'email.unique' => 'Email address is already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ];
        }

        return ['success' => true];
    }

    /**
     * Create new admin account.
     *
     * @param array $data
     * @return array
     */
    public function createAdmin($data)
    {
        try {
            $admin = Admin::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return [
                'success' => true,
                'message' => 'Admin account created successfully!',
                'data' => $admin
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create admin account: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Update admin password.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function updatePassword($request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Current password is required',
            'password.required' => 'New password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ];
        }

        $admin = $this->getCurrentAdmin();
        
        if (!Hash::check($request->current_password, $admin->password)) {
            return [
                'success' => false,
                'message' => 'Current password is incorrect',
                'errors' => ['current_password' => 'Current password is incorrect']
            ];
        }

        try {
            $admin->password = Hash::make($request->password);
            $admin->save();

            return [
                'success' => true,
                'message' => 'Password updated successfully!'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update password: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Regenerate session token.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function regenerateSession($request)
    {
        $request->session()->regenerate();
    }

    /**
     * Get admin permissions or roles.
     *
     * @return array
     */
    public function getAdminPermissions()
    {
        $admin = $this->getCurrentAdmin();
        
        if (!$admin) {
            return [];
        }

        // You can extend this based on your role/permission system
        return [
            'can_manage_banner' => true,
            'can_manage_seo' => true,
            'can_manage_contact' => true,
            'can_manage_stats' => true,
            'can_manage_other' => true,
        ];
    }
}
