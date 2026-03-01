<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Other;
use App\Models\Tech;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OtherController extends Controller
{
    public function index()
    {
        $other = Other::with(['tech', 'solution'])->first();

        return view('admin.pages.other.index', compact('other'));
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'how_works' => 'required|string',
            'this_for' => 'required|string',
            'this_not_for' => 'required|string',
        ], [
            'how_works.required' => 'How works is required',
            'this_for.required' => 'This for is required',
            'this_not_for.required' => 'This not for is required',
        ]);

        $other = Other::first() ?: new Other();
        $other->how_works = $validated['how_works'];
        $other->this_for = $validated['this_for'];
        $other->this_not_for = $validated['this_not_for'];
        $other->updated_by = Auth::guard('admin')->id();

        if (!$other->exists) {
            $other->created_by = Auth::guard('admin')->id();
        }

        $other->save();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Other updated successfully!',
                'data' => [
                    'id' => $other->id,
                    'how_works' => $other->how_works,
                    'this_for' => $other->this_for,
                    'this_not_for' => $other->this_not_for,
                ],
            ]);
        }

        return back()->with('success', 'Other updated successfully!');
    }

    public function storeTech(Request $request)
    {
        if (!($request->expectsJson() || $request->ajax())) {
            return response()->json([
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
            ], 403);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'url' => 'required|string|max:255',
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $other = Other::first();
        if (!$other) {
            return response()->json(['success' => false, 'message' => 'Other record not found.'], 404);
        }

        $tech = new Tech();
        $tech->other_id = $other->id;
        $tech->title = $validated['title'];
        $tech->url = $validated['url'];
        $tech->created_by = Auth::guard('admin')->id();
        $tech->updated_by = Auth::guard('admin')->id();
        $tech->save();

        return response()->json([
            'success' => true,
            'message' => 'Tech created successfully!',
            'data' => $tech,
        ]);
    }

    public function updateTech(Request $request, Tech $tech)
    {
        if (!($request->expectsJson() || $request->ajax())) {
            return response()->json([
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
            ], 403);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'url' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $other = Other::first();
        if (!$other || (int) $tech->other_id !== (int) $other->id) {
            return response()->json(['success' => false, 'message' => 'Tech not found.'], 404);
        }

        $tech->title = $validated['title'];
        $tech->url = $validated['url'];
        $tech->updated_by = Auth::guard('admin')->id();
        $tech->save();

        return response()->json([
            'success' => true,
            'message' => 'Tech updated successfully!',
            'data' => $tech,
        ]);
    }

    public function destroyTech(Tech $tech)
    {
        if (!(request()->expectsJson() || request()->ajax())) {
            return response()->json([
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
            ], 403);
        }

        $other = Other::first();
        if (!$other || (int) $tech->other_id !== (int) $other->id) {
            return response()->json(['success' => false, 'message' => 'Tech not found.'], 404);
        }

        $tech->deleted_by = Auth::guard('admin')->id();
        $tech->save();
        $tech->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tech deleted successfully!',
        ]);
    }

    public function storeSolution(Request $request)
    {
        if (!($request->expectsJson() || $request->ajax())) {
            return response()->json([
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
            ], 403);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $other = Other::first();
        if (!$other) {
            return response()->json(['success' => false, 'message' => 'Other record not found.'], 404);
        }

        $solution = new Solution();
        $solution->other_id = $other->id;
        $solution->title = $validated['title'];
        $solution->description = $validated['description'];
        $solution->created_by = Auth::guard('admin')->id();
        $solution->updated_by = Auth::guard('admin')->id();
        $solution->save();

        return response()->json([
            'success' => true,
            'message' => 'Solution created successfully!',
            'data' => $solution,
        ]);
    }

    public function updateSolution(Request $request, Solution $solution)
    {
        if (!($request->expectsJson() || $request->ajax())) {
            return response()->json([
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
            ], 403);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $other = Other::first();
        if (!$other || (int) $solution->other_id !== (int) $other->id) {
            return response()->json(['success' => false, 'message' => 'Solution not found.'], 404);
        }

        $solution->title = $validated['title'];
        $solution->description = $validated['description'];
        $solution->updated_by = Auth::guard('admin')->id();
        $solution->save();

        return response()->json([
            'success' => true,
            'message' => 'Solution updated successfully!',
            'data' => $solution,
        ]);
    }

    public function destroySolution(Solution $solution)
    {
        if (!(request()->expectsJson() || request()->ajax())) {
            return response()->json([
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
            ], 403);
        }

        $other = Other::first();
        if (!$other || (int) $solution->other_id !== (int) $other->id) {
            return response()->json(['success' => false, 'message' => 'Solution not found.'], 404);
        }

        $solution->deleted_by = Auth::guard('admin')->id();
        $solution->save();
        $solution->delete();

        return response()->json([
            'success' => true,
            'message' => 'Solution deleted successfully!',
        ]);
    }
}
