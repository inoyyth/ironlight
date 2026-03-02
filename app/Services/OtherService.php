<?php

namespace App\Services;

use App\Models\Other;
use App\Models\Tech;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OtherService
{
    /**
     * Get other data with relationships.
     *
     * @return \App\Models\Other|null
     */
    public function getOther()
    {
        return Other::with(['tech', 'solution'])->first();
    }

    /**
     * Update other data.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $adminId
     * @return array
     */
    public function updateOther(Request $request, ?int $adminId = null)
    {
        $validated = $this->validateOtherData($request);

        try {
            $other = Other::first() ?: new Other();
            $other->how_works = $validated['how_works'];
            $other->this_for = $validated['this_for'];
            $other->this_not_for = $validated['this_not_for'];
            $other->updated_by = $adminId;

            if (!$other->exists) {
                $other->created_by = $adminId;
            }

            $other->save();

            return [
                'success' => true,
                'message' => 'Other updated successfully!',
                'data' => [
                    'id' => $other->id,
                    'how_works' => $other->how_works,
                    'this_for' => $other->this_for,
                    'this_not_for' => $other->this_not_for,
                ]
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update other: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Validate other request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function validateOtherData(Request $request)
    {
        return $request->validate([
            'how_works' => 'required|string',
            'this_for' => 'required|string',
            'this_not_for' => 'required|string',
        ], [
            'how_works.required' => 'How works is required',
            'this_for.required' => 'This for is required',
            'this_not_for.required' => 'This not for is required',
        ]);
    }

    /**
     * Create a new tech item.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $adminId
     * @return array
     */
    public function createTech(Request $request, ?int $adminId = null)
    {
        if (!($request->expectsJson() || $request->ajax())) {
            return [
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
                'status' => 403
            ];
        }

        try {
            $validated = $this->validateTechData($request);
        } catch (ValidationException $e) {
            return [
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422
            ];
        }

        $other = Other::first();
        if (!$other) {
            return [
                'success' => false,
                'message' => 'Other record not found.',
                'status' => 404
            ];
        }

        try {
            $tech = new Tech();
            $tech->other_id = $other->id;
            $tech->title = $validated['title'];
            $tech->url = $validated['url'];
            $tech->created_by = $adminId;
            $tech->updated_by = $adminId;
            $tech->save();

            return [
                'success' => true,
                'message' => 'Tech created successfully!',
                'data' => $tech
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create tech: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Update a tech item.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tech $tech
     * @param int|null $adminId
     * @return array
     */
    public function updateTech(Request $request, Tech $tech, ?int $adminId = null)
    {
        if (!($request->expectsJson() || $request->ajax())) {
            return [
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
                'status' => 403
            ];
        }

        try {
            $validated = $this->validateTechData($request);
        } catch (ValidationException $e) {
            return [
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422
            ];
        }

        $other = Other::first();
        if (!$other || (int) $tech->other_id !== (int) $other->id) {
            return [
                'success' => false,
                'message' => 'Tech not found.',
                'status' => 404
            ];
        }

        try {
            $tech->title = $validated['title'];
            $tech->url = $validated['url'];
            $tech->updated_by = $adminId;
            $tech->save();

            return [
                'success' => true,
                'message' => 'Tech updated successfully!',
                'data' => $tech
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update tech: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Delete a tech item.
     *
     * @param \App\Models\Tech $tech
     * @param int|null $adminId
     * @return array
     */
    public function deleteTech(Tech $tech, ?int $adminId = null)
    {
        if (!(request()->expectsJson() || request()->ajax())) {
            return [
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
                'status' => 403
            ];
        }

        $other = Other::first();
        if (!$other || (int) $tech->other_id !== (int) $other->id) {
            return [
                'success' => false,
                'message' => 'Tech not found.',
                'status' => 404
            ];
        }

        try {
            $tech->deleted_by = $adminId;
            $tech->save();
            $tech->delete();

            return [
                'success' => true,
                'message' => 'Tech deleted successfully!'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to delete tech: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Create a new solution item.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $adminId
     * @return array
     */
    public function createSolution(Request $request, ?int $adminId = null)
    {
        if (!($request->expectsJson() || $request->ajax())) {
            return [
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
                'status' => 403
            ];
        }

        try {
            $validated = $this->validateSolutionData($request);
        } catch (ValidationException $e) {
            return [
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422
            ];
        }

        $other = Other::first();
        if (!$other) {
            return [
                'success' => false,
                'message' => 'Other record not found.',
                'status' => 404
            ];
        }

        try {
            $solution = new Solution();
            $solution->other_id = $other->id;
            $solution->title = $validated['title'];
            $solution->description = $validated['description'];
            $solution->created_by = $adminId;
            $solution->updated_by = $adminId;
            $solution->save();

            return [
                'success' => true,
                'message' => 'Solution created successfully!',
                'data' => $solution
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create solution: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Update a solution item.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Solution $solution
     * @param int|null $adminId
     * @return array
     */
    public function updateSolution(Request $request, Solution $solution, ?int $adminId = null)
    {
        if (!($request->expectsJson() || $request->ajax())) {
            return [
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
                'status' => 403
            ];
        }

        try {
            $validated = $this->validateSolutionData($request);
        } catch (ValidationException $e) {
            return [
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422
            ];
        }

        $other = Other::first();
        if (!$other || (int) $solution->other_id !== (int) $other->id) {
            return [
                'success' => false,
                'message' => 'Solution not found.',
                'status' => 404
            ];
        }

        try {
            $solution->title = $validated['title'];
            $solution->description = $validated['description'];
            $solution->updated_by = $adminId;
            $solution->save();

            return [
                'success' => true,
                'message' => 'Solution updated successfully!',
                'data' => $solution
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update solution: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Delete a solution item.
     *
     * @param \App\Models\Solution $solution
     * @param int|null $adminId
     * @return array
     */
    public function deleteSolution(Solution $solution, ?int $adminId = null)
    {
        if (!(request()->expectsJson() || request()->ajax())) {
            return [
                'success' => false,
                'message' => 'This endpoint only accepts AJAX/JSON requests.',
                'status' => 403
            ];
        }

        $other = Other::first();
        if (!$other || (int) $solution->other_id !== (int) $other->id) {
            return [
                'success' => false,
                'message' => 'Solution not found.',
                'status' => 404
            ];
        }

        try {
            $solution->deleted_by = $adminId;
            $solution->save();
            $solution->delete();

            return [
                'success' => true,
                'message' => 'Solution deleted successfully!'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to delete solution: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Validate tech request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function validateTechData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);
    }

    /**
     * Validate solution request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function validateSolutionData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    }

    /**
     * Get other data as array for API responses.
     *
     * @return array|null
     */
    public function getOtherArray()
    {
        $other = $this->getOther();
        
        if (!$other) {
            return null;
        }
        
        return [
            'id' => $other->id,
            'how_works' => $other->how_works,
            'this_for' => $other->this_for,
            'this_not_for' => $other->this_not_for,
            'tech' => $other->tech->toArray(),
            'solution' => $other->solution->toArray(),
        ];
    }

    /**
     * Get tech and solution data for homepage.
     *
     * @return array
     */
    public function getHomepageData()
    {
        $other = $this->getOther();
        
        if (!$other) {
            return [
                'tech' => collect(),
                'solution' => collect()
            ];
        }
        
        return [
            'tech' => $other->tech()->select('id', 'title', 'url')->get(),
            'solution' => $other->solution()->select('id', 'title', 'description')->get()
        ];
    }
}
