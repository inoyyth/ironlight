<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tech;
use App\Models\Solution;
use App\Services\OtherService;
use Illuminate\Support\Facades\Auth;

class OtherController extends Controller
{
    protected $otherService;

    public function __construct(OtherService $otherService)
    {
        $this->otherService = $otherService;
    }

    public function index()
    {
        $other = $this->otherService->getOther();

        return view('admin.pages.other.index', compact('other'));
    }
    
    public function update(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $result = $this->otherService->updateOther($request, $adminId);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json($result);
        }

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()
            ->withInput()
            ->with('error', $result['message']);
    }

    public function storeTech(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $result = $this->otherService->createTech($request, $adminId);
        
        $statusCode = $result['status'] ?? 200;
        return response()->json($result, $statusCode);
    }

    public function updateTech(Request $request, Tech $tech)
    {
        $adminId = Auth::guard('admin')->id();
        $result = $this->otherService->updateTech($request, $tech, $adminId);
        
        $statusCode = $result['status'] ?? 200;
        return response()->json($result, $statusCode);
    }

    public function destroyTech(Tech $tech)
    {
        $adminId = Auth::guard('admin')->id();
        $result = $this->otherService->deleteTech($tech, $adminId);
        
        $statusCode = $result['status'] ?? 200;
        return response()->json($result, $statusCode);
    }

    public function storeSolution(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $result = $this->otherService->createSolution($request, $adminId);
        
        $statusCode = $result['status'] ?? 200;
        return response()->json($result, $statusCode);
    }

    public function updateSolution(Request $request, Solution $solution)
    {
        $adminId = Auth::guard('admin')->id();
        $result = $this->otherService->updateSolution($request, $solution, $adminId);
        
        $statusCode = $result['status'] ?? 200;
        return response()->json($result, $statusCode);
    }

    public function destroySolution(Solution $solution)
    {
        $adminId = Auth::guard('admin')->id();
        $result = $this->otherService->deleteSolution($solution, $adminId);
        
        $statusCode = $result['status'] ?? 200;
        return response()->json($result, $statusCode);
    }
}
