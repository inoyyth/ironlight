<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stat;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    public function index()
    {
        $stats = Stat::select('id', 'name', 'value', 'description')->get();
       
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
        $stat = Stat::find($id);
        
        return view('admin.pages.stats.form', [
            'title' => 'Admin Stats - IronLight',
            'user' => Auth::guard('admin')->user(),
            'data' => $stat
        ]);
    }

    public function store(Request $request) {
        // request validation
        $request->validate([
            'name' => 'required',
            'value' => 'required',
            'description' => 'required',
        ],
        [
            'name.required' => 'Stat name is required',
            'value.required' => 'Stat value is required',
            'description.required' => 'Stat description is required',
        ]);

        // check if id exists
        if ($request->id) {
            // update
            $stat = Stat::find($request->id);
            $stat->name = $request->name;
            $stat->value = $request->value;
            $stat->description = $request->description;
            $stat->save();
        } else {
            // create
            $stat = new Stat();
            $stat->name = $request->name;
            $stat->value = $request->value;
            $stat->description = $request->description;
            $stat->save();
        }
        
        return redirect()->route('admin.stats.index')->with('success', 'Stat saved successfully!');
    }

    public function destroy($id)
    {
        $stat = Stat::find($id);
        
        if ($stat) {
            $stat->delete();
            return redirect()->route('admin.stats.index')->with('success', 'Stat deleted successfully!');
        }
        
        return redirect()->route('admin.stats.index')->with('error', 'Stat not found!');
    }
}
