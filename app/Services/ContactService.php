<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class ContactService
{
    private const REDIS_KEY = 'contact_settings';

    /**
     * Get contact settings from Redis.
     *
     * @return array
     */
    public function getContactSettings()
    {
        $contactSettings = Redis::get(self::REDIS_KEY);
        return $contactSettings ? json_decode($contactSettings, true) : [];
    }

    /**
     * Update contact settings in Redis.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function updateContactSettings($request)
    {
        $validated = $this->validateContactData($request);

        try {
            Redis::select(0);
            Redis::set(self::REDIS_KEY, json_encode($validated));

            return [
                'success' => true,
                'message' => 'Contact settings updated successfully!',
                'data' => $validated
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update contact settings: ' . $e->getMessage(),
                'errors' => ['general' => $e->getMessage()]
            ];
        }
    }

    /**
     * Validate contact request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function validateContactData($request)
    {
        return $request->validate([
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email may not exceed 255 characters',
            'phone.max' => 'Phone may not exceed 50 characters',
            'address.max' => 'Address may not exceed 255 characters',
            'website.url' => 'Website must be a valid URL',
            'website.max' => 'Website may not exceed 255 characters',
            'linkedin.url' => 'LinkedIn must be a valid URL',
            'linkedin.max' => 'LinkedIn may not exceed 255 characters',
            'description.max' => 'Description may not exceed 255 characters',
            'subtitle.max' => 'Subtitle may not exceed 255 characters',
            'job_title.max' => 'Job title may not exceed 255 characters',
        ]);
    }

    /**
     * Get specific contact field.
     *
     * @param string $field
     * @param mixed $default
     * @return mixed
     */
    public function getContactField($field, $default = null)
    {
        $settings = $this->getContactSettings();
        return $settings[$field] ?? $default;
    }

    /**
     * Get contact data as array for API responses.
     *
     * @return array
     */
    public function getContactArray()
    {
        return $this->getContactSettings();
    }

    /**
     * Check if contact settings exist.
     *
     * @return bool
     */
    public function contactSettingsExist()
    {
        return Redis::exists(self::REDIS_KEY);
    }

    /**
     * Clear contact settings from Redis.
     *
     * @return bool
     */
    public function clearContactSettings()
    {
        try {
            Redis::del(self::REDIS_KEY);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
