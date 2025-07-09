<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TimezoneController extends Controller
{
    /**
     * Get user's pinned timezones
     */
    public function getPinnedTimezones(): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }
            
            $pinnedTimezones = $user->pinned_timezones ?? [];
            
            Log::info('Getting pinned timezones for user: ' . $user->id, ['timezones' => $pinnedTimezones]);
            
            return response()->json([
                'success' => true,
                'data' => $pinnedTimezones,
                'user_id' => $user->id
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting pinned timezones: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving timezones'
            ], 500);
        }
    }

    /**
     * Update user's pinned timezones
     */
    public function updatePinnedTimezones(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $request->validate([
                'pinned_timezones' => 'required|array',
                'pinned_timezones.*.timezone' => 'required|string',
                'pinned_timezones.*.name' => 'required|string',
                'pinned_timezones.*.country' => 'required|string',
                'pinned_timezones.*.flag' => 'required|string',
            ]);

            $oldTimezones = $user->pinned_timezones;
            $user->pinned_timezones = $request->pinned_timezones;
            $saved = $user->save();

            Log::info('Updated pinned timezones for user: ' . $user->id, [
                'old_timezones' => $oldTimezones,
                'new_timezones' => $request->pinned_timezones,
                'saved' => $saved
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pinned timezones updated successfully',
                'data' => $user->fresh()->pinned_timezones,
                'saved' => $saved
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating pinned timezones: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating timezones: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add a timezone to pinned list
     */
    public function pinTimezone(Request $request): JsonResponse
    {
        $request->validate([
            'timezone' => 'required|string',
            'name' => 'required|string',
            'country' => 'required|string',
            'flag' => 'required|string',
        ]);

        $user = Auth::user();
        $pinnedTimezones = $user->pinned_timezones ?? [];

        // Check if timezone is already pinned
        $exists = collect($pinnedTimezones)->contains('timezone', $request->timezone);
        
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Timezone is already pinned'
            ], 400);
        }

        $pinnedTimezones[] = [
            'timezone' => $request->timezone,
            'name' => $request->name,
            'country' => $request->country,
            'flag' => $request->flag,
        ];

        $user->pinned_timezones = $pinnedTimezones;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Timezone pinned successfully',
            'data' => $pinnedTimezones
        ]);
    }

    /**
     * Remove a timezone from pinned list
     */
    public function unpinTimezone(Request $request): JsonResponse
    {
        $request->validate([
            'timezone' => 'required|string',
        ]);

        $user = Auth::user();
        $pinnedTimezones = $user->pinned_timezones ?? [];

        // Remove the timezone
        $pinnedTimezones = collect($pinnedTimezones)
            ->reject(function ($item) use ($request) {
                return $item['timezone'] === $request->timezone;
            })
            ->values()
            ->toArray();

        $user->pinned_timezones = $pinnedTimezones;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Timezone unpinned successfully',
            'data' => $pinnedTimezones
        ]);
    }

    /**
     * Test endpoint to verify the controller is working
     */
    public function test(): JsonResponse
    {
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'message' => 'Timezone controller is working',
            'user_id' => $user ? $user->id : null,
            'authenticated' => Auth::check(),
            'timezones' => $user ? $user->pinned_timezones : null
        ]);
    }
}
