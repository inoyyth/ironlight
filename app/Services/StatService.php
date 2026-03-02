<?php

namespace App\Services;

use App\Models\Stat;

class StatService
{
    /**
     * Get all stats for display.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStats()
    {
        return Stat::select('id', 'name', 'value', 'description')->get();
    }

    /**
     * Get stat by ID.
     *
     * @param int $id
     * @return \App\Models\Stat|null
     */
    public function getStatById($id)
    {
        return Stat::find($id);
    }

    /**
     * Create or update a stat.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $id
     * @return array
     */
    public function saveStat($request, $id = null)
    {
        $validated = $this->validateStatData($request);

        try {
            if ($id) {
                $stat = Stat::findOrFail($id);
                $stat->update($validated);
                $message = 'Stat updated successfully!';
            } else {
                $stat = Stat::create($validated);
                $message = 'Stat created successfully!';
            }

            return [
                'success' => true,
                'message' => $message,
                'data' => $stat
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to save stat: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Delete a stat.
     *
     * @param int $id
     * @return array
     */
    public function deleteStat($id)
    {
        try {
            $stat = Stat::findOrFail($id);
            $stat->delete();

            return [
                'success' => true,
                'message' => 'Stat deleted successfully!'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to delete stat: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Validate stat request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function validateStatData($request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ], [
            'name.required' => 'Stat name is required',
            'name.max' => 'Stat name may not exceed 255 characters',
            'value.required' => 'Stat value is required',
            'value.max' => 'Stat value may not exceed 255 characters',
            'description.required' => 'Stat description is required',
            'description.max' => 'Stat description may not exceed 500 characters',
        ]);
    }

    /**
     * Get stats as array for API responses.
     *
     * @return array
     */
    public function getStatsArray()
    {
        return $this->getAllStats()->toArray();
    }

    /**
     * Check if stat exists.
     *
     * @param int $id
     * @return bool
     */
    public function statExists($id)
    {
        return Stat::where('id', $id)->exists();
    }

    /**
     * Get stats count.
     *
     * @return int
     */
    public function getStatsCount()
    {
        return Stat::count();
    }

    /**
     * Get stats for homepage display.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHomepageStats()
    {
        return Stat::select('name', 'value', 'description')
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
