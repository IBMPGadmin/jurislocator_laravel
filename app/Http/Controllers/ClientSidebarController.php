<?php

namespace App\Http\Controllers;

use App\Models\ClientSidebarData;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientSidebarController extends Controller
{
    /**
     * Save pinned popups for the authenticated user and selected client
     */
    public function savePinnedPopups(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $validator = Validator::make($request->all(), [
                'client_id' => 'required|integer',
                'popups' => 'required|array',
                'popups.*.section_id' => 'required|string',
                'popups.*.category_id' => 'required|integer',
                'popups.*.part' => 'nullable|string',
                'popups.*.division' => 'nullable|string',
                'popups.*.popup_title' => 'nullable|string',
                'popups.*.popup_content' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $clientId = $request->input('client_id');
            $popups = $request->input('popups', []);

            // Delete existing popups for this user and client
            ClientSidebarData::forUserAndClient($user->id, $clientId)->delete();

            // Insert new popups
            $savedCount = 0;
            foreach ($popups as $popup) {
                ClientSidebarData::create([
                    'user_id' => $user->id,
                    'client_id' => $clientId,
                    'section_id' => $popup['section_id'],
                    'category_id' => $popup['category_id'],
                    'part' => $popup['part'] ?? null,
                    'division' => $popup['division'] ?? null,
                    'popup_title' => $popup['popup_title'] ?? null,
                    'popup_content' => $popup['popup_content'] ?? null,
                ]);
                $savedCount++;
            }

            Log::info("Saved {$savedCount} popups for user {$user->id}, client {$clientId}");

            return response()->json([
                'success' => true,
                'message' => 'Popups saved successfully',
                'saved_count' => $savedCount
            ]);

        } catch (\Exception $e) {
            Log::error('Error saving pinned popups: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error saving popups: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch pinned popups for the authenticated user and selected client
     */
    public function fetchPinnedPopups(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $clientId = $request->input('client_id');
            if (!$clientId) {
                return response()->json(['success' => false, 'message' => 'Client ID is required'], 400);
            }

            $popups = ClientSidebarData::forUserAndClient($user->id, $clientId)
                ->orderBy('created_at')
                ->get()
                ->map(function ($popup) {
                    return [
                        'section_id' => $popup->section_id,
                        'category_id' => $popup->category_id,
                        'part' => $popup->part,
                        'division' => $popup->division,
                        'popup_title' => $popup->popup_title,
                        'popup_content' => $popup->popup_content,
                    ];
                });

            return response()->json([
                'success' => true,
                'popups' => $popups
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching pinned popups: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching popups: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear all pinned popups for the authenticated user and selected client
     */
    public function clearPinnedPopups(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $clientId = $request->input('client_id');
            if (!$clientId) {
                return response()->json(['success' => false, 'message' => 'Client ID is required'], 400);
            }

            $deletedCount = ClientSidebarData::forUserAndClient($user->id, $clientId)->delete();

            Log::info("Cleared {$deletedCount} popups for user {$user->id}, client {$clientId}");

            return response()->json([
                'success' => true,
                'message' => 'Popups cleared successfully',
                'deleted_count' => $deletedCount
            ]);

        } catch (\Exception $e) {
            Log::error('Error clearing pinned popups: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error clearing popups: ' . $e->getMessage()
            ], 500);
        }
    }
}