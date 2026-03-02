<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StatService;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    protected $statService;

    public function __construct(StatService $statService)
    {
        $this->statService = $statService;
    }

    public function index()
    {
        $stats = $this->statService->getAllStats();
       
        return view('admin.pages.stats.index', [
            'title' => 'Admin Stats - IronLight',
            'user' => Auth::guard('admin')->user(),
            'stats' => $stats
        ]);
    }

    public function create() {
        return view('admin.pages.stats.form', [
            'title' => 'Admin Stats - IronLight',
            'user' => Auth::guard('admin')->user(),
            'data' => null
        ]);
    }

    public function edit($id) {
        $stat = $this->statService->getStatById($id);
        
        return view('admin.pages.stats.form', [
            'title' => 'Admin Stats - IronLight',
            'user' => Auth::guard('admin')->user(),
            'data' => $stat
        ]);
    }

    public function store(Request $request) {
        $id = $request->id;
        $result = $this->statService->saveStat($request, $id);
        
        if ($result['success']) {
            return redirect()->route('admin.stats.index')->with('success', $result['message']);
        }

        return back()
            ->withInput()
            ->with('error', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->statService->deleteStat($id);
        
        if ($result['success']) {
            return redirect()->route('admin.stats.index')->with('success', $result['message']);
        }

        return redirect()->route('admin.stats.index')->with('error', $result['message']);
    }
}
