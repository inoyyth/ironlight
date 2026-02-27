<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin.dashboard', [
            'title' => 'Admin Dashboard - IronLight',
            'user' => Auth::guard('admin')->user()
        ]);
    }
}
